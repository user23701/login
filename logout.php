<?php
session_start();
session_destroy(); // session wird zerstört
setcookie(session_name(),session_id(),time()-1);    // falls eingeloggt bleiben an, cookie wird zerstört weil zeit in vergangenheit liegt
header('location: index.php');                  // weiterleiten
exit();
?>
