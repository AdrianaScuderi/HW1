<?php
    require_once 'dbconfig.php';

    
 // Verifica l'esistenza di dati POST
 if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && 
    !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"])) 
    { 
        //creo un array contenente gli errori
        $error = array();

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        //effettuo il controllo sull'email
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $query = "SELECT email FROM cliente WHERE email = '$email'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            //se l'email è già stata utilizzata allora do all'array contenente gli errori una stringa di errore rilevato
            $error[] = "Email già in uso";
        } 

        //effettuo il controllo sulla password
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        }
        //check sulla conferma della password
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        //infine, inserisco tutto nel db se non ci sono errori
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);    
            $password = password_hash($password, PASSWORD_BCRYPT); //cifro la password prima di inserirla nel database per non memorizzarla in chiaro

            $query = "INSERT INTO cliente(nome, cognome, email, password) 
            VALUES ('$name', '$surname', '$email', '$password')";

            //eseguo la query dopo essermi registrato correttamente
            if (mysqli_query($conn, $query)) {
                $_SESSION['_venere_email'] = $_POST['email'];
                mysqli_close($conn);
                header("Location: home.php");
            } else {
                $error[] = "Errore di connessione al database";
            } 
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Centro Bellezza Venere - Iscriviti</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Bad+Script&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono&display=swap" rel="stylesheet">

        <link rel='stylesheet' href='registrazione.css'> 
        <script src='registrazione.js' defer></script>

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
        <main>
          <section class="main_left">
              <h1>Registrati</h1>
              <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                   <div class="name">
                     <div><label for='name'>Nome</label></div>
                     <!-- Se il submit non va a buon fine, il server reindirizza su questa stessa pagina, quindi va ricaricata con 
                      i valori precedentemente inseriti -->
                     <div> <input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> > </div>
                   </div>
                   <div class="surname">
                     <div><label for='surname'>Cognome</label></div>
                     <div><input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?> ></div>
                   </div>
                   <div class="email"> 
                      <div><label for='email'>Email</label></div>
                      <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                      <span> </span> 
                   </div> 
                   <div class="password">
                     <div><label for='password'>Password</label></div>
                     <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                     <span> </span>
                   </div>
                   <div class="confirm_password">
                     <div><label for='confirm_password'>Conferma Password</label></div>
                     <div><input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
                     <span> </span>
                   </div>
                   <div class="allow"> 
                         <div><input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>></div>
                         <div><label for='allow'>Acconsento al trattamento dei dati personali</label></div>
                   </div>
                   <div class="submit">
                     <input id='submit' type='submit' value="Registrati" disabled>
                   </div>
               </form>
               <div class="signup">Hai un account? <a href="accesso.php">Accedi</a>
            </section>
            <section class='main_right'></section>
        </main>
        <footer>
         <p>developed by Adriana Scuderi - O46002027</p>
       </footer>
    </body>
</html>