<?php
session_start();
session_destroy();
header("Location: layanan.php");
exit();
?>
