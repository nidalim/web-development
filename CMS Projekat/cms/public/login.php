<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php

$username="";

if(isset($_POST['submit'])) {
    //procesuiranje forme

    //validacija
    $neophodna_polja = array("username", "password");
    validacija_prisustva($neophodna_polja);


    if (empty($errors)) {
        //pokusaj login-a

        //username stavljeno u varijablu da bi se moglo iskoristiti u formi dole kao value...
        //...da bi se ispisalo korisniku ako je prethodno submitovao formu da ne bi ponovo kucao username.
        //inace je moglo u funkciju kao $_POST["username"]
        $username=$_POST["username"];
        $password=$_POST["password"];

        $pronadjen_admin=attempt_login($username,$password);

        if ($pronadjen_admin) {
            //uspeh
            //obelezava korisnika kao ulogovanog

            //nikada ne stavljamo ovo u cookie jer je vidljivo vec u session jer je na strani servera
            $_SESSION["admin_id"]=$pronadjen_admin["id"];
            //username u session da bismo mogli da prikazemo korisniku njegovo ime gde god hocemo,ne zbog autentifikacije
            //za autentifikaciju koristimo samo admin_id
            $_SESSION["username"]=$pronadjen_admin["username"];

            redirect_to("admin.php");
        } else {
            //Neuspeh
            //Namerno ostavljeno da se ne ispise konkretno da li je pogresna sifra ili korisnicko ime zbog hakovanja
            $_SESSION["message"] = "Korisnicko ime/sifra nisu pronadjeni.";
        }

    }else{
        //GET request

    }
}//kraj if(isset($_POST['submit']))
?>

<?php $layout_context="admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

<div id="main">
    <div id="navigation">
        &nbsp;
    </div>
    <div id="stranice">

        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Login</h2>
        <form action="login.php" method="post">
            <p><label>Korisnicko Ime:</label>
                <input type="text" name="username" value="<?php echo htmlentities($username); ?>"/>
            </p>
            <p><label>Sifra:</label>
                <input type="password" name="password" value=""/>
            </p>
            <input type="submit" name="submit" value="Potvrdi"/>
        </form>

    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>