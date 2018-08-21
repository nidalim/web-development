<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/funkcije.php"); ?>
<?php confirm_logged_in(); ?>
<?php $admin_set = pronadji_sve_administratore(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header_admin.php"); ?>

    <div id="main">
        <div id="navigation">
            <!--<br/>-->
            <a class="meni" href="admin.php">&equiv;</a><br/><br/>
        </div>
        <div id="stranice">
            <?php echo message(); ?>
            <h2>Upravljanje Administratorima</h2>
            <table>
                <tr>
                    <th style="text-align: left;width: 200px;">Korisnicko Ime</th>
                    <th colspan="2" style="text-align: left;">Radnje</th>
                </tr>
                <?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
                    <tr>
                        <td><?php echo htmlentities($admin["username"]); ?>
                            <br/>
                        </td>
                        <td><a href="izmeni_administratora.php?id=<?php echo urlencode($admin["id"]); ?>">Izmeni</a>
                        </td>
                        <td><a href="izbrisi_administratora.php?id=<?php echo urlencode($admin["id"]); ?>"
                               onclick="return confirm('Da li ste sigurni?');">Izbrisi</a></td>
                    </tr>
                <?php } ?>
            </table>
            <br/>
            + <a href="novi_administrator.php">Dodaj novog administratora</a>

        </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>