<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>

<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

    <div id="main">
        <div id="navigation">&nbsp</div>
        <div id="stranice">
            <h2>Administratorski Meni</h2>
            <!--Ovde ispod mozemo iskorisiti username koji smo ubacili u $_SESSION da bismo ga prikazali korisniku/adminu-->
            <p>Dobrodosli u administratorki panel, <?php echo htmlentities($_SESSION["username"]); ?></p>
            <ul>
                <li><a href="upravljanje_sadrzajem.php">Upravljanje Sadržajem Sajta</a></li>
                <li><a href="upravljanje_administratorima.php">Upravljanje Administratorima</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>