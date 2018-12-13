<?php

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Array_;

function array_pop_key(&$array, $key) {
    $result = $array[$key];
    unset($array[$key]);
    return $result;
}

/**
 * Este modelo representa la estructura de datos de la tabla productos y
 * las operaciones de consulta sobre la misma. Vease la tabla 'productos'
 * en la base de datos para obtener más detalles del registro de un producto. 
 * 
 * @author  Ricardo Bermúdez Bermúdez
 * @since   Dec 12th, 2018.
 * @see     Ci_Model
 * @package application/models/Producto_Modelos
 */
class Productos_Modelo extends CI_Model {
    /**
     * Referencia al controlador
     */
    private $_ci;
    
    
    /**
     * Constructor del objecto; establece una referencia al controlador. 
     */
    public function __construct() {
        parent::__construct();
        $this->_ci = &get_instance();
        $this->_ci->load->model('Proveedores_Modelo');
    }
    
    
    /**
     * Regresa los productos almacenados en la base de datos. Es opcional el
     * argumento de pagina en caso de no enviarse se regresarÃ¡n todos los
     * productos de la base de datos.
     * 
     * @param  Integer $pagina NÃºmero de pagina.
     * @param  Integer $noElementos NÃºmero de elementos por pÃ¡gina.
     * @return Array_  Productos de la base de datos.
     * */
    public function paginador($pagina=0, $noElementos=0) {
        return ['productos'];
    }
    
    
    /**
     * Regresa el registro completo de un producto con todos sus campos.
     * 
     * @param  Integer $id Identificador del producto.
     * @return Array_ Arreglo asociativo con los detalles del producto.
     */
    public function obtenerDetalles($identificadores) {
        $this->db->or_where_in('id_producto',$identificadores);
        return['productos' => $this->db->get('productos')->result()];
    }
    
    
    /**
     * Agrega un nuevo producto a la base de datos.
     * 
     * @param Array_ $producto Producto por agregar.
     * @param Array_ Producto agregado a la base de datos.
     */
    public function agregar($productos) {
        $identificadores = [];
        $this->db->trans_begin();
        
        foreach ($productos as $producto) {
            $proveedores = array_pop_key($producto, 'proveedores');
            $this->db->insert('productos', $producto);
            $identificadores[] = $this->db->insert_id();
            $this->_ci->Proveedores_Modelo->normalizaProveedores($proveedores, $this->db->insert_id());
        }
        
        if (!$this->db->trans_status()) {
            $this->db->trans_rollback();
            return ['error' => $this->db->error()];
        }
        
        $this->db->trans_commit();
        
        return $this->obtenerDetalles($identificadores);
    }
    
    
    /**
     * Actualiza los datos de un producto.
     * 
     * @param  Integer $id Identificador del producto a actualizar.
     * @param  Array_ $producto Datos del actualizados del producto.
     * @return Array_ Producto actualizado.
     */
    public function actualizar($productos) {
        $identificadores = [];
        
        $this->db->trans_begin();
        
        foreach ($productos as $producto) {
            $proveedores = array_pop_key($producto, 'proveedores');
            $identificadores[] = $producto['id_producto'];
            $this->db->where('id_producto', $producto['id_producto']);
            $this->db->update('productos', $producto);
        }
        
        if (!$this->db->trans_status()) {
            $this->db->trans_commit();
            return ['error'=>$this->db->error()];
        }
        
        $this->db->trans_commit();
        return $this->obtenerDetalles($identificadores);
    }
    
    
    /**
     * Elimina un producto de la base de datos.
     * 
     * @param  Integer $id Identificador del producto a eliminar.
     * @return Array_ Producto eliminado.
     */
    public function eliminar($identificadores) {
        $productosPorEliminar = $this->obtenerDetallesProducto($identificadores);
        
        $this->db->or_where_in('id_producto', $identificadores);
        $this->db->delete('productos');
        
        return $productosPorEliminar;
    }
}