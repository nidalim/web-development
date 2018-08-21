<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("../includes/funkcije_validacije.php"); ?>

<?php pronadji_odabrane_stranice(); ?>

<?php

//ne mozemo dodati nove stranice ukoliko nemamo naslov za roditelja
if (!$trenutni_naslov) {
    //naslov ID nedostaje ili je nevalidan
    //naslova nema u bazi
    redirect_to("upravljanje_sadrzajem.php");
}
?>
<?php
if (isset($_POST['submit'])) {
    //forma

    //validacija
    $neophodna_polja = array("naziv_menija", "pozicija", "vidljivost", "sadrzaj");
    validacija_prisustva($neophodna_polja);

    $polja_sa_maksimalnom_duzinom = array("naziv_menija" => 30);
    validacija_maksimalne_duzine($polja_sa_maksimalnom_duzinom);

    if (empty($errors)) {
        //napravi

        //dodati naslov id!
        $naslov_id = $trenutni_naslov["id"];
        $naziv_menija = mysql_prep($_POST["naziv_menija"]);
        $pozicija = (int)$_POST["pozicija"];
        $vidljivost = (int)$_POST["vidljivost"];
        //escape sadrzaj
        $sadrzaj = mysql_prep($_POST["sadrzaj"]);

        $query = "INSERT INTO stranice (naslov_id, naziv_menija, pozicija, vidljivost, sadrzaj) VALUES ({$naslov_id},'{$naziv_menija}', {$pozicija}, {$vidljivost},'{$sadrzaj}')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            //Uspeh
            $_SESSION["message"] = "Pravljenje stranice uspesno";
            redirect_to("upravljanje_sadrzajem.php?naslov=" . urlencode($trenutni_naslov["id"]));
        } else {
            //Neuspeh
            $_SESSION["message"] = "Pravljenje stranice neuspesno";
        }

    } else {
        //GET request

    }

}//kraj; if(!issset($_POST['submit']))
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

            <h2>Napravi Naslov</h2>

            <form action="nova_strana.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>" method="post">
                <p>Ime Menija:
                    <input type="text" name="naziv_menija" value=""/>
                </p>

                <p>Pozicija:
                    <select name="pozicija">
                        <?php
                        $stranice_set = pronadji_stranice_za_naslov($trenutni_naslov["id"], false);
                        $stranice_brojac = mysqli_num_rows($stranice_set);
                        for ($brojac = 1; $brojac <= ($stranice_brojac + 1); $brojac++) {
                            echo "<option value=\"{$brojac}\">{$brojac}</option>";
                        }
                        ?>
                    </select>
                </p>

                <p>Vidljivost:
                    <input type="radio" name="vidljivost" value="0"/>Ne &nbsp;
                    <input type="radio" name="vidljivost" value="1"/>Da &nbsp;
                </p>

                <p>Sadrzaj:<br>
                    <textarea name="sadrzaj" rows="20" cols="80"></textarea>
                </p>
                <input type="submit" name="submit" value="Napravi Stranu"/>
            </form>
            <br/>
            <a href="upravljanje_sadrzajem.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>">Cancel</a>
        </div>
    </div>
<?php include("../includes/layouts/footer.php"); ?>