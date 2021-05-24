<?php

require_once 'dbconfig.php';

header('Content-Type: application/json');

//connetto il db a cui voglio accedere
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// costruisco la query
$query = "SELECT immagine, nome, descrizione FROM TRATTAMENTO";

// eseguo la query
$res = mysqli_query($conn, $query);

$arrayTratt = array();
if (mysqli_num_rows($res) > 0)
{  while($entry = mysqli_fetch_assoc($res))
    {
        $arrayTratt[]= array('immagine' => $entry['immagine'],
                      'nome' => $entry['nome'], 
                      'descrizione' => $entry['descrizione']);
    }

//e alla fine, ritorno l'array  
echo json_encode($arrayTratt);

}

// Chiudo la connessione
mysqli_close($conn);





?>