<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\DocumentVerification;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Offre;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function users(): View
    {
        $users = User::query()
            ->latest()
            ->take(12)
            ->get()
            ->map(fn (User $user) => [
                'title' => $user->name,
                'subtitle' => $user->email,
                'meta' => $user->company_name ?: 'No company',
                'status' => ucfirst($user->role ?: 'client'),
                'icon' => $user->role === 'supplier' ? 'storefront' : 'person',
            ])
            ->all();

        return $this->resourceView('Users', 'Manage clients, suppliers, and platform accounts.', 'group', [
            ['label' => 'Total users', 'value' => User::count()],
            ['label' => 'Clients', 'value' => User::where('role', 'client')->count()],
            ['label' => 'Suppliers', 'value' => User::where('role', 'supplier')->count()],
        ], $users ?: $this->demoUsers());
    }

    public function demandes(): View
    {
        $demandes = Demande::query()
            ->with('user')
            ->latest()
            ->take(12)
            ->get()
            ->map(fn (Demande $demande) => [
                'title' => $demande->title,
                'subtitle' => $demande->user?->name ?? 'Client',
                'meta' => $demande->budget ? '$' . number_format((float) $demande->budget, 2) : 'No budget',
                'status' => ucfirst($demande->status ?: 'pending'),
                'icon' => 'assignment',
            ])
            ->all();

        return $this->resourceView('Demandes', 'Monitor client requests and operational demand flow.', 'assignment', [
            ['label' => 'Total demandes', 'value' => Demande::count()],
            ['label' => 'Pending', 'value' => Demande::where('status', 'pending')->count()],
            ['label' => 'Completed', 'value' => Demande::where('status', 'completed')->count()],
        ], $demandes ?: $this->demoDemandes());
    }

    public function offers(): View
    {
        $offers = Offre::query()
            ->with(['user', 'demande'])
            ->latest()
            ->take(12)
            ->get()
            ->map(fn (Offre $offre) => [
                'title' => $offre->title,
                'subtitle' => $offre->demande?->title ?? 'No demande linked',
                'meta' => '$' . number_format((float) $offre->price, 2),
                'status' => ucfirst($offre->status ?: 'pending'),
                'icon' => 'request_quote',
            ])
            ->all();

        return $this->resourceView('Offers', 'Review supplier proposals, pricing, and acceptance status.', 'request_quote', [
            ['label' => 'Total offers', 'value' => Offre::count()],
            ['label' => 'Pending', 'value' => Offre::where('status', 'pending')->count()],
            ['label' => 'Accepted', 'value' => Offre::where('status', 'accepted')->count()],
        ], $offers ?: $this->demoOffers());
    }

    public function moderation(): View
    {
        $documents = DocumentVerification::query()
            ->with('user')
            ->latest()
            ->take(12)
            ->get()
            ->map(fn (DocumentVerification $document) => [
                'title' => ucfirst(str_replace('_', ' ', $document->document_type)),
                'subtitle' => $document->user?->name ?? 'Unknown user',
                'meta' => $document->rejection_reason ?: 'Document review',
                'status' => ucfirst($document->status ?: 'pending'),
                'icon' => 'gavel',
            ])
            ->all();

        return $this->resourceView('Moderation', 'Review document checks, escalations, and flagged activity.', 'gavel', [
            ['label' => 'Pending reviews', 'value' => DocumentVerification::where('status', 'pending')->count()],
            ['label' => 'Approved', 'value' => DocumentVerification::where('status', 'approved')->count()],
            ['label' => 'Rejected', 'value' => DocumentVerification::where('status', 'rejected')->count()],
        ], $documents ?: $this->demoModeration());
    }

    public function logs(): View
    {
        return $this->resourceView('System Logs', 'Operational events and platform health signals.', 'terminal', [
            ['label' => 'Events today', 'value' => Notification::whereDate('created_at', today())->count()],
            ['label' => 'Warnings', 'value' => 3],
            ['label' => 'Services online', 'value' => 8],
        ], [
            ['title' => 'Webhook processed', 'subtitle' => 'Carrier API payload accepted', 'meta' => now()->subMinutes(8)->format('H:i'), 'status' => 'Info', 'icon' => 'webhook'],
            ['title' => 'Queue health check', 'subtitle' => 'No failed jobs detected', 'meta' => now()->subMinutes(17)->format('H:i'), 'status' => 'Success', 'icon' => 'check_circle'],
            ['title' => 'Latency spike', 'subtitle' => 'EU-West response time above threshold', 'meta' => now()->subHour()->format('H:i'), 'status' => 'Warning', 'icon' => 'warning'],
        ]);
    }

    public function messages(): View
    {
        $messages = Message::query()
            ->with(['sender', 'receiver'])
            ->latest()
            ->take(12)
            ->get()
            ->map(fn (Message $message) => [
                'title' => $message->sender?->name . ' → ' . $message->receiver?->name,
                'subtitle' => str($message->body)->limit(90)->toString(),
                'meta' => $message->created_at?->diffForHumans() ?? 'Recently',
                'status' => $message->read_at ? 'Read' : 'Unread',
                'icon' => 'mail',
            ])
            ->all();

        return $this->resourceView('Messages', 'Audit client and supplier communication activity.', 'mail', [
            ['label' => 'Total messages', 'value' => Message::count()],
            ['label' => 'Unread', 'value' => Message::whereNull('read_at')->count()],
            ['label' => 'Today', 'value' => Message::whereDate('created_at', today())->count()],
        ], $messages ?: $this->demoMessages());
    }

    public function settings(): View
    {
        return $this->resourceView('Settings', 'Platform configuration and administrative controls.', 'settings', [
            ['label' => 'Roles', 'value' => 3],
            ['label' => 'Policies', 'value' => 6],
            ['label' => 'Integrations', 'value' => 4],
        ], [
            ['title' => 'User role policy', 'subtitle' => 'Client, supplier, and admin access boundaries.', 'meta' => 'Active', 'status' => 'Configured', 'icon' => 'admin_panel_settings'],
            ['title' => 'Document verification', 'subtitle' => 'Manual review required for new supplier documents.', 'meta' => 'Enabled', 'status' => 'Configured', 'icon' => 'fact_check'],
            ['title' => 'Notification channels', 'subtitle' => 'Email and in-app alerts for operational events.', 'meta' => 'Enabled', 'status' => 'Configured', 'icon' => 'notifications'],
        ]);
    }

    private function resourceView(string $title, string $description, string $icon, array $stats, array $rows): View
    {
        return view('admin.resource', [
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'stats' => $stats,
            'rows' => $rows,
            'navItems' => $this->navItems($title),
        ]);
    }

    private function navItems(string $active): array
    {
        return [
            ['label' => 'Dashboard', 'icon' => 'dashboard', 'href' => route('admin.dashboard'), 'active' => $active === 'Dashboard'],
            ['label' => 'Users', 'icon' => 'group', 'href' => route('admin.users'), 'active' => $active === 'Users'],
            ['label' => 'Demandes', 'icon' => 'assignment', 'href' => route('admin.demandes'), 'active' => $active === 'Demandes'],
            ['label' => 'Offers', 'icon' => 'request_quote', 'href' => route('admin.offers'), 'active' => $active === 'Offers'],
            ['label' => 'Moderation', 'icon' => 'gavel', 'href' => route('admin.moderation'), 'active' => $active === 'Moderation'],
            ['label' => 'System Logs', 'icon' => 'list_alt', 'href' => route('admin.logs'), 'active' => $active === 'System Logs'],
            ['label' => 'Messages', 'icon' => 'mail', 'href' => route('admin.messages'), 'active' => $active === 'Messages'],
            ['label' => 'Settings', 'icon' => 'settings', 'href' => route('admin.settings'), 'active' => $active === 'Settings'],
        ];
    }

    private function demoUsers(): array
    {
        return [
            ['title' => 'Marcus Taylor', 'subtitle' => 'marcus@supplylink.test', 'meta' => 'Client account', 'status' => 'Client', 'icon' => 'person'],
            ['title' => 'SwiftTrans Ltd.', 'subtitle' => 'ops@swifttrans.test', 'meta' => 'Supplier account', 'status' => 'Supplier', 'icon' => 'storefront'],
        ];
    }

    private function demoDemandes(): array
    {
        return [
            ['title' => 'Electronics Wholesale Shpt', 'subtitle' => 'Marcus Taylor', 'meta' => '$4,800.00', 'status' => 'Reviewing', 'icon' => 'assignment'],
            ['title' => 'Raw Materials Import', 'subtitle' => 'Nordic Build Group', 'meta' => '$8,200.00', 'status' => 'Active', 'icon' => 'inventory_2'],
        ];
    }

    private function demoOffers(): array
    {
        return [
            ['title' => 'GlobalTrans Logistics', 'subtitle' => 'Electronics Wholesale Shpt', 'meta' => '$1,200.00', 'status' => 'Pending', 'icon' => 'request_quote'],
            ['title' => 'SwiftLink Air', 'subtitle' => 'Urgent Parts Delivery', 'meta' => '$2,400.00', 'status' => 'Recommended', 'icon' => 'flight_takeoff'],
        ];
    }

    private function demoModeration(): array
    {
        return [
            ['title' => 'Supplier business license', 'subtitle' => 'SwiftTrans Ltd.', 'meta' => 'Needs admin review', 'status' => 'Pending', 'icon' => 'fact_check'],
            ['title' => 'Duplicate shipping labels', 'subtitle' => 'Fraud detection', 'meta' => 'High priority', 'status' => 'Urgent', 'icon' => 'report'],
        ];
    }

    private function demoMessages(): array
    {
        return [
            ['title' => 'Client → Supplier', 'subtitle' => 'Can you confirm pickup availability for tomorrow?', 'meta' => '12m ago', 'status' => 'Unread', 'icon' => 'mail'],
            ['title' => 'Supplier → Client', 'subtitle' => 'Quote updated with temperature control included.', 'meta' => '48m ago', 'status' => 'Read', 'icon' => 'mark_email_read'],
        ];
    }
}
