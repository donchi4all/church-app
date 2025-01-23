# Laravel Project: Golim Admin Panel

## Project Overview
Golim Admin Panel is a Laravel-based application designed to manage the administrative tasks of Grace Operated Life International Ministry (Golim). It provides a secure platform for church administrators to handle member information, events, announcements, and other ministry operations.

## Features
- Secure manual authentication system using Laravel's basic auth
- Error handling with user-friendly feedback
- Responsive design for desktop and mobile users
- Role-based access control for admins and users
- Dynamic links to the church’s main website
- Paystack and PayPal integration for online donations
- Fully blade-based frontend with advanced Bootstrap components
- Admin control over all user-facing content without manual code editing

## Technology Stack
- **Backend Framework:** Laravel (PHP)
- **Frontend Framework:** Blade templating engine with Bootstrap
- **Database:** MySQL

## Prerequisites
Before running this project, ensure you have the following installed:
- PHP >= 8.0
- Composer
- MySQL

## Installation Guide

1. **Clone the Repository**
```bash
git clone <repository-url>
cd <repository-folder>
```

2. **Install Dependencies**
```bash
composer install
```

3. **Set Up Environment Variables**
Copy the `.env.example` file to `.env` and update the configuration:
```bash
cp .env.example .env
```
Update the following fields in the `.env` file:
- `APP_NAME`
- `APP_URL`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `PAYPAL_CLIENT_ID`
- `PAYPAL_CLIENT_SECRET`
- `PAYPAL_MODE` (use `sandbox` for testing and `live` for production)
- `PAYSTACK_PUBLIC_KEY`
- `PAYSTACK_SECRET_KEY`
- `PAYSTACK_PAYMENT_URL` (default: `https://api.paystack.co/transaction/initialize`)

4. **Generate Application Key**
```bash
php artisan key:generate
```

5. **Run Migrations**
```bash
php artisan migrate
```

6. **Seed the Database (Optional)**
If your project includes seeder files, run:
```bash
php artisan db:seed
```

7. **Run the Application**
```bash
php artisan serve
```
Visit the application at `http://localhost:8000`.

## File Structure
```plaintext
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
└── vendor/
```

## Routes
Here are some of the important routes:

- **Authentication**:
  - `/login`: Login page for admins
  - `/logout`: Logout route

- **Public Pages**:
  - `/`: Link to the main church website

- **Donations**:
  - Paystack and PayPal payment endpoints are configured in `.env`. Ensure valid credentials are used.

## Contribution Guide
1. Fork the repository.
2. Create a new branch for your feature or bugfix:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your message here"
   ```
4. Push to your branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Submit a pull request.

## Troubleshooting
- Check if the `.env` file is correctly set up.
- Ensure you have run all migrations and seeders.
- Verify that the `storage` and `bootstrap/cache` directories are writable:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

## License
This project is licensed under the MIT License.

## Acknowledgments
Special thanks to the team and community supporting the development of this project. For more information about Golim, visit [Grace Operated Life International Ministry](#).

