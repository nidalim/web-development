<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php pronadji_odabrane_stranice(); ?>

<?php
//za razliku od nova_strana.php, ne moramo da saljemo naslov_id
//jer vec postoji u stranice.naslov_id.
if (!$trenutni_stranice) {
    //stranice ID nedostaje ili nije validan
    //stranice se ne mogu pronaci u bazi
    redirect_to("upravljanje_sadrzajem.php");
}
?>

<?php if (isset($_POST['submit'])) {
    //procesuiranje forme
    $id = $trenutni_stranice["id"];
    $naziv_menija = mysql_prep($_POST["naziv_menija"]);
    $pozicija = (int)$_POST["pozicija"];
    $vidljivost = (int)$_POST["vidljivost"];
    //escape sadrzaj
    $sadrzaj = mysql_prep($_POST["sadrzaj"]);

    //validacija
    $neophodna_polja = array("naziv_menija", "pozicija", "vidljivost", "sadrzaj");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnom_duzinom = array("naziv_menija" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnom_duzinom);

    if (empty($errors)) {
        //azuriranje

        $query = "UPDATE stranice SET naziv_menija='{$naziv_menija}', pozicija={$pozicija}, vidljivost={$vidljivost}, sadrzaj='{$sadrzaj}' WHERE id={$id} LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result && mysqli_affected_rows($connection) == 1) {
            //Uspeh
            $_SESSION["message"] = "Izmena stranice uspesna";
            redirect_to("upravljanje_sadrzajem.php?stranice={$id}");
        } else {
            //Neuspeh
            $message = "Izmena stranice neuspesna";
        }
    }
} else {
    //verovatno GET request

}//kraj if(isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>


<div id="main">
    <div id="navigation">
        <?php echo navigation($trenutni_naslov, $trenutni_stranice); ?>
    </div>
    <div id="stranice">

        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Izmeni Stranicu: <?php echo htmlentities($trenutni_stranice["naziv_menija"]); ?></h2>

        <form action="izmeni_stranu.php?stranice=<?php echo urlencode($trenutni_stranice["id"]); ?>" method="post">
            <p><label>Ime Menija:</label>
                <input type="text" name="naziv_menija"
                       value="<?php echo htmlentities($trenutni_stranice["naziv_menija"]); ?>"/>
            </p>

            <p><label>Pozicija:</label>
                <select name="pozicija">
                    <?php
                    $stranice_set = pronadji_stranice_za_naslov($trenutni_stranice["naslov_id"], false);
                    $stranice_brojac = mysqli_num_rows($stranice_set);
                    for ($brojac = 1; $brojac <= $stranice_brojac; $brojac++) {
                        echo "<option value=\"{$brojac}\"";
                        if ($trenutni_stranice["pozicija"] == $brojac) {
                            echo " selected";
                        }
                        echo ">{$brojac}</option>";
                    }
                    ?>
                </select>
            </p>

            <p><label>Vidljivost:</label>
                <input type="radio" name="vidljivost" value="0" <?php if ($trenutni_stranice["vidljivost"] == 0) {
                    echo "checked";
                } ?> />Ne &nbsp;
                <input type="radio" name="vidljivost" value="1" <?php if ($trenutni_stranice["vidljivost"] == 1) {
                    echo "checked";
                } ?> />Da &nbsp;
            </p>

            <p><label>Sadrzaj:</label><br>
                <textarea name="sadrzaj" rows="20"
                          cols="80"><?php echo htmlentities($trenutni_stranice["sadrzaj"]); ?></textarea>
            </p>
            <input type="submit" name="submit" value="Izmeni Stranicu"/>
        </form>
        <br/>
        <a href="upravljanje_sadrzajem.php?stranice=<?php echo urlencode($trenutni_stranice["id"]); ?>">Otkaži</a>
        &nbsp;
        &nbsp;
        <a href="izbrisi_stranu.php?stranice=<?php echo urlencode($trenutni_stranice["id"]); ?>"
           onclick="return confirm('Da li ste sigurni?');">Izbrisite stranicu</a>
    </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
