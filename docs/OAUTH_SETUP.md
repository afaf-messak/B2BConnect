# OAuth Setup Guide (Windows · Laravel 12 · Socialite)

This app uses **Laravel Socialite** with Google credentials from `.env` via `config/services.php`.

## Root cause of “Missing client_id” errors

Those errors mean Socialite received an **empty** `client_id`. In this project that happens when:

1. `GOOGLE_CLIENT_ID` is missing or empty in `.env`
2. Config is cached with old values → run `php artisan config:clear`

---

## 1. Laravel `.env` (required)

Open `c:\xampp\htdocs\B2BConnect\.env` and set:

```env
APP_URL=http://127.0.0.1:8000

GOOGLE_CLIENT_ID=your-google-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=GOCSPX-your-google-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

**Important:** `APP_URL` must match the URL in your browser (scheme + host + port).

| How you open the app | APP_URL |
|----------------------|---------|
| `php artisan serve` (default) | `http://127.0.0.1:8000` |
| XAMPP `http://localhost/B2BConnect/public` | `http://localhost/B2BConnect/public` |

After any `.env` change:

```powershell
cd c:\xampp\htdocs\B2BConnect
php artisan config:clear
```

Verify loaded config:

```powershell
php artisan tinker --execute="dump(config('services.google'));"
```

Must show non-empty `client_id`, `client_secret`, and `redirect`.

---

## 2. Exact redirect URLs to register

Register **exactly** these URIs in Google Cloud Console (must match `APP_URL`):

| Provider | Redirect URI (default with `php artisan serve`) |
|----------|--------------------------------------------------|
| Google | `http://127.0.0.1:8000/auth/google/callback` |

Application routes (defined in `routes/auth.php`):

| Action | URL |
|--------|-----|
| Start Google login | `GET /auth/google/redirect` |
| Google callback | `GET /auth/google/callback` |

---

## 3. Google Cloud Console

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create or select a project
3. **APIs & Services → OAuth consent screen**
   - User type: **External** (for testing) or Internal (Workspace)
   - Fill app name, support email, developer contact
   - Scopes: add `email`, `profile`, `openid`
   - Add test users if app is in “Testing”
4. **APIs & Services → Credentials → Create credentials → OAuth client ID**
   - Application type: **Web application**
   - Name: `B2BConnect Local` (any name)
   - **Authorized redirect URIs** (add **both** for local dev):
     - `http://127.0.0.1:8000/auth/google/callback`
     - `http://localhost:8000/auth/google/callback`
   - If you use XAMPP instead of `php artisan serve`, also add:
     - `http://localhost/B2BConnect/public/auth/google/callback`
5. Copy **Client ID** → `GOOGLE_CLIENT_ID`
6. Copy **Client secret** → `GOOGLE_CLIENT_SECRET`

---

## 4. Config mapping (reference)

| `.env` variable | `config/services.php` key |
|-----------------|---------------------------|
| `GOOGLE_CLIENT_ID` | `services.google.client_id` |
| `GOOGLE_CLIENT_SECRET` | `services.google.client_secret` |
| `GOOGLE_REDIRECT_URI` | `services.google.redirect` |

---

## 5. Run the app (Windows)

```powershell
cd c:\xampp\htdocs\B2BConnect
php artisan config:clear
php artisan serve
```

Open: **http://127.0.0.1:8000/login** → **Continue with Google**

If credentials are still missing, the login page shows a clear message naming the required `.env` keys.

---

## 6. Troubleshooting

| Symptom | Fix |
|---------|-----|
| Missing required parameter: client_id | Set `GOOGLE_CLIENT_ID` in `.env`, run `config:clear` |
| redirect_uri_mismatch | Add every URI from `php artisan oauth:check` under **Authorized redirect URIs** in Google Console |
| Session expired / invalid state | Use only `http://127.0.0.1:8000` (not localhost) |

---

## 7. Production checklist

- Set `APP_URL=https://your-domain.com`
- Register production callback URL in Google Cloud Console
- Set real `GOOGLE_*` values on the server
- Run `php artisan config:cache` after deploying `.env`
