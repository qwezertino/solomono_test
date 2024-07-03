
**Related core package**: https://github.com/thecodeholic/tc-php-mvc-core

------
## Installation using docker
Make sure `docker` and `docker-compose` commands are available in command line.

1. Clone the project using git
1. Copy `.env.example` into `.env` (Don't need to change anything for local development)
1. Navigate to the project root directory and run `docker-compose up -d --build`
1. Install dependencies - `docker compose exec php composer install`
1. Run migrations - `docker compose exec php php migrations.php`
8. Open in browser http://localhost
