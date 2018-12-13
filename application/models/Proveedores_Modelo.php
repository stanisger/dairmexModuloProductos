<?php
/**
 * Este modelo representa la estructura de datos de la tabla proveedores y
 * las operaciones de consulta sobre la misma. Vease la tabla 'proveedores'
 * en la base de datos para obtener mas detalles del registro de un producto. 
 * 
 * @author  Ricardo Bermúdez Bermúdez
 * @since   Dec 12th, 2018.
 * @see     Ci_Model
 * @package application/models/Proveedores_Modelos
 */
class Proveedores_Modelo extends CI_Model {
    
    /**
     * Regresa la lista completa de proveedores que coincidan con  
     */
    public function obtenerDetalles($identificadores) {
        $this->db->or_where_in('id_proveedor',$identificadores);
        
        return [
            'proveedores' => $this->db->get('proveedores')->result()
        ];
    }
    
    /**
     * Regresa la lista de proveedores parecidos al nombre de un argumento.
     */
    public function obtenerPorNombre($nombre) {
        $this->db->like('nombre', $nombre);
        
        return [
            'proveedores' => $this->db->get('proveedores')->result()
        ];
    }
    
    /**
     * A�ade un nuevo proveedor a la base de datos.
     */
    public function agregaProveedor($nombre) {
        $this->db->insert('proveedores', ['nombre' => $nombre]);
        
        return $this->db->insert_id();
    }
    
    /**
     * 
     */
    public function normalizaProveedores($proveedores, $idProducto) {
        foreach ($proveedores as &$proveedor) {
            if ( empty($proveedor['id_proveedor']) ) {
                $proveedor['id_proveedor'] = $this->agregaProveedor( $proveedor['nombre'] );
            }
            unset($proveedor['nombre']);
            $proveedor['id_producto'] = $idProducto;
        }
        
        return $proveedores;
    }
}