<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

<?php pronadji_odabrane_stranice(); ?>

<div id="main">
    <div id="navigation">
        <!--<br/>-->
        <a class="meni" href="admin.php">&equiv;</a><br/><br/>
        <?php echo navigation($trenutni_naslov, $trenutni_stranice); ?>
        <br/>
        + <a href="novi_naslov.php">Dodaj Naslov</a>
    </div>

    <div id="stranice">
        <?php echo message(); ?>
        <?php if ($trenutni_naslov) { ?>
            <h2>Upravljanje Naslovima</h2>

            Ime Menija: <?php echo htmlentities($trenutni_naslov["naziv_menija"]); ?><br/>
            Pozicija:<?php echo $trenutni_naslov["pozicija"]; ?><br/>
            Vidljivost:<?php echo $trenutni_naslov["vidljivost"] == 1 ? 'Da' : 'Ne'; ?><br/>
            <br/>
            <a href="izmeni_naslov.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>">Izmeni Naslov</a>

            <div style="margin-top: 2em;border-top: 1px solid #EFEFEF;">
                <h3>Stranice u ovom naslovu</h3>
                <ul>

                    <?php
                    $naslov_stranice = pronadji_stranice_za_naslov($trenutni_naslov["id"], false);
                    while ($stranice = mysqli_fetch_assoc($naslov_stranice)) {
                        echo "<li>";
                        $safe_stranice_id = urlencode($stranice["id"]);
                        echo "<a href=\"upravljanje_sadrzajem.php?stranice={$safe_stranice_id}\">";
                        echo htmlentities($stranice["naziv_menija"]);
                        echo "</a>";
                        echo "</li>";
                    }
                    ?>

                </ul>
                <br/>

                + <a href="nova_strana.php?naslov=<?php echo urlencode($trenutni_naslov["id"]); ?>">Dodaj novu stranicu
                    u ovom naslovu</a>

            </div>

        <?php } elseif ($trenutni_stranice) { ?>
            <h2>Izmeni Stranu</h2>

            Ime Menija: <?php echo htmlentities($trenutni_stranice["naziv_menija"]); ?><br/>
            Pozicija:<?php echo $trenutni_stranice["pozicija"]; ?><br/>
            Vidljivost:<?php echo $trenutni_stranice["vidljivost"] == 1 ? 'Da' : 'Ne'; ?><br/>
            Sadrzaj:<br/>
            <div class="view-sadrzaj">
                <?php echo htmlentities($trenutni_stranice["sadrzaj"]); ?>
            </div>
            <br/>
            <br/>
            <a href="izmeni_stranu.php?stranice=<?php echo urlencode($trenutni_stranice['id']); ?>">Izmeni Stranicu</a>
        <?php } else { ?>
            Izaberite Naslov ili Stranicu
        <?php } ?>
    </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
