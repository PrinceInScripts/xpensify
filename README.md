# Expense Management System

🚀 Built for Odoo x Amalthea Hackathon 2025

## Problem
Manual expense reimbursement is slow, error-prone, and lacks transparency.

<!-- ## Solution
A Laravel-based Expense Management System with:
- ✅ Role-based authentication (Admin, Manager, Employee, CFO)
- ✅ Expense submission with multi-currency support
- ✅ Approval workflows (sequential & conditional rules)
- ✅ OCR-based receipt scanning
- ✅ Dashboard & expense tracking -->

## Tech Stack
- Laravel 11 (Backend)
- MySQL/Postgres (Database)
- TailwindCSS + Blade (Frontend)

## Setup
```bash
git clone https://github.com/<your-username>/expense-management-system.git
cd expense-management-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
