<?php

require_once 'dbconfig.php';

header('Content-Type: application/json');

//connetto il db a cui voglio accedere
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

// costruisco la query
$query = "SELECT nome, cognome, ruolo, immagine FROM PERSONALE";

// eseguo la query
$res = mysqli_query($conn, $query);

$arrayDip = array();
if (mysqli_num_rows($res) > 0)
{  while($entry = mysqli_fetch_assoc($res))
    {
        $arrayDip[]= array('nome' => $entry['nome'],
                      'cognome' => $entry['cognome'], 
                      'ruolo' => $entry['ruolo'], 
                      'immagine' => $entry['immagine']);
    }

}
// Chiudo la connessione
mysqli_close($conn);
//e alla fine, ritorno l'array
echo json_encode($arrayDip);

?>