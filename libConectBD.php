<?php

function Conectarse(){
    $host = "localhost";
    $db = "celulares";
    $user = "stbn";
    $pass = "1234";
    $port = "5432";

    if (!($link = pg_connect("host=$host port=$port password=$pass user=$user dbname=$db"))) {
        echo "Error conectando a la base de datos.";
        exit();
    }
    return $link;
}

function Desconectarse($link)
{
    if (!pg_close($link)) {
        echo "Error desconectando de la base de datos.";
        exit();
    }
}
?>