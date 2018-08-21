<?php
session_start();

function message()
{
    if (isset($_SESSION["message"])) {
        $rezultat = "<div class=\"message\">";
        $rezultat .= htmlentities($_SESSION["message"]);
        $rezultat .= "</div>";

        //Ciscenje
        $_SESSION["message"] = null;

        return $rezultat;
    }
}

function errors()
{
    if (isset($_SESSION["errors"])) {
        $errors = $_SESSION["errors"];

        //Ciscenje
        $_SESSION["errors"] = null;

        return $errors;
    }
}

?>