<?php
/**
 * Este modelo representa la estructura de datos de la tabla productos y
 * las operaciones de consulta sobre la misma. Vease la tabla 'productos'
 * en la base de datos para obtener más detalles del registro de un producto. 
 * 
 * @author Ricardo Bermúdez Bermúdez <ricardob.sistemas@gmail.com>
 * @since   Dec 12th, 2018.
 * @see     Ci_Model
 * @package application/models/Producto_Modelos
 */
class Productos_Modelo extends CI_Model
{
    
    /**
     * Referencia al controlador
     */
    private $_ci;
    
    
    /**
     * Constructor del objecto; establece una referencia al controlador y
     * carga el modelo de {@link Proveedores_Modelo} y {@link
     * PrecionDeProveedores_Modelo}, además del helper {@link
     * array_pop_key}.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_ci = &get_instance();
        $this->_ci->load->model('Proveedores_Modelo');
        $this->_ci->load->model('PreciosDeProveedores_Modelo');
        $this->_ci->load->helper('array_pop_key');
    }
    
    
    /**
     * Regresa los productos almacenados en la base de datos para su uso en un
     * paginador.
     * 
     * @param  Integer $pagina Número de página.
     * @param  Integer $noElementos Número de elementos por página.
     * @return Array   Productos de la base de datos.
     * */
    public function paginador($pagina=0, $noElementos=0)
    {
        return ['productos'];
    }
    
    
    /**
     * Regresa los detalles completos de los productos cuyo identificador se
     * encuentre en el listado de identificadores pasado como argumento.
     * 
     * @param  Array $identificadores Listado de identificadores de productos.
     * @return Array Arreglo asociativo con los detalles del producto.
     */
    public function obtenerDetalles($identificadores)
    {
        $this->db->or_where_in('id_producto',$identificadores);
        return['productos' => $this->db->get('productos')->result()];
    }
    
    
    /**
     * Agrega un nuevos productos a la base de datos.
     * 
     * La operación se realiza mediante una transacción para garantizar el
     * almacenamiento de los datos de las distintas tablas.
     * 
     * @param  Array $productos Listado de productos por agregar.
     * @return Array Datos de los productos agregados a la base de datos.
     */
    public function agregar($productos)
    {
        $identificadores = [];
        
        $this->db->trans_begin();
        
        foreach ($productos as $producto) {
            $proveedores = array_pop_key($producto, 'proveedores');
            
            //Inserta producto en la base de datos.
            $this->db->insert('productos', $producto);
            $identificadores[] = $this->db->insert_id();
            
            //Agrega proveedores en caso de no existir en la base de datos.
            $proveedores = $this->_ci
            ->Proveedores_Modelo
            ->normalizaProveedores(
                $proveedores, $this->db->insert_id()
            );
            
            //añade precios de los proveedores para el producto actual.
            $this->_ci
            ->PreciosDeProveedores_Modelo
            ->agregar($proveedores);
        }
        
        if (!$this->db->trans_status()) {
            $this->db->trans_rollback();
            return ['error' => $this->db->error()];
        }
        
        $this->db->trans_commit();
        
        return $this->obtenerDetalles($identificadores);
    }
    
    
    /**
     * Actualiza los datos de un listados de productos.
     * 
     * @param  Array $productos Datos del actualizados de los productos.
     * @return Array Datos completos de los productos actualizados.
     */
    public function actualizar($productos)
    {
        $identificadores = [];
        
        $this->db->trans_begin();
        
        foreach ($productos as $producto) {
            array_pop_key($producto, 'proveedores');
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
     * Elimina un listado de productos de la base de datos.
     * 
     * @param  Array $identificadores Identificadores de los productos a
     *                                eliminar.
     * @return Array Datos de los productos eliminados.
     */
    public function eliminar($identificadores)
    {
        $productosPorEliminar = $this->obtenerDetallesProducto($identificadores);
        
        $this->db->or_where_in('id_producto', $identificadores);
        $this->db->delete('productos');
        
        return $productosPorEliminar;
    }
}