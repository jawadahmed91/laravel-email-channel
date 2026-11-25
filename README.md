# Laravel Email Channel


Laravel 13 patterns for queued mail notifications, Markdown templates, per-message metadata, queue selection, retries, and testing with `Notification::fake()`.


`WelcomeNotification` implements `ShouldQueue`, uses the `emails` queue, and builds a standard `MailMessage` without embedding credentials or transport settings.


```bash
composer install
composer test
```

## Add this to an existing Laravel project

1. Configure a mailer and queue connection in `.env`, then confirm `php artisan config:show mail` reflects the intended non-secret settings.
2. Copy `src/WelcomeNotification.php` to `app/Notifications/WelcomeNotification.php` and change its namespace to `App\Notifications`.
3. Customize the subject, greeting, action URL, and message text. Keep transport credentials in environment variables.
4. Ensure the notifiable model uses Laravel's `Notifiable` trait and has an email address or a `routeNotificationForMail()` method.
5. Send the notification after the account transaction commits.

```php
$user->notify(new WelcomeNotification(route('dashboard')));
```

6. Start an email worker with `php artisan queue:work --queue=emails --tries=3` because the notification implements `ShouldQueue`.
7. Run workers under a process supervisor in production and configure failed-job storage and monitoring.
8. Copy `tests/WelcomeNotificationTest.php` into your project, update its namespace and imports, and run `php artisan test`.
9. Use `Notification::fake()` to verify dispatch, then add a separate test for the generated mail subject, lines, and action URL.
