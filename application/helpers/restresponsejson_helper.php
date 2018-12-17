<?php
/**
 * Codifica la respuesta de método de un API REST en formato JSON, adjutando
 * el encabezado Content-Type para informar al ciente del formato de la
 * respuesta.
 */
function jsonRespuesta($respuesta)
{
    header('Content-Type: application/json; charset=UTF-8', 200);
    echo json_encode($respuesta, true);
}

/**
 * Obtiene el cuerpo de la solicitud del cliente (se espera sea en formato
 * JSON) y lo decodifica, regresando un arreglo asociativo como resultado
 * de la decodificación.
 * 
 * @return Array Decodificación del cuerpo de la solicitud.
 */
function jsonSolicitud()
{
    return json_decode(
        file_get_contents('php://input'),
        true
    );
}