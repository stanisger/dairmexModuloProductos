<?php
/**
 * Este modelo representa las operaciones realizadas a la base de datos para
 * agregar los precios de los productos por proveedor.
 * 
 * @author Ricardo bermúdez Bermúdez
 * @since  Dec 14th, 2018.
 * @use CI_Model
 */
class PreciosDeProveedores_Modelo extends CI_Model
{

    /**
     * Agrega los precios de los proveedores para determinado producto.
     */
    public function agregar($preciosPorPreveedores)
    {
        return $this->db->insert_batch(
            'precios_de_proveedores',
            $preciosPorPreveedores
        );
    }
   
}