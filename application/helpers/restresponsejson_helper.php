<?php
function jsonRespuesta($respuesta) {
    header('Content-Type: application/json; charset=UTF-8', 200);
    echo json_encode($respuesta, true); exit;
}

function jsonSolicitud() {
    return json_decode(file_get_contents('php://input'), true);
}