<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php
if (isset($_POST['submit'])) {
    //forma

    //validacija
    $neophodna_polja = array("username", "password");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnom_duzinom = array("username" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnom_duzinom);

    if (empty($errors)) {
        //napravi

        $username = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);

        $query = "INSERT INTO admins (username, hashed_password) VALUES ( '{$username}', '{$hashed_password}')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            //Uspeh
            $_SESSION["message"] = "Pravljenje administratora uspesno";
            redirect_to("upravljanje_administratorima.php");
        } else {
            //Neuspeh
            $_SESSION["message"] = "Pravljenje administratora neuspesno";
        }

    } else {
        //GET request

    }
}//kraj if(isset($_POST['submit']))
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

    <div id="main">
        <div id="navigation">
            &nbsp;
        </div>
        <div id="stranice">

            <?php echo message(); ?>
            <?php echo form_errors($errors); ?>

            <h2>Napravi Admina</h2>

            <form action="novi_administrator.php" method="post">
                <p><label>Korisnicko Ime:</label>
                    <input type="text" name="username" value=""/>
                </p>

                <p><label>Sifra:</label>
                    <input type="password" name="password" value=""/>
                </p>
                <input type="submit" name="submit" value="Napravi Administratora"/>
            </form>
            <br/>
            <a href="upravljanje_administratorima.php">Otkazi</a>
        </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>