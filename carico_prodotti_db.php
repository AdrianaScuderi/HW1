<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $user_mail = checkAuth();

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);

    $immagine = mysqli_real_escape_string($conn, $_POST['immagine']);

    $query = "INSERT INTO PRODOTTI_SALVATI(email_cliente, immagine, nome)  VALUES('$user_mail', '$immagine', '$nome')";

    // eseguo le query
   $res = mysqli_query($conn, $query);


   // Chiudo la connessione
   mysqli_close($conn);

?>