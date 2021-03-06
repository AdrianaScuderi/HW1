<?php 
   include 'auth.php';
?>


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
  
     <link rel="stylesheet" href="mhw1.css">
     <script src="articoli.js" defer="true"></script>
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
           <div id="slogan">
               <h1>
                 <strong>Vieni a trovarci</strong><br/>
                 <p>Concedersi del tempo per prendersi cura di se stessi ?? il vero segreto della bellezza</p>
               </h1>
           </div>
       </header>
       <section id="sezione1"> 
          <div id="saldi" class="c1">
              <div> 
                 <h1> Tante promozioni solo per te! </h1>
              </div>
              <div>
                 <img src="img/rag.png"/>
              </div>
              <div>
                 <p>Iscriviti al sito, avrai la possibilit?? di usufruire delle varie promozioni attive all'interno dei nostri centri. Cosa aspetti? </p>
              </div>
          </div>
       </section>
       <section>
           <div id="promo" class="c1">
              <div>
                 <img src="img/leaves.png"/>
                 <a> Relaxing Promo </a>
              </div>
              <div>
                 <img src="img/snowman.png"/>
                 <a> Christmas Promo </a>
              </div>
              <div>
                 <img src="img/sakura.png"/>
                 <a> Spring break </a>
              </div>
              <div>
                 <img src="img/parasol.png"/>
                 <a> Summer promo </a>
              </div>
           </div>
       </section>
       <section id="sezione2">
          <div id="main">
             <h1> Trova ci?? di cui hai bisogno </h1>
             <p>Abbiamo tanti trattamenti adatti alle tue esigenze, scegli quello giusto per te</p>
          </div>
          <div id="details">
              <div>
                 <img src="img/p3.jpg"/>
                 <h1>PARRUCCHIERE</h1>
                   <p>
		             Con il nostro personale qualificato sei in mani fidate: color stylist, acconciature, tagli alla moda e molto altro!
		          </p>
              </div>
              <div>
                 <img src="img/e2.jpeg" />
                 <h1>ESTETICA</h1>
                  <p>
                     Variando dalla tecnica del microblading al mondo onicotecnico, il nostro staff ?? pronto a prendersi cura di te in ogni momento. 
                  </p>
              </div>
              <div>
                 <img src="img/m5.jpg" />
                 <h1>MASSAGGI</h1>
                  <p>
		              Lasciati coccolare dalle mani dei nostri operatori, offriamo diverse tecniche di massaggi che variano dallo shiatsu alla rilassante hot stone.
		          </p>
              </div>
              <div>
                 <img src="img/s1.jpg" />
                 <h1>SOLARIUM</h1>
                  <p>
		             Il centro propone dei trattamenti abbronzanti grazie ai professionali macchinari ad alta pressione clinicamente testati. Con noi hai solo il meglio per la tua pelle.
                  </p>
              </div>
          </div>
       </section>
       <section id="sezione3">
          <div id="intronews">
               <h1> Le ultime news  </h1>
               <p> In seguito ecco una lista di articoli da consultare per essere sempre al passo con le novit??, conoscere il tuo corpo e curarlo al meglio</p>
          </div>
          <div id="elencoarticoli">
          </div>
       </section>
       <footer>
         <p>developed by Adriana Scuderi - O46002027</p>
       </footer>
  </body>
</html>