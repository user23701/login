<?php



if(isset($_POST['submit3'])){
  header('location: index.php');
  exit();
}




?>

<html>
 <head>
  <title>Registrieren</title>
  <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" type="text/css" href="tooltip.css">


 </head>
 <body>
   <br>
   <div id="logo">
      <img src="/~nicolas.borowski/img/logo.png" width=85% height=85% draggable="false">
   </div>
   <br>
   <br>
 <form action="register.php" method="post" name="myform" id="myform" style="width:840px;">
   <p>Registrie dich:</p>
   <div>

      <input class="textbox" tabindex="1" placeholder="Dein Username" type="text" alt="box1" name="new_username" required="1" maxlength="25"><br><br>
		  <input class="textbox" tabindex="2" placeholder="Dein Passwort" type="password" alt="" name="new_password" required="1" maxlength="25" value=""><br><br>
      <input class="textbox" tabindex="3" placeholder="Dein Passwort bestätigen" type="password" alt="" name="password_confirm" required="1" maxlength="25" value="">
      <br>
      <p><div class="tooltip"><input required="1" tabindex="4" type="checkbox" name="" value="ja"  id="checkbox1">Ich akzeptiere die <b><a style="color: #E6E6E6; text-decoration:none" href="https://www.youtube.com/watch?v=DLzxrzFCyOs" target="_blank">AGB</b><span class="tooltiptext2">Bitte die AGB gründlich lesen und akzeptieren</span></a></p></div>
</div>



<br>

<div>
<button class="button1" tabindex="5"  type="submit" value="Anmelden" maxlength="25" alt""/><span>Registrieren</span></button>
</div>
</form>
<br>
<?php
if (isset($_POST['new_username']) != "") {                // wenn unsername eingegeben
if($_POST['new_password'] == $_POST['password_confirm']){           // schauen, ob das passwort zwei mal richtig eingegeben wurde

  $handle = fopen ("name.txt", "a+" );                          // textdatei öffnen

   fwrite ( $handle, $_POST['new_username'] );                        // username schreiben
   fwrite ( $handle, "," );                                         // komma schreiben
   fwrite ( $handle, $_POST['new_password'] );                                    // passwort schreiben
   fwrite ( $handle, "\n" );                                            //absatz machen
   fclose ( $handle );                                    //textdatei schließen
   echo "<br><br>";
   echo "<div id=\"des\" class=\"loader\"></div>";                      // ladebalken anzeigen
 ob_start();                                              // "timer" starten für ladebalken
 $buffer = str_repeat(" ", 4096)."\r\n<span></span>\r\n";
 for ($i=0; $i<1.1; $i++) {
  echo "<p style='font-size: 0px;'>$buffer.$i</p>";
   ob_flush();
   flush();
   sleep(1);
 }
 ob_end_flush();
 	 echo "<br><br>";
	 echo "<div class=\"falsch\">Danke ".$_POST['new_username'].", du wurdest als neuer User registiert!  →  <a href='index.php' style='text-decoration:none; color: #666666;'><b>Jetzt einloggen!</b></a></div>";     // meldung anzeigen

} else {
    echo '<script language="javascript">';
     echo 'alert("Deine eigegebenen Passwörter sind nicht identisch!")';
    echo '</script>';
}

} else {
  echo "<br><br><br><br><br><br><br>";
  echo "<p>Du hast bereits einen Account?</p>";
  echo "<form method=\"post\">";
  echo "<button class=\"button3\"= type=\"submit\" name=\"submit3\"><span>Zum Login</span></button>";
  echo "</form>";
}
?>




</div>


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    document.getElementById("des").style.visibility = "hidden";
</script>
 </body>

</html>
