# App configuration

1. Copy .env.example to .env file.
2. Set up database credentials in the .env file.
3. Generate app key with `php artisan key:generate`.
4. Run migrations with `php artisan migrate`.
5. Create a list of 10 randomly named users by executing `php artisan db:seed`.

# Available routes

| Method | Route             | Body                                  | Description                                |
|--------|-------------------|---------------------------------------|--------------------------------------------|
| GET    | /api/users/{user} |                                       | Returns user data in JSON format.          |
| POST   | /api/actions      | int user_a, int user_b, Action action | Performs a given action on provided users. |

# Available actions

- `liked`
- `unliked`
