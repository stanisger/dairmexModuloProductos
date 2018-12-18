<?php
/**
 * Este controlador representa el flujo de operaciones de Altas, Bajas y
 * Consultas que puede realizar el usuario a la tabla de productos como API
 * REST.
 * 
 * @author Ricardo Bermúdez Bermúdez <ricardob.sistemas@gmail.com>
 * @since  Nov 19th, 2018. <f.c.>
 * @use    CI_Controller
 */
class ProductosAPI extends CI_Controller
{
    /**
     *  Inicializa los datos de sesión y la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Productos_Modelo']);
        $this->load->helper(['resterror','restresponsejson']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
    }
    
    
    /***/
    public function totalDeRegistros() {
        jsonRespuesta(
            $this->Productos_Modelo->totalDeRegistros()
        );
    }
    
    
    /**
     * Enlace de consulta de productos para un paginador principal.
     *  
     * Esta operación solo se consulta con GET.
     */
    public function paginador()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        if ( !($consulta['pagina'] && $consulta['elementos']) ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta($productos->paginador($consulta));
    }
    
    
    /**
     * Enlace de consulta de los detalles completos de un listado de productos.
     *
     * Esta operación solo se consulta con GET.
     */
    public function obtener()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        if ( !$consulta['identificadores'] ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
          $productos->obtener($consulta['identificadores'])
        );
    }
    
    
    /***/
    public function obtenerPorNombre()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        
        jsonRespuesta(
            $productos->obtenerPorNombre($consulta['nombre'])
        );
    }
    
    /**
     * Operación para agregar un listado de nuevos productos a la base de
     * datos.
     * 
     * Esta operación solo se consulta con POST. 
     */
    public function alta()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = jsonSolicitud();
        
        if ($this->input->server('REQUEST_METHOD')!=='POST') {
            echo $this->input->server('REQUEST_METHOD');
            restErrorMetodoNoPermitido();
        }
        
        if (!array_key_exists('productos', $consulta)) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $productos->alta($consulta['productos'])
        );
    }
    
    
    /**
     * Permite la edición de productos ya existentes.
     * 
     * Esta operación solo se ejecuta con PUT.
     */
    public function actualizar()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = jsonSolicitud();
        
        if ($this->input->server('REQUEST_METHOD')!=='PUT') {
            restErrorMetodoNoPermitido();
        }
        
        if (!array_key_exists('productos', $consulta)) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $productos->actualizar($consulta['productos'])
        );
    }
    
    
    /**
     * Elimina un listado de productos de la base de datos.
     * 
     * Esta operación solo se ejecuta con DELETE.
     * Los argumentos de ejecución van a través de la URL.
     */
    public function eliminar()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='DELETE') {
            restErrorMetodoNoPermitido();
        }
        
        if (empty($consulta['identificadores'])) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $productos->eliminar($consulta['identificadores'])
        );
    }
}