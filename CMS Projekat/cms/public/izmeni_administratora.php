<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php
$admin = pronadji_administratora_by_id($_GET["id"]);

if (!$admin) {
    //admin ID nedostaje ili nije validan
    //admin ne moze biti pronadjen u bazi
    redirect_to("upravljanje_administratorima.php");
}
?>

<?php
if (isset($_POST['submit'])) {
    //Procesuiranje forme

    //validacija
    $neophodna_polja = array("username", "password");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnom_duzinom = array("username" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnom_duzinom);

    if (empty($errors)) {
        //Napravi

        $id = $admin["id"];
        $username = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);

        $query = "UPDATE admins SET username='{$username}', hashed_password='{$hashed_password}' WHERE id={$id} LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            //Uspeh
            $_SESSION["message"] = "Ažuriranje administratora uspešno";
            redirect_to("upravljanje_administratorima.php");
        } else {
            //Neuspeh
            $_SESSION["message"] = "Ažuriranje administratora neuspešno";
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

            <h2>Izmeni podešavanja administratora: <?php echo urlencode($admin["username"]); ?></h2>

            <form action="izmeni_administratora.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
                <p><label>Korisnicko ime:</label>
                    <input type="text" name="username" value="<?php echo htmlentities($admin["username"]) ?>"/>
                </p>

                <p><label>Šifra:</label>
                    <input type="password" name="password" value=""/>
                </p>
                <input type="submit" name="submit" value="Izmeni podešavanja"/>
            </form>
            <br/>
            <a href="upravljanje_administratorima.php">Otkaži</a>
        </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>