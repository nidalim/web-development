<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<!-- radimo include svih neophodnih fajlova koji sadrze neophodne funkcije, konekciju ka bazi na pocetku svakog fajla-->
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header_public.php"); ?>

<?php pronadji_odabrane_stranice(true); ?>

<div id="main">
    <div id="navigation">

        <?php echo public_navigation($trenutni_naslov, $trenutni_stranice); ?>

    </div>

    <div id="stranice">

        <?php if ($trenutni_stranice) { ?>

            <h2><?php echo htmlentities($trenutni_stranice["naziv_menija"]); ?></h2>

            <?php echo nl2br(htmlentities($trenutni_stranice["sadrzaj"])); ?>

        <?php } else { ?>

            <p>Dobrodošli</p>

        <?php } ?>
    </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
