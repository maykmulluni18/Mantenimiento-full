# Mantenimiento-full
Requisitos:
- Larabel: 10
- Php: 8.1>
- Npm: 16.20.0

Frontend:
- yarn install
- yarn serve

Backend:
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan serve

Si en caso de trabajar el frontend de larabel:
- npm install
- npm run dev
