<?php

session_start();

/*
if (!isset($_POST['username'])) {															// wenn keine eingabe javascipt alert anzeigen
  session_destroy();
  die("<script>location.href = '/~user/'</script>");															// auf "startseite" leiten
   exit;
 }
*/


?>



<html>
 <head >
  <title >Main-Page</title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" type="text/css" href="tooltip.css">






<?php

if(!isset($_SESSION['login'])){                   // wenn keine session zu startseite gehen
  header('location: index.php');
  exit();
				}

				?>

 </head>

<body>
  <div class="einblenden2"><div class="Willkommen2" ><a href='logout.php' id='Willkommen2' style="text-decoration:none; color: #666666;">Hier ausloggen!</a></div></div>
	<br>
	<div id="logo">
		 <img src="/~user/img/logo.png" width=85% height=85% draggable="false">
	</div>

<!-- Menü
<nav>

</nav>
-->
	<br>
	<br>
	<br>
<?php echo "<div class=\"Willkommen\"><div class=\"einblenden\"><b>- Willkommen ".$_SESSION["username"]."! -</b></div></div>"; ?>


<p></p>


<br><br>

<h1>Navigation</h1>
<p>___________________________________________________________________________________________________________</p>
<ul style="margin-bottom: 0px;">
  <li><a href="main.php">Home</a></li>
  <li><a href="#script">Wie funktioniert das Script?</a></li>
  <li><a href="#harambe">Harambe</a></li>
  <li><a href="#">Sonstiges</a></li>
</ul>
<p style="margin-top: 0px;">___________________________________________________________________________________________________________</p>
<br><br><br><br><br><br><br><br><br><br><br><br><br>

<div class="kleben">
<div class="tooltip">
  <nav>
<span class="tcon-indicator" aria-label="scroll" aria-hidden="true">
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="tcon-svgchevron" viewBox="0 0 30 36">
    <path class="a3" d="M0,0l15,16L30,0"></path>
    <path class="a2" d="M0,10l15,16l15-16"></path>
    <path class="a1" d="M0,20l15,16l15-16"></path>
  </svg>
</span>
</nav>
<span class="tooltiptextmobile" style="top: -50;bottom: 80px;
">Herunter scrollen</span></div></div>

<br><br><br><br><br><br><br>
<h2 id="script" style="text-align: left; color: white;" >Wie funktioniert das Script?</h2>
<div  style="text-align: justify;">
<p2>Das Login-Script ist sehr komplex.<br /><br />Beispiel:<xmp style="text-align: left;"> <p></p></xmp></p2>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<h2 id="harambe" style="color: white;">Harambe</h2>
<p>Harambe war nicht nur ein Gorilla - In unseren Herzen lebt unser Freund weiter</p>
<p>Mit diesem Video zollen wir ihm Respekt und Anerkennung - RIP Harambe</p>
<iframe id="player" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="829.5" height="443" type="text/html" src="//www.youtube.com/v/pNt78oq2HgE?color2=FBE9EC&amp;showsearch=0&amp;showinfo=0&amp;controls=0&amp;version=3&amp;modestbranding=1&start=12&amp;autoplay=1&amp;loop=1&playlist=pNt78oq2HgE" ></iframe>

<br><br><br>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">
			(function() {
                var documentElem = $(document),
                    nav = $('nav'),
                    lastScrollTop = 0;
                documentElem.on('scroll', function() {
                    var currentScrollTop = $(this).scrollTop();
                    //scroll down
                    if ( currentScrollTop > lastScrollTop ) nav.addClass('hidden');
                    //scroll up
                    else nav.removeClass('hidden');
                    lastScrollTop = currentScrollTop;
                });
            })();
		</script>

</body>
</html>
