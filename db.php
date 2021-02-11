<?php
$dns = 'mysql:host=localhost;dbname=gles_db30112020';
$username = 'root';
$password = 'password';
$options = [];

try {
    $connexion = new PDO($dns, $username, $password, $options);
} catch (PDOException $e) {
    
}