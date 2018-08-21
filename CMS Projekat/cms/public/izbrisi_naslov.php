<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$trenutni_naslov = pronadji_naslov_by_id($_GET["naslov"], false);
if (!$trenutni_naslov) {
    //naslov ID nedostaje ili nije validan
    //naslov nije u bazi
    redirect_to("upravljanje_sadrzajem.php");
}
//ne mozete izbrisati naslove sa decom pre nego sto uklonite svu decu
$stranice_set = pronadji_stranice_za_naslov($trenutni_naslov["id"], false);
if (mysqli_num_rows($stranice_set) > 0) {
    $_SESSION["message"] = "Ne mozete izbrisati naslov sa stranicama";
    redirect_to("upravljanje_sadrzajem.php?naslov={$trenutni_naslov["id"]}");
}

$id = $trenutni_naslov["id"];
$query = "DELETE FROM naslovi WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    //Uspeh
    $_SESSION["message"] = "Brisanje naslova uspesno";
    redirect_to("upravljanje_sadrzajem.php");
} else {
    //Neuspeh
    $_SESSION["message"] = "Brisanje naslova neuspesno";
    redirect_to("upravljanje_sadrzajem.php?naslov={$id}");
}
?>