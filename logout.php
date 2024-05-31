<?php
session_start();
session_unset();
session_destroy();
header("Location: /LibraryMS/PreviousLogin/previouslogin.php");
exit();
?>
