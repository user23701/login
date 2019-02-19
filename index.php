<?php
session_start();

// Die Laufzeit des Session Cookies wird verlängert, wenn "Eingeloggt bleiben" gecheckt ist
if(isset($_POST["angemeldetbleiben"])) {
  $lifetime=31536000; // Lifetime wird auf ein Jahr gesetzt
session_reset();    // Die Session wird resetet
setcookie(session_name(),session_id(),time()+$lifetime);  // Der Session Cookie wird neu gesetzt (nun mit einem Jahr Laufzeit)
}

/*
if(isset($_COOKIE["login"])) {
  $form_is_submitted = true;
  $fehler = false;
  $_SESSION["username"] = $_COOKIE["login"];
}
*/


if(isset($_POST['neuernutzer'])){             // Redirect bei Klick  auf Registrieren Button
  header('location: register.php');
  exit();
}

$form_is_submitted = false;                   // Variable wird gesetzt
$fehler = false;                                // Variable wird gesetzt

if (isset($_POST['username']) && $_POST['password'] != "") {            // Überprüfung, ob Felder ausgefüllt wurden
        $form_is_submitted = true;                                           // Variablensetzung, wenn Felder ausgefüllt sind
}

if($form_is_submitted === true){                                     // Wenn die Form ausgefüllt wurde

	$handle = fopen('name.txt','r');                                              // Datei wird geöffnet
            	if($handle === false){
            		$fehler = true;                                        // Wenn dies nicht möglich, fehler = true
            	}else{
            		while(!feof($handle)){                                        // While Schleife starten um jede Zeile durchzugehen
            	    	$line = fgets($handle);                                   // Lines durchgehen
            	        $data = explode(',',$line);                              // Bei jedem Komma trennen
            	        if(empty($line)){                              // Wenn eine Zeile leer ist, wird diese übersprungen
            	        	break;
            	        }
                      // user und passwort trennen
            	        $userName = trim($data[0]);                  // Erstes Wort wird als username deklariert
            	        $passWord = trim($data[1]);                    // Zweites Wort wird als passwort deklariert


            	        if( $userName === $_POST['username'] &&  $passWord === $_POST['password']){  // Überprüfen ob Nutzername und Passwort übereinstimmen
            	        	$fehler = false;                                                    // Wenn ja, fehler = false
            	        	break;
            	        }else{
            	        	$fehler = true;                                                 // Wenn nein, fehler = true
            	       	}
            	     }
            	 }
  fclose($handle);

	if($fehler === true && $_POST['username']!=="" && $_POST['password']!==""){        // Wenn es einen Fehler gibt, wird Nachricht gezeigt
    echo '<script language="javascript">';																					// Javascript Alert: "falscher benutzer"
    echo 'alert("Das Passwort oder der Username ist falsch!")';
    echo '</script>';
    die("<script>location.href = '/~user/'</script>");															// Redirect auf Login Page
    exit;
	}
}

if ($form_is_submitted === true && $fehler === false) {         // Prüfung, ob es keine Fehler gibt
  $usernameEingabeErfolgreich = $_POST['username'];           // Name, von dem eingeloggten Benutzer, wird als Variable gesetzt
  $nameGroß =  ucfirst($usernameEingabeErfolgreich);          // Erster Buchstabe des Names groß, für main.php
//  $login = "login_accepted";                             // Inhalt anzeigen (per Javascript) [alt]
	$_SESSION['login'] = true;                               // Session "login" wird gestartet
  $_SESSION["username"] = $nameGroß;                        // Username wird als Session Variable gesetzt
  header('location: main.php');                               // Redirect auf main.php
  exit();
} else {
    if ($fehler === true) {                                              // Wenn Fehler gefunden wurden
      echo '<script language="javascript">';																					// Javascript Alert: "erneut anmelden"
      echo 'alert("Bitte erneut anmelden!")';
      echo '</script>';
      die("<script>location.href = '/~user/'</script>");															//  Redirect auf "Login Page"
      exit;
		}
  }

  if(isset($_SESSION['login'])){            // Redirect auf main.php, wenn Session aktiv ist
   header('location: main.php');
    exit();
  }
  if ($form_is_submitted === false){              // Wenn die Form nicht ausgefüllt wurde, die Session beenden
    session_destroy();
  }

?>

<html>
 <head>
          <title>Anmelden</title>


         <link rel="stylesheet" href="checkbox.css">
          <link rel="stylesheet" type="text/css" href="css.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


 </head>
 <body>


   <br>
   <div id="logo">
      <img src="/~user/img/logo.png" width=85% height=85% draggable="false">
   </div>
<br>
<br>
<br>
<p>Beim Username bitte Groß und Kleinschreibung beachten.</p>

<br>

 <form method="post" name="myform" id="myform" style="width:840px;">
	<div>
			<td><input class="textbox" placeholder="Username eingeben" type="text" tabindex="1" name="username" required="1" maxlength="25" value="" /><br><br>
			<td><input class="textbox" placeholder="Passwort eingeben" type="password" tabindex="2" name="password" required="1" maxlength="25" value=""  /><br>
      <td><p><input type="checkbox" name="angemeldetbleiben" value="ja" tabindex="3"/>Eingeloggt bleiben</p>
    </div>
    <br>
<button class="button" type="submit" value="Anmelden"  maxlength="25" alt="" tabindex="4" /><span>Anmelden</span></button>
</div>
</form>




<p></p>
 </body>
 <footer>
<br><br><br><br><br><br><br><br><br>
<p>Du hast noch keinen Account?</p>

 <form method="post">
   <button class="button1"= type="submit" name="neuernutzer"><span>Erstelle einen Account</span></button>
 </form>
 </footer>

</html>
