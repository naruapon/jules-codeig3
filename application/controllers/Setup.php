<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    public function database()
    {
        // Database credentials from application/config/database.php
        // I am reading them here manually because the DB driver won't connect without a db name
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'company';

        // Create connection
        $conn = new mysqli($hostname, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS ".$database." CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
        if ($conn->query($sql) === TRUE) {
            echo "Database '{$database}' created successfully or already exists.";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $conn->close();
    }
}
