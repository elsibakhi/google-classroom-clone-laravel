# Laravel Classroom

A Google Classroom-like Learning Management System (LMS) built with Laravel 10, featuring subscription-based access to premium features using Stripe, and email notifications via Mailtrap.

## 🚀 Features

- ✅ Teacher & student roles
- ✅ Class creation & joining via class codes
- ✅ Assignments with due dates & file attachments
- ✅ Submissions tracking and grading
- ✅ Commenting system for classroom interaction
- ✅ Email notifications using Mailtrap
- ✅ Stripe-powered subscription system:
  - Free users: Limited access
  - Premium users: Full feature access
- ✅ Role-based access control

## 🧰 Built With

- [Laravel 10](https://laravel.com/)
- [Stripe](https://stripe.com/) – for handling subscriptions
- [Mailtrap](https://mailtrap.io/) – for testing email sending
- MySQL – database
- Blade templating engine

## 📦 Installation

```bash
git clone https://github.com/elsibakhi/laravel-classroom.git
cd laravel-classroom

composer install
cp .env.example .env
php artisan key:generate

# Configure DB, Stripe, and Mailtrap in your .env file
php artisan migrate
php artisan db:seed

php artisan serve

