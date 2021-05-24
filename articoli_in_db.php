<?php
    require_once 'dbconfig.php';

    require_once 'auth.php';
    if (!$user_email = checkAuth()) exit;

    
    //Imposto l'header della risposta
    header('Content-Type: application/json');

    
    //connetto il db a cui voglio accedere
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $immagine = mysqli_real_escape_string($conn, $_POST['immagine']);
    $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    
    // costruisco la query
    $query = "INSERT INTO ARTICOLO(titolo, immagine, descrizione, link) VALUES('$titolo','$immagine', '$descrizione', '$link')";


   // eseguo le query
   $res = mysqli_query($conn, $query);


    // Chiudo la connessione
    mysqli_close($conn);

?>