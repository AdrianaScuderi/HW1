<?php
    require_once 'auth.php';

    header('Content-Type: application/json');

    $user_mail = checkAuth();

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);


    $query = "SELECT * FROM PRODOTTI_SALVATI WHERE email_cliente = '$user_mail'";

    // eseguo le query
   $res = mysqli_query($conn, $query);

   $arrayPrefe = array();

   if (mysqli_num_rows($res) > 0)
{  while($entry = mysqli_fetch_assoc($res))
    {
        $arrayPrefe[]= $entry;
    }
}
   echo json_encode($arrayPrefe);

   // Chiudo la connessione
   mysqli_close($conn);

?>