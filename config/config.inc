<?php
// Alap konfiguráció

$baseURL = "https://autoberlo24.hu";

// ADATBÁZIS ADATOK
$database_host = 'localhost';
$database_user = 'autoberl_db';
$database_password = 'jNQvNZBrY7Jeqrsm75HZ';
$database_db = 'autoberl_db';

// LOG
$log_enabled = true;

// MAIL (FIGYELEM: éles projektben .env vagy gitignore!)
<<<<<<< Updated upstream
$mail_host = "smtp.gmail.com";
$mail_user = "";
$mail_password = "";
=======
$mail_host = "mail.autoberlo24.hu";
$mail_user = "rendszer@autoberlo24.hu";
$mail_password ="2N3GGjXypqhz7dwP3SK9";
>>>>>>> Stashed changes

// PDO-hoz előkészítve
$connectionString = "mysql:host=$database_host;dbname=$database_db;charset=utf8mb4";

$connectionOptions = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
