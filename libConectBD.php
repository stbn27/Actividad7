<?php
// function conectarse(){
//     if (!($link = pg_connect("host=localhost port=5432 password=kik2pn6kqbfh6 user = mn_2_09 dbname= bd09"))) {
//         echo "Error conectando a la base de datos.";
//         exit();
//     }
//     return $link;
// }
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