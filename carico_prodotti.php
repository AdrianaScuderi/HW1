<?php
    /********************************************************
     Ritorna un JSON con i risultati dell'API dei prodotti            
    *********************************************************/
    require_once 'auth.php';

    header('Content-Type: application/json');

    $query = urlencode($_GET["q"]);
    $url = "http://makeup-api.herokuapp.com/api/v1/products.json?brand=l'oreal&product_type=".$query;
  
    $ch = curl_init($url); 
    //di default la curl_exec() ritorna un valore booleano, che determina se la richiesta è andata a bon fine o no, 
    //ma a noi serve che ci ritorni il json di risposta, quindi devo settare l'opzione in base a questo
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $data = curl_exec($ch);
    $json = json_decode($data, true); //leggo il json che viene ritornato
    curl_close($ch); //libero le risorse allocate

    echo $data;
?>