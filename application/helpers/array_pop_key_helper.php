<?php
/**
 * Esta función elimina una llave de un arreglo asociativo y regresa el valor
 * asociado a la llave
 * 
 * @author Ricardo Bermúdez Bermúdez <ricardob.sistemas@gmail.com>
 * @since  Dec 9th, 2018.
 */
function array_pop_key(&$array, $key)
{
    $result = $array[$key];
    unset($array[$key]);
    return $result;
}