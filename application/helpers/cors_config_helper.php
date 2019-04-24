<?php

function CORSAvailability($origin='http://localhost:4200', $methods="DELETE,GET,POST,UPDATE,OPTIONS", $headers="*")
{
    header("Access-Control-Allow-Origin: {$origin}");
    header("Access-Control-Allow-Methods: {$methods}");
    header("Access-Control-Allow-Headers: {$headers}");
    header("Access-Control-Allow-Credentials: true");
}