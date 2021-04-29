<?php

/**
  * Configuration for database connection
  * This file contains all variables needed
  * to create the path for mysql connection
  *
  */

$host       = "localhost";      //my mysql server
$username   = "root";           //my username
$password   = "chipss123";      //my password
$dbname     = "adoptable_dogs"; //my database name
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );