<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<p>
Тестовое задание на вакансию "РНР-программист" от ТРК Горки<br />
Исполнитель: Перминов Илья Викторович 89525128052<br />
<a href="https://chelyabinsk.hh.ru/resume/2f0b8a94ff0b5e94100039ed1f497379636f35">Резюие на hh.ru</a>
</p>

## Установка и запуск
1. Скачать проект

   ``` sh
   git clone https://github.com/ivelini/praweb
   ```

2. В каталоге проекта выполнить команды
   ``` sh
   // Установка laravel
   composer install
   npm install
   
3. Конфигурация

   ``` sh
   // .env файл
   .env.example --> .env
   Прописать название базы, логин, пароль
   
   php artisan key:generate
   php artisan migrate --seed
   `````

4. Запуск веб сервера

   ``` sh
   php artisan serve
   ```
