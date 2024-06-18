<?php

class Database
{

    function connect()
    {
        $connect = mysqli_connect('localhost', 'root', '', 'livedoc', 3366);
        mysqli_set_charset($connect, "utf8");
        return $connect;
    }

    function close($connection)
    {
        mysqli_close($connection);
    }

}

?>