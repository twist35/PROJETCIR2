<?php
session_start();
if (!isset($_SESSION['count']) && !isset($_SESSION['count1'])) {
  $_SESSION['count1'] = -1;
  $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
  $_SESSION['count1']++;
}
echo $_SESSION['count'];
echo "\n";
echo $_SESSION['count1'];
if (isset($_SESSION['email']))
{
  echo $_SESSION['email'];
}
//session_destroy(); //remet a zero