# 🔍 Laravel Website-Wide Search Backend

This project is a Laravel 12 application that implements a **website-wide search** across multiple content types (Blog Posts, Products, Pages, FAQs) using **Laravel Scout**, **MeiliSearch**, **Laravel Queues**, and **Docker**.

---

## 🚀 Features

- 🔎 Unified full-text search across blog posts, products, pages, and FAQs
- 🧠 Fuzzy and partial match support via MeiliSearch
- 📦 Queue-based indexing for performance
- 🗂️ Search ranking by recency or relevance
- 📜 Search suggestions (typeahead-style)
- 🔐 Admin-only search logs and manual reindexing
- 🐳 Dockerized setup with PHP-FPM, Nginx, MySQL, Redis, and MeiliSearch

---

## 🛠️ Tech Stack

- Laravel 12
- Laravel Scout + MeiliSearch
- Redis (Queue driver)
- Docker & Docker Compose
- MySQL 8
- PHP 8.3
- Nginx

---

## 📦 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo


cp .env.example .env


### 2. Docker Setup
cd docker 

docker-compose up -d

cd ..

docker exec -it laravel_app bash


composer install
php artisan key:generate
php artisan migrate --seed
php artisan scout:import "App\Models\BlogPost"
php artisan scout:import "App\Models\Product"
php artisan scout:import "App\Models\Page"
php artisan scout:import "App\Models\Faq"


php artisan queue:work



📡 API Endpoints

Method	Endpoint	Description

GET	/api/search?q=...	Unified search results
GET	/api/search/suggestions?q=...	Typeahead-style suggestions
GET	/api/search/logs	Top searched terms (admin only)


