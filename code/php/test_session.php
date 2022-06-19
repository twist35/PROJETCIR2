<?php
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