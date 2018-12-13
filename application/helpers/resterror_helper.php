<?php

function restErrorOperacionNoPermitida() {
    restError('Operación no permitida. Verifique su petición', 402);
}

function restErrorMetodoNoPermitido() {
    restError('Método no permitido', 405);
}

/**
 * Informa al cliente de un error en formato JSON, además de establecer el
 * código de error HTTP en el encabezado de la respuesta HTTP.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 12th, 2018.
 */
function restError($mensaje, $codigoError) {
    header('Content-Type: application/json; charset=UTF-8', $codigoError);
    
    echo json_encode([
       'codigo' => $codigoError,
       'error'  => $mensaje,
    ]);
    
    exit(0);
}