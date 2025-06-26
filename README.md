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
git clone https://github.com/SubinRabin/laravel-scout-machine-test.git
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


Auth & Profile

POST	/api/login	User login, returns token
GET	/api/profile	Get current authenticated user

Blog Posts

GET	/api/blogpost	List blog posts
POST	/api/blogpost/store	Create a blog post
POST	/api/blogpost/update/{id}	Update blog post by ID
GET	/api/blogpost/destroy/{id}	Delete blog post by ID

Products

GET	/api/product	List products
POST	/api/product/store	Create a product
POST	/api/product/update/{id}	Update product by ID
GET	/api/product/destroy/{id}	Delete product by ID

Pages

GET	/api/page	List pages
POST	/api/page/store	Create a page
POST	/api/page/update/{id}	Update page by ID
GET	/api/page/destroy/{id}	Delete page by ID



FAQs

GET	/api/faq	List FAQs
POST	/api/faq/store	Create FAQ
POST	/api/faq/update/{id}	Update FAQ by ID
GET	/api/faq/destroy/{id}	Delete FAQ by ID


Utility

GET	/api/ping	Health check ping
