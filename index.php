<?php
session_start();

// session cookie laufzeit verlängern, wenn "eingeloggt bleiben" aktiviert ist
if(isset($_POST["angemeldetbleiben"])) {
  $lifetime=31536000; // ein jahr
session_reset();    // session wird 'neugestartet'
setcookie(session_name(),session_id(),time()+$lifetime);  // session cookie wird aktualisiert mit ein jahr laufzeit
}
/*
if(isset($_COOKIE["login"])) {
  $form_is_submitted = true;
  $fehler = false;
  $_SESSION["username"] = $_COOKIE["login"];
}
*/


if(isset($_POST['neuernutzer'])){             // wenn registrieren button geklickt auf register seite leiten
  header('location: register.php');
  exit();
}

$form_is_submitted = false;                   // variable wird gesetzt
$fehler = false;                                // variable wird gesetzt

if (isset($_POST['username']) && $_POST['password'] != "") {            // überprüfen, ob boxen ausgefüllt wurden
        $form_is_submitted = true;                                           //variable=  felder ausgefüllt
}

if($form_is_submitted === true){                                     // wenn form ausgefüllt

	$handle = fopen('name.txt','r');                                              //datei öffnen
            	if($handle === false){
            		$fehler = true;                                        // wenn nicht möglich zu öffnen fehler = true
            	}else{
            		while(!feof($handle)){                                        // while schleife starten um jede zeile durchzugehen
            	    	$line = fgets($handle);                                   // öffnen
            	        $data = explode(',',$line);                              // bei komma trennen
            	        if(empty($line)){                              // wenn zeile leer überspringen
            	        	break;
            	        }
                      // user und passwort trennen
            	        $userName = trim($data[0]);                  //erstes wort username
            	        $passWord = trim($data[1]);                    // zweites wort passwort


            	        if( $userName === $_POST['username'] &&  $passWord === $_POST['password']){  // überprüfen ob übereinstimmt
            	        	$fehler = false;                                                    // wenn ja kein fehler
            	        	break;
            	        }else{
            	        	$fehler = true;                                                 // wenn nein = fehler
            	       	}
            	     }
            	 }
  fclose($handle);

	if($fehler === true && $_POST['username']!=="" && $_POST['password']!==""){        // wenn fehler nachricht
    echo '<script language="javascript">';																					// javascript alert - "falscher benutzer"
    echo 'alert("Das Passwort oder der Username ist falsch!")';
    echo '</script>';
    die("<script>location.href = '/~user/'</script>");															// auf "startseite" leiten
    exit;
	}
}

if ($form_is_submitted === true && $fehler === false) {         // prüfen ob keine fehler da sind
  $usernameEingabeErfolgreich = $_POST['username'];           // namen als variable
  $nameGroß =  ucfirst($usernameEingabeErfolgreich);          // erster buchstabe von name groß, für main.php
//  $login = "login_accepted";                             // inhalt anzeigen (per javascript) [alt]
	$_SESSION['login'] = true;                               // session "login" wird aktiviert
  $_SESSION["username"] = $nameGroß;                        // username wird als session variable gesetzt
  header('location: main.php');                               // weiterleiten
  exit();
} else {
    if ($fehler === true) {                                              // wenn fehler gefunden wurden
      echo '<script language="javascript">';																					// javascript alert - "erneut anmelden"
      echo 'alert("Bitte erneut anmelden!")';
      echo '</script>';
      die("<script>location.href = '/~user/'</script>");															// auf "startseite" leiten
      exit;
		}
  }

  if(isset($_SESSION['login'])){            // weiterleiten wenn login session aktiv
   header('location: main.php');
    exit();
  }
  if ($form_is_submitted === false){              // wenn form nicht ausgefüllt session zerstören
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
