<?php
   include 'auth.php';
?>

<!DOCTYPE html>
<html>
  <head>
     <meta charset="utf-8">

     <title>Centro Bellezza Venere</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=ABeeZee&family=Pangolin&display=swap" rel="stylesheet">

     <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">

     <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">

     <link href="https://fonts.googleapis.com/css2?family=Sniglet&display=swap" rel="stylesheet">

     <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&display=swap" rel="stylesheet">
  
     <link rel="stylesheet" href="aboutus.css">
     <script src="carico_dipendenti.js" defer="true"></script>
  </head>

  <body>
       <header>
          <nav>
               <div id="logo">
                  <img src="img/lotusicona.png"/>
                  <div>
                     <h3>Centro Bellezza</h3>
                     <h1>Venere</h1>
                  </div>
               </div>
               <div id="links">
                 <a href="home.php">Home</a>
                 <a href="aboutus.php">About us</a>
                 <a href="servizi.php">Servizi</a>
                 <a href="prodotti.php">Prodotti</a>
                 <?php
                    if (checkAuth())
                    {
                       echo "<a class='button' href='uscita.php'> Esci </a>";
                    } else 
                    {
                      echo "<a class='button' href='accesso.php'>Unisciti/Accedi alla community</a>";
                    } 
                 ?>
               </div>
	           <div id="menu">
                 <div></div>
                 <div></div>
                 <div></div>
               </div>
          </nav>
          <div id="incipitdipendenti">
             <h1>Vieni a conoscere il nostro team!</h1>
             <p> Vi presentiamo tutti i dipendenti del Centro di Bellezza, i quali si prenderanno cura di voi quando verrete a trovarci</p>
          </div>
      </header>
      <section id="dip">
         <div class="dipendente"></div>
      </section>
      <footer>
         <p>developed by Adriana Scuderi - O46002027</p>
      </footer>
   </body>
   </html>