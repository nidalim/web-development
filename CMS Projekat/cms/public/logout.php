<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>

<?php
//Verzija 1: Jednostavan logout
//session_start(); neophodno
$_SESSION["admin_id"] = null;
$_SESSION["username"] = null;

redirect_to("login.php");
?>

<?php
/*//Verzija 2: unistavanje sesije
//pretpostavka da nista ne treba da ostane u sesiji
session_start();
//ubacujemo sesiju u prazan niz da bi njim obuhvatili sve sto se nalazi u sesiji
//
$_SESSION=array();
//proveramo ako postoji cookie i ponistavamo ga(stavljamo vreme u proslost da vise ne vazi)
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');
}
//unistavamo sesiju na serveru
session_destroy();
redirect_to("login.php");*/
?>