<?php
session_start();
session_destroy();      // Session wird beendet
setcookie(session_name(),session_id(),time()-1);    // Falls die Checkbox bei "Eingeloggt bleiben" gecheckt ist, wird der Cookie gelöscht (Zeit liegt in der Vergangenheit)
header('location: index.php');  // Redirect
exit();
?>
