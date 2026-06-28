@extends('layouts.saas', ['navActive' => 'settings'])

@section('content')
    <x-saas.page-header :title="$pageTitle" :subtitle="$pageSubtitle" />

    <x-portal.settings-hub :show-platform="true" :quick-links="$quickLinks" />
@endsection
