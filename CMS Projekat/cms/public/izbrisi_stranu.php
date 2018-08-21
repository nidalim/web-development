<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$trenutni_stranice = pronadji_stranice_by_id($_GET["stranice"], false);
if (!$trenutni_stranice) {
    //stranice ID nedostaje ili nije validan
    //stranice ne mogu biti pronadjene u bazi
    redirect_to("upravljanje_sadrzajem.php");
}

$id = $trenutni_stranice["id"];
$query = "DELETE FROM stranice WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    //Uspeh
    $_SESSION["message"] = "Brisanje stranice uspesno";
    redirect_to("upravljanje_sadrzajem.php");
} else {
    //Neuspeh
    $_SESSION["message"] = "Brisanje stranice neuspesno";
    redirect_to("upravljanje_sadrzajem.php?stranice={$id}");
}
?>