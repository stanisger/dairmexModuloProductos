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
class Productos extends CI_Controller
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
    
    /**
     * Acción incial.
     */
    public function index()
    {
        $this->load->view('productos');
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
        
        
        jsonRespuesta(
          $productos->paginador(
            $consulta['pagina'], $consulta['elementos']
          ));
    }
    
    /**
     * Enlace de consulta de los detalles completos de un listado de productos.
     *
     * Esta operación solo se consulta con GET.
     */
    public function obtenerDetalles()
    {
        $productos = $this->Productos_Modelo;
        $consulta  = $_GET;
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        if ( !$consulta['identificadores'] ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
          $productos->obtenerDetalles($consulta['identificadores'])
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
            $productos->agregar($consulta['productos'])
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
        $consulta  = $_GET;
        
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