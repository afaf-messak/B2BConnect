# Google OAuth Setup

Use this checklist when the "Continue with Google" button is disabled or Google redirects fail.

1. In Google Cloud Console, create an OAuth 2.0 Client ID for a web application.
2. Add this authorized redirect URI:

```text
http://127.0.0.1:8000/auth/google/callback
```

If you run the app on `localhost`, add this one too:

```text
http://localhost:8000/auth/google/callback
```

3. Put the credentials in `.env`:

```dotenv
APP_URL=http://127.0.0.1:8000
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

4. Clear cached config and verify:

```bash
php artisan config:clear
php artisan oauth:check
```

5. Start Laravel and open the login page:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Important: keep the browser URL consistent with `APP_URL`. Do not switch between `127.0.0.1` and `localhost` during the same Google login attempt.
