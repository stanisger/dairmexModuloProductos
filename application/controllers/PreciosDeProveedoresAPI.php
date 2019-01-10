<?php
/**
 * Este controlador modela la interfaz REST para el flujo de operaciones con
 * realizados con los precios de los productos.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 17, 2018. <f.c.>
 * @use    CI_Controller 
 */
class PreciosDeProveedoresAPI extends CI_Controller
{
    /**
     *  Inicializa los datos de sesión y la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['PreciosDeProveedores_Modelo']);
        $this->load->helper(['resterror','restresponsejson']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
    }
    
    
    /**
     * Interfaz REST para dar de alta precios nuevos para productos en la base
     * de datos.
     * 
     * Esta operación solo se consulta con POST.
     */
    public function alta()
    {
        $precios = $this->PreciosDeProveedores_Modelo;
        $consulta  = jsonSolicitud();
        
        if ($this->input->server('REQUEST_METHOD')!=='POST') {
            echo $this->input->server('REQUEST_METHOD');
            restErrorMetodoNoPermitido();
        }
        
        if (!array_key_exists('precios', $consulta)
         || !array_key_exists('id_producto', $consulta)) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $precios->alta($consulta['precios'], $consulta['id_producto'])
        );
    }
    
    /**
     * Interfaz REST para actualizar los recios por proveedor de un producto.
     *
     * Esta operación solo se ejecuta con PUT.
     */
    public function actualizar()
    {
        $precios = $this->PreciosDeProveedores_Modelo;
        $consulta  = jsonSolicitud();
        
        if ($this->input->server('REQUEST_METHOD')!=='PUT') {
            restErrorMetodoNoPermitido();
        }
        
        if (!array_key_exists('precios', $consulta)) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
           $precios->actualizar($consulta['precios'])
        );
    }
    
    
    /**
     * Interfaz REST para eliminar los recios por proveedor de un producto.
     *
     * Esta operación solo se ejecuta con DELETE.
     */
    public function eliminar()
    {
        $precios = $this->PreciosDeProveedores_Modelo;
        $consulta  = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='DELETE') {
            restErrorMetodoNoPermitido();
        }
        
        if (empty($consulta['identificadores'])) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $precios->eliminar($consulta['identificadores'])
        );
    }
}