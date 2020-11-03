# Patricia PHP Task

Implement an Authentication service, with

1. Registration
2. Login
3. Token generation for subsequent actions
4. Fetch user's data. This should be implemented in Laravel (lumen) your work will be judged based on the following 5 criteria.

### Five (5) criteria

1. Does it work?
2. Code Quality,
3. Unit test coverage (>70%)
4. API Documentation
5. Use of best practice

### Usage

-   `git clone https://github.com/samsoft00/patricia-engineer-task.git patricia-auth-api`
-   `cd patricia-auth-api`
-   `composer install`
-   `cp .env.example .env`
-   `php artisan jwt:secret`
-   `php artisan migrate`
-   `php -S localhost:8000 -t public`

### Postman Link

-   `https://www.getpostman.com/collections/6df1de58ea594dca5511`

### Run Test

-   `vendor/bin/phpunit`
