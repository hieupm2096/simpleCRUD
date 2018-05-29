<?php
/**
 * Config for database connection
 *
 */

$host = "localhost";
$port = "3306";
$username = "root";
$password = "Virgo 209";
$dbname = "phpSimpleCRUD"; // will use later
$dsn = "mysql:host=$host;port=$port;dbname=$dbname"; // will use later
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
