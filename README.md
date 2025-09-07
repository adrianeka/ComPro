# ComPro Laravel Project

Sebuah company profile website yang dibangun menggunakan Laravel 12 dengan template modern dan responsive.

## 📋 Prerequisites

Pastikan kamu sudah install software berikut:
- **PHP** >= 8.1
- **Composer** >= 2.0
- **Node.js** >= 20.19.1
- **npm** >= 9.0
- **MySQL** atau database lainnya

## 🚀 Installation & Setup

### 1. Clone Repository
```bash
git clone https://github.com/adrianeka/ComPro.git
cd ComPro
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies  
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan database settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
# Create database tables
php artisan migrate

# Seed database dengan data sample (opsional)
php artisan db:seed
```

### 6. Build Assets
```bash
# Untuk development
npm run dev

# Untuk production
npm run build
```

### 7. Run Application
```bash
# Start Laravel development server
php artisan serve
```

## 📁 Project Structure

```
ComPro/
├── app/               # Laravel application logic
├── resources/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   └── views/        
