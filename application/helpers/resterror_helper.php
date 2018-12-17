<?php
/**
 * Notifica al cliente de que está intentando ejecutar una operación con errores
 * sintácticos o semanticos en los argumentos.
 *
 * @use  restError
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/400
 */
function restErrorOperacionNoPermitida()
{
    restError('Operación no permitida. Verifique su petición', 400);
}

/**
 * Notifica al cliente de que está intentando ejecutar una operación HTTP no
 * permitida en el enlace actual.
 * 
 * @use  restError
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/405
 */
function restErrorMetodoNoPermitido()
{
    restError('Método no permitido', 405);
}

/**
 * Informa al cliente de un error en formato JSON, además de establecer el
 * código de error HTTP en el encabezado de la respuesta HTTP.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 12th, 2018.
 * 
 * @param  String  $mensaje     Mensaje de error de la aplicación.
 * @param  Integer $codigoError Código de error HTTP para informar del contexto
 *                              general del error al cliente.$this
 * @return void    La función finaliza la ejecución del hilo PHP con la salida
 *                 en el buffer en formato JSON para el cliente. 
 */
function restError($mensaje, $codigoError)
{
    header('Content-Type: application/json; charset=UTF-8', $codigoError);
    
    echo json_encode([
       'codigo' => $codigoError,
       'error'  => $mensaje,
    ]);
    
    exit(0);
}