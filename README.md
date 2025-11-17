✅ README.md — Plataforma de Reservas de Hotel (Laravel 10)

Documento de presentacion
[TALLER GRUPAL LARAVER PREVIO FINAL.docx](https://github.com/user-attachments/files/23593824/TALLER.GRUPAL.LARAVER.PREVIO.FINAL.docx)


# 🏨 Plataforma de Reservas de Hotel — Laravel 10

Sistema CRUD completo desarrollado en **Laravel 10**, **Blade**, **TailwindCSS**, **MySQL** y **JavaScript Vanilla**, con funcionalidades avanzadas como calendario de disponibilidad, check-in/check-out, filtros inteligentes y reportes en PDF.

Este proyecto fue desarrollado como parte del **Taller Grupal – Desarrollo de Sistemas CRUD en Laravel**.

---

## 📌 Tecnologías Utilizadas

- **Laravel 10+ (Monolítico)**
- **PHP 8.3.27**
- **Blade (Frontend)**
- **Tailwind CSS**
- **MySQL**
- **JavaScript Vanilla**
- **DomPDF (Reportes PDF)**

---

# 📁 Estructura General del Proyecto
<img width="160" height="376" alt="image" src="https://github.com/user-attachments/assets/fe1b5eb5-092b-4dab-9168-1d45904f426e" />



---

# 🧩 Módulos del Sistema

## 🛏️ 1. Habitaciones
CRUD completo:
- Número de habitación
- Tipo
- Precio
- Estado (Disponible / Ocupada)
- Foto

Incluye:
- Validaciones
- PDF de habitaciones
- Filtros

---

## 👤 2. Clientes
CRUD completo:
- Nombre
- Documento
- Email
- Teléfono

Incluye:
- PDF de clientes
- Validaciones

---

## 📅 3. Reservas
CRUD completo:
- Selección de habitación
- Selección de cliente
- Fecha entrada / salida
- Servicios adicionales
- Prevención de solapamiento de fechas
- Estado dinámico según el día actual

Incluye:
- PDF de reservas
- Validaciones con FormRequest
- Filtros por fecha y búsqueda

---

# 🌟 Funcionalidades Especiales

## 🟢 Calendario de Disponibilidad (FullCalendar)
El sistema muestra:

- Habitaciones disponibles (verde)
- Habitaciones ocupadas (rojo)
- Reservas con nombre del cliente
- Filtro por número de habitación
- Filtro por estado (Disponible / Ocupada)
- Tooltip elegante
- Acceso rápido a editar reserva desde el evento

---

## 🔐 Check-in / Check-out
Implementado de forma correcta:

### ✔ Check-in
Marca que el cliente **ya está usando su reserva**.  
Se activa solo si:
- La fecha actual está dentro del rango de la reserva

### ✔ Check-out
- Registra salida
- Libera la habitación
- **Elimina la reserva** automáticamente

---

# 📄 Reportes PDF
Generados con **DomPDF**:

- PDF de Habitaciones  
- PDF de Clientes  
- PDF de Reservas  

Tablas ordenadas y limpias con estilos consistentes.

---

# 📦 Instalación en Linux (Ubuntu/Debian)

### 1. Clonar repositorio
bash
git clone https://github.com/usuario/sistema-reservas-fesc.git
cd sistema-reservas-fesc

2. Instalar dependencias de backend
composer install

3. Instalar dependencias frontend
npm install
npm run build

4. Crear el archivo .env
cp .env.example .env

5. Configurar la base de datos

En .env modificar:

DB_DATABASE=reservas_db
DB_USERNAME=root
DB_PASSWORD=

6. Generar key de Laravel
php artisan key:generate

7. Ejecutar migraciones + seeders
php artisan migrate --seed

8. Levantar servidor local
php artisan serve

🖥️ Capturas de Pantalla

Inserta aquí las imágenes:

📌 Dashboard
<img width="680" height="401" alt="image" src="https://github.com/user-attachments/assets/92e53b90-01db-447e-aea5-a79b89276482" />


📌 CRUD Habitaciones
<img width="682" height="491" alt="image" src="https://github.com/user-attachments/assets/df1c5948-abd3-4cd9-8e06-49dc3db69fa6" />
<img width="683" height="607" alt="image" src="https://github.com/user-attachments/assets/cb578008-69ac-4c6c-a711-ce55a0614a16" />


📌 CRUD Clientes
<img width="683" height="420" alt="image" src="https://github.com/user-attachments/assets/4920533a-9b52-45d0-bafa-5050a8f4184d" />
<img width="682" height="530" alt="image" src="https://github.com/user-attachments/assets/ff81d159-2461-43ef-b738-ff05e8bbae01" />


📌 CRUD Reservas
<img width="682" height="506" alt="image" src="https://github.com/user-attachments/assets/1482decf-d42f-47a3-99cd-910770a039b2" />
<img width="668" height="613" alt="image" src="https://github.com/user-attachments/assets/7df26062-4fba-4b30-b48a-647f85993f68" />

📌 Calendario de Disponibilidad
<img width="680" height="552" alt="image" src="https://github.com/user-attachments/assets/82e4ac55-f9ea-41f5-9775-7720e966967f" />

📌 Check-in / Check-out
<img width="679" height="419" alt="image" src="https://github.com/user-attachments/assets/49d90b75-9e19-4497-bda8-2e5032ae95f5" />
<img width="213" height="245" alt="image" src="https://github.com/user-attachments/assets/04e4dfaa-34eb-447d-acda-695632d7ea53" />


📌 Reportes PDF

<img width="681" height="208" alt="image" src="https://github.com/user-attachments/assets/f9352434-4928-44ad-b87c-e0d8af51953d" />
<img width="678" height="141" alt="image" src="https://github.com/user-attachments/assets/c8356b79-ba50-44a4-be2b-2b7793c19b5f" />
<img width="683" height="150" alt="image" src="https://github.com/user-attachments/assets/96afa4da-b195-42cf-aa51-ec4afe7880a2" />

<img width="684" height="307" alt="image" src="https://github.com/user-attachments/assets/25d99062-fdde-423d-b890-39382a2d4a93" />

  ---
  
🎥 Video Explicativo 

Los 3 CRUD funcionando
Creación / edición / eliminación
Generación de PDF
Calendario y filtros
Check-in y Check-out
Código relevante (breve)
Base de datos funcionando

link: https://drive.google.com/drive/folders/1foop9xFM_bvUuG9XPRVTPPWMNO-wdKX6?usp=sharing

--- 
👥 Integrantes del Grupo

BAIRON SEBASTIAN ARDILA MENDOZA
JULIAN ANDRES PARADA CUADROS

🏁 Estado del Proyecto

✔ Completado
✔ Probado
✔ Funcional

📞 Recursos de Ayuda

Laravel → https://laravel.com
TailwindCSS → https://tailwindcss.com
DomPDF → https://github.com/barryvdh/laravel-dompdf

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
