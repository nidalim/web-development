<div id="footer">Copyright <?php echo date("Y"); ?>, Miladin Usendic</div>
</body>
</html>
<?php
//Korak 5: Zatvaramo konekciju ka bazi
if (isset($connection)) {
    mysqli_close($connection);
}
?>