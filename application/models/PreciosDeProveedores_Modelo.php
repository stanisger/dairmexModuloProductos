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
     * Regresa los datos de los precios solicitados.
     * 
     * @param
     */
    public function obtener($identificadores)
    {
        $this->db->or_where_in('id_precio',$identificadores);
        $productos = $this->db->get('precios_de_proveedores')->result();
        return ['precios' => $productos];
    }
    
    
    /**
     * Regresa los precios por proveedor pertenecientes a un producto
     * determinado por el identificador de producto.
     *
     * @param  Integer $idProducto Identificador de producto.
     * @return Array   Precios del producto actual.
     */
    public function obtenerProveedoresPorProducto($idProducto)
    {
        return $this->db
        ->select('precios_de_proveedores.id_precio')
        ->select('proveedores.id_proveedor')
        ->select('proveedores.nombre')
        ->select('precios_de_proveedores.precio_por_unidad')
        ->select('precios_de_proveedores.unidad_precio')
        ->from('precios_de_proveedores')
        ->join('proveedores',
            'precios_de_proveedores.id_proveedor = proveedores.id_proveedor'
          )
        ->or_where_in('precios_de_proveedores.id_producto',$idProducto)
        ->get()->result();
    }
    
    
    /**
     * Agrega los precios de los proveedores para determinado producto.
     * 
     * @param Array $preciosPorPreveedores Listado de precios por proveedor
     *                                     para un producto.
     */
    public function alta($precios)
    {
        $identificadores = [];
        
        $this->db->trans_begin();
        
        foreach ($precios as $precio) {
            $this->db->insert('precios_de_proveedores', $precio);
            $identificadores[] = $this->db->insert_id();
        }
        
        if (!$this->db->trans_status()) {
            $this->db->trans_rollback();
            return ['error' => $this->db->error()];
        }
        
        $this->db->trans_commit();
        return $this->obtener($identificadores);
    }
    
    
    /**
     * Actualiza los precios registrados para un producto.
     * 
     * @param  Array $precios Precios a actualizar.
     * @return Array Precios actualizados.
     */
    public function actualizar($precios)
    {
        $identificadores = [];
        
        $this->db->trans_begin();
        
        foreach ($precios as $precio) {
            $identificadores[] = $precio['id_precio'];
            $this->db->where('id_precio', $precio['id_precio']);
            $this->db->update('precios_de_proveedores', $precio);
        }
        
        if (!$this->db->trans_status()) {
            $this->db->trans_rollback();
            return ['error'=>$this->db->error()];
        }
        
        $this->db->trans_commit();
        return $this->obtener($identificadores);
    }
    
    
    /**
     * Eliminar precios registrados para un producto.
     * 
     * @param  Array $identificadores Precios a eliminar.
     * @return Array Datos de los precios eliminados.
     */
    public function eliminar($identificadores)
    {
        $preciosPorEliminar = $this->obtener($identificadores);
        
        $this->db->or_where_in('id_precio', $identificadores);
        $this->db->delete('precios_de_proveedores');
        
        return $preciosPorEliminar;
    }
}