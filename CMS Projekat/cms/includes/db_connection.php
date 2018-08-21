<?php
//Ostavljen root trenutno radi lakseg pristupa. Izmeniti po zelji
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "cms");
//Korak 1: Napraviti vezu ka bazi

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
//Proveriti da li veza funkcionise
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
} else {

}
?>