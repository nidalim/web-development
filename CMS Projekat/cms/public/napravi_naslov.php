<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>
<?php
if (isset($_POST['submit'])) {
    //vrednosti forme u $_POST
    $naziv_menija = mysql_prep($_POST["naziv_menija"]);
    $pozicija = (int)$_POST["pozicija"];
    $vidljivost = (int)$_POST["vidljivost"];

    //validacija
    $neophodna_polja = array("naziv_menija", "pozicija", "vidljivost");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnog_duzinom = array("naziv_menija" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnog_duzinom);

    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        redirect_to("novi_naslov.php");
    } else {
        //ovde kod ako treba
    }

    //upit za bazu
    $query = "INSERT INTO naslovi (naziv_menija, pozicija, vidljivost) VALUES ('{$naziv_menija}', {$pozicija}, {$vidljivost})";

    $result = mysqli_query($connection, $query);

    if ($result) {
        //Uspeh
        $_SESSION["message"] = "Pravljenje naslova uspesno";
        redirect_to("upravljanje_sadrzajem.php");
    } else {
        //Neuspeh
        $_SESSION["message"] = "Pravljenje naslova neuspesno";
        redirect_to("novi_naslov.php");
    }

} else {
    //GET request
    redirect_to("novi_naslov.php");
}
?>
<?php
//Korak 5: Zatvaranje baze podataka
if (isset($connection)) {
    mysqli_close($connection);
}
?>