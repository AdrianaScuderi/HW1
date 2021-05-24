<?php

  /*GESTISCI UNA SESSIONE GIA' ATTIVA*/
  include 'auth.php';
  if(checkAuth()){
    header('Location: home.php');
    exit;
  }

  require_once 'dbconfig.php';
  
  /*CONTROLLO CHE ESISTE UN UTENTE NEL DB CON QUELLE CREDENZIALI E GESTISCO L'ACCESSO */
  if (!empty($_POST["email"]) && !empty($_POST["password"]) )
  { // Dopo aver inviato email e password mi connetto al db
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // costruisco la query
    $query = "SELECT email, password FROM cliente WHERE email = '$email'";
    // eseguo la query e controllo il risultato
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($res) > 0) 
    {
      //se trovo l'utente, memorizzo all'interno di una variabile il risultato in modo da andare a salvare tutto in un array associativo
      $entry = mysqli_fetch_assoc($res); 
      //verifico che la password inviata sia quella corrette
      if (password_verify($_POST['password'], $entry['password'])) {
        // se la password è corretta allora memorizzo tutto all'interno di una variabile di sessione e l'utente verrà "dimenticato" una volta chiuso il browser
        $_SESSION["_venere_email"] = $entry['email'];
        header("Location: home.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
      }
    }
    // Se l'utente non è stato trovato o la password non ha passato la verifica do il messaggio di errore
    $error = "Username e/o password errati.";
  }    
?>

<html>
  <head>
     <meta charset="utf-8">
     <title>Centro Bellezza Venere - Accedi</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">
     <link rel='stylesheet' href='accesso.css'>    
  </head>
  <body>
      <header>
           <nav>
              <div id="logo">
                   <img src="img/lotusicona.png"/>
                   <div id="titolo">
                     <h3>Centro Bellezza</h3>
                     <h1>Venere</h1>
                   </div>
              </div> 
              <div id="links">
                 <a href="home.php">Home</a>
                 <a href="aboutus.php">About us</a>
                 <a href="servizi.php">Servizi</a>
                 <a href="prodotti.php">Prodotti</a>
              </div>
		      <div id="menu">
                 <div></div>
                 <div></div>
                 <div></div>
              </div>
           </nav>
        </header>
        <main class="login">
          <section class="main_left">
               <h1>Accedi</h1>
                <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }  
                ?>
               <form name='login' method='post'>
                   <div class="username">
                     <div><label for='email'>Email</label></div>
                     <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                   </div>
                   <div class="password">
                     <div><label for='password'>Password</label></div>
                     <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                   </div>
                   <div>
                     <input type='submit' value="Accedi">
                   </div>
               </form>
               <div class="signup">Non hai un account? <a href="registrazione.php">Iscriviti</a></div>
          </section>
          <section class="main_right"></section>
      </main>
      <footer>
         <p>developed by Adriana Scuderi - O46002027</p>
       </footer>
  </body>
</html>