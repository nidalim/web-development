<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php pronadji_odabrane_stranice(); ?>
<?php
if (!$trenutni_naslov) {
    //naslov ID nedostaje ili nije validan
    //naslov ne moze biti pronadjen u bazi
    redirect_to("upravljanje_sadrzajem.php");
}
?>

<?php
if (isset($_POST['submit'])) {

    //validacija
    $neophodna_polja = array("naziv_menija", "pozicija", "vidljivost");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnog_duzinom = array("naziv_menija" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnog_duzinom);

    if (empty($errors)) {
        //azuriranje

        $id = $trenutni_naslov["id"];
        $naziv_menija = mysql_prep($_POST["naziv_menija"]);
        $pozicija = (int)$_POST["pozicija"];
        $vidljivost = (int)$_POST["vidljivost"];
        //Database query
        $query = "UPDATE naslovi SET naziv_menija='{$naziv_menija}', pozicija={$pozicija}, vidljivost={$vidljivost} WHERE id={$id} LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) >= 0) {
            //Uspeh
            $_SESSION["message"] = "Izmena naslova uspesna";
            redirect_to("upravljanje_sadrzajem.php");
        } else {
            //Neuspeh
            $message = "Izmena naslova neuspesna";
        }
    }
} else {
    // ovo je verovatno GET request

}// kraj if(isset($_POST['submit']))
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>


<div id="main">
    <div id="navigation">
        <?php echo navigation($trenutni_naslov, $trenutni_stranice); ?>
    </div>
    <div id="stranice">

        <?php
        //$message je samo varijabla i ne koristi sesiju u ovom slucaju
        if (!empty($message)) {
            echo "<div class=\"message\">" . htmlentities($message) . "</div>";
        }
        ?>

        <?php echo form_errors($errors); ?>

        <h2>Izmeni Naslov: <?php echo htmlentities($trenutni_naslov["naziv_menija"]); ?></h2>

        <form action="izmeni_naslov.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>" method="post">
            <p><label>Ime Menija:</label>
                <input type="text" name="naziv_menija"
                       value="<?php echo htmlentities($trenutni_naslov["naziv_menija"]); ?>"/>
            </p>

            <p><label>Pozicija:</label>
                <select name="pozicija">
                    <?php
                    $naslov_podesen = pronadji_sve_naslove(false);
                    $naslov_brojac = mysqli_num_rows($naslov_podesen);
                    for ($brojac = 1; $brojac <= $naslov_brojac; $brojac++) {
                        echo "<option value=\"{$brojac}\"";
                        if ($trenutni_naslov["pozicija"] == $brojac) {
                            echo " selected";
                        }

                        echo ">{$brojac}</option>";
                    }
                    ?>
                </select>
            </p>

            <p><label>Vidljivost:</label>
                <input type="radio" name="vidljivost" value="0" <?php if ($trenutni_naslov["vidljivost"] == 0) {
                    echo "checked";
                } ?> />Ne &nbsp;
                <input type="radio" name="vidljivost" value="1" <?php if ($trenutni_naslov["vidljivost"] == 1) {
                    echo "checked";
                } ?> />Da &nbsp;
            </p>
            <input type="submit" name="submit" value="Izmeni Naslov"/>
        </form>
        <br/>
        <a href="upravljanje_sadrzajem.php">Otkazi</a>
        &nbsp;
        &nbsp;
        <a href="izbrisi_naslov.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>"
           onclick="return confirm('Da li ste sigruni?');">Izbrisi naslov</a>
    </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
