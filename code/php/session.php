<?php
session_start();
$data = null;

    if (isset($_SESSION['email']))
        $data = $_SESSION['email'];

echo json_encode($data);

header('Content-Type: application/json; charset=utf-8');
header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('HTTP/1.1 200 OK');