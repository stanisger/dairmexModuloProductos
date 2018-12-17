<?php
/**
 * Este modelo representa la estructura de datos de la tabla proveedores y
 * las operaciones de consulta sobre la misma. Vease la tabla 'proveedores'
 * en la base de datos para obtener mas detalles del registro de un producto. 
 * 
 * @author  Ricardo BermÃºdez BermÃºdez
 * @since   Dec 12th, 2018.
 * @see     Ci_Model
 * @package application/models/Proveedores_Modelos
 */
class Proveedores_Modelo extends CI_Model
{
    /**
     * Regresa la lista de proveedores cuyo identificador(id_proveedor)
     * coincide con los utilizados en la lista de identificadores.
     * 
     * @param  Array $identificadores Lista de identificadores de proveedores.
     * @return Array Lista de proveedores.
     */
    public function obtener($identificadores)
    {
        $this->db->or_where_in('id_proveedor',$identificadores);
        
        return [
            'proveedores' => $this->db->get('proveedores')->result()
        ];
    }
    
    
    /**
     * Regresa la lista de proveedores parecidos al nombre de un argumento.
     * 
     * @param  String $nomrbe Nombre del proveedor.
     * @return Array  Lista de proveedores con un nombre parecido al que se
     *                pasó como argumento.
     */
    public function obtenerPorNombre($nombre)
    {
        $this->db->like('nombre', $nombre);
        
        return [
            'proveedores' => $this->db->get('proveedores')->result()
        ];
    }
    
    
    /**
     * Añade un nuevo proveedor a la base de datos.
     * 
     * @param  String  $nombre Nombre del proveedor.
     * @return Integer|String|null Identificador del registro agregado si sel
     *                             agrego corectamente en otro caso regresa
     *                             null.
     */
    public function alta($nombre)
    {
        $this->db->insert('proveedores', ['nombre' => $nombre]);
        return $this->db->insert_id();
    }
    
    
    /**
     * Se le pasa una lista de proveedores y en caso de no detectar en el
     * registro la llave <b>id_proveedor</b> se agrega a la base de datos.
     *
     * @see PreciosDeProveedores_Modelo::agregarPreciosDeProveedores()
     *
     * @param  Array   $proveedores Lista de Proveedores.
     * @param  Integer $idProducto  Identificador del producto.
     * @return Array   Registros de proveedores con el identificador del
     *                 proveedor y el identificador del producto listos
     *                 para agregarse a los registros de precios por
     *                 proveedor.
     */
    public function altaNormalizaProveedores($proveedores, $idProducto)
    {
        
        foreach ($proveedores as &$proveedor) {
            if ( empty($proveedor['id_proveedor']) ) {
                $proveedor['id_proveedor'] = $this->alta( $proveedor['nombre'] );
            }
            unset($proveedor['nombre']);
            $proveedor['id_producto'] = $idProducto;
        }
        
        return $proveedores;
    }
}