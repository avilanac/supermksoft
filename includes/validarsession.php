<?php

if(!isset($_SESSION['doc']) || !isset ($_SESSION ['rol']))
{
    header('Location: ../login.php');
    exit();
}

?>