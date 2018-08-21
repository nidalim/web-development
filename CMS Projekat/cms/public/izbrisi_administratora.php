<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$admin = pronadji_administratora_by_id($_GET["id"]);

if (!$admin) {
    //admin ID nedostaje ili nije validan
    //admin ne moze biti pronadjen u bazi
    redirect_to("upravljanje_administratorima.php");
}

$id = $admin["id"];
$query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    //Uspeh
    $_SESSION["message"] = "Administrator izbrisan";
    redirect_to("upravljanje_administratorima.php");
} else {
    //Neuspeh
    $_SESSION["message"] = "Brisanje administratora neuspesno";
    redirect_to("upravljanje_administratorima.php");
}

?>
