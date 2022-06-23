<?php
/*
  Créé par Antonin SABIRON et Lucas Le Bihan
    le 15/06/2022
    Pour le projet de fin d'année CIR2
*/
session_start();
if (!isset($_SESSION['count'])) {
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}
echo $_SESSION['count'];
echo "\n";
if (isset($_SESSION['email']))
{
  echo $_SESSION['email'];
}
//session_destroy(); //remet a zero