<?php
    /*******************************************************
        Controlla che l'email sia unica
    ********************************************************/
    require_once 'dbconfig.php';
    
    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }
    //Imposto l'header della risposta
    header('Content-Type: application/json');
    
    //connetto il db a cui voglio accedere
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    // leggo la stringa dell'email
    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    // costruisco la query
    $query = "SELECT email FROM cliente WHERE email = '$email'";

    // eseguo la query
    $res = mysqli_query($conn, $query);

    // Torna un JSON all'utente con chiave exists e valore boolean
    $json_array = array('exists' => mysqli_num_rows($res) > 0 ? true : false);
    $json = json_encode($json_array);
    echo $json;

    // Chiudo la connessione
    mysqli_close($conn);
?>