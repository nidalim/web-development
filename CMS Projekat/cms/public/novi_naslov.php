<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

<?php pronadji_odabrane_stranice(); ?>

<div id="main">
    <div id="navigation">
        <?php echo navigation($trenutni_naslov, $trenutni_stranice); ?>
    </div>
    <div id="stranice">

        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Napravi Naslov</h2>

        <form action="napravi_naslov.php" method="post">
            <p><label>Ime Menija:</label>
                <input type="text" name="naziv_menija" value=""/>
            </p>

            <p><label>Pozicija:</label>
                <select name="pozicija">
                    <?php
                    $naslov_podesen = pronadji_sve_naslove(false);
                    $naslov_brojac = mysqli_num_rows($naslov_podesen);
                    for ($brojac = 1; $brojac <= $naslov_brojac + 1; $brojac++) {
                        echo "<option value=\"{$brojac}\">{$brojac}</option>";
                    }
                    ?>
                </select>
            </p>

            <p><label>Vidljivost:</label>
                <input type="radio" name="vidljivost" value="0"/>No &nbsp;
                <input type="radio" name="vidljivost" value="1"/>Yes &nbsp;
            </p>
            <input type="submit" name="submit" value="Napravi Naslov"/>
        </form>
        <br/>
        <a href="upravljanje_sadrzajem.php">Otkazi</a>
    </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
