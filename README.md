# Laravel Microservice

This is the official repository for the [**Laravel Microservice** course by Gary Clarke](https://www.garyclarke.tech/p/laravel-microservice).

The application is built using the Laravel framework and is designed to demonstrate real-world microservice architecture, including how to receive, process, and forward webhook events to other services.

## 🚀 About the Course

Learn Laravel by building a real-world microservice from scratch:

- Handle webhook events from external platforms (e.g. Apple & Google)
- Validate and process incoming data
- Forward structured payloads to a second Laravel app (AudienceGrid)
- Use Laravel’s powerful features like tagged services, DTOs, and HTTP testing

🎓 [Check out the full course here](https://www.garyclarke.tech/p/laravel-microservice)

## 🧠 What You'll Learn

- Laravel microservice architecture
- Webhook handling
- DTOs, service providers, and configuration management
- Service-to-service communication via Laravel's HTTP client
- Testing strategies with Pest
- Environment-specific error handling

## 🌱 Branch Structure

Each Git branch corresponds to a lesson or milestone in the course. Simply check out the relevant branch to follow along with any section.

Example:
```bash
git checkout 2-phpstan
git checkout 3-composer-scripts
```

## ⚙️ Getting Started

Clone the repo and install dependencies:

```bash
git clone https://github.com/GaryClarke/laravel-microservice.git
cd laravel-microservice
composer install
```

### Database Setup

SQLite is preconfigured. You can create a blank database file like this:

```bash
touch database/database.sqlite
```

Then run migrations:

```bash
php artisan migrate
```

## 🔗 Communication with AudienceGrid

This microservice forwards data to another Laravel application called **AudienceGrid**, which simulates a CRM-like system.

👉 [AudienceGrid GitHub Repo](https://github.com/GaryClarke/audiencegrid)

You can run both apps simultaneously:
```bash
php artisan serve --port=8000 # Laravel Microservice
php artisan serve --port=8005 # AudienceGrid
```

## 🧪 Running Tests

The app includes Pest and PHPStan for testing and static analysis:

```bash
composer test
```

## 📌 Notes

If you're comfortable with Composer and Laravel, you’re welcome to install dependencies one-by-one as seen in the videos. Otherwise, use the included `composer.json` for consistency with the course setup.

## 🧑‍🏫 Support

Have a question? Ask inside the course.

## 📄 License

This repo is provided for **educational use only** as part of the Laravel Microservice course.

---

Happy coding!

– Gary
