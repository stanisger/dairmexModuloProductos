<?php

function CORSAvailability(
    $origin="",
    $methods="DELETE,GET,POST,UPDATE,OPTIONS", $headers="*")
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: {$methods}");
    header("Access-Control-Allow-Headers: {$headers}");
    header("Access-Control-Allow-Credentials: true");
}