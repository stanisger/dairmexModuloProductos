<?php
/**
 * Este controlador representa el flujo de operaciones de Altas, Bajas y
 * Consolutas con los registros de proveedores de productos como REST API. 
 * 
 * @author Ricardo Bermúdez Bermúdez <ricardob.sistemas@gmail.com>
 * @since  Dec 12th, 2018.
 * @use    CI_Controller
 */
class Proveedores extends CI_Controller
{
    
    /**
     * Inicializa el controlador.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proveedores_Modelo');
        $this->load->helper(['resterror','restresponsejson']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
    }
    
    /**
     * Obtiene todos los proveedores de la base de datos con algún nombre
     * parecido al que se pasa a través de la URL en el parámetro
     * <b>nombre</b>.
     *  
     * Esta operación solo se puede utilizar con el método GET.
     */
    public function obtenerPorNombre()
    {
        $proveedores = $this->Proveedores_Modelo;
        $consulta    = $_GET;
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        if ( !$consulta['nombre'] || count($consulta)>1 ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $proveedores->obtenerPorNombre($consulta['nombre'])
        );
    }
    
    /**
     * Regresa los detalles completos de cada proveedor pasado en el vector
     * <b>identificadores</b> que viene como parámetro en la URL de petición.
     * 
     * Esta operación solo se puede utilizar con el método GET.
     */
    public function obtenerDetalles()
    {
        $proveedores = $this->Proveedores_Modelo;
        $consulta    = $_GET;
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        
        if ( !$consulta['identificadores'] ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $proveedores->obtenerDetalles($consulta['identificadores'])
        );
    }
    
    /**
     * Elimina el proveedor de la base de datos y todos sus precios asociados a
     * los distintos productos.
     * 
     * Esta operación solo se puede utilizar con el método DELETE. 
     */
    public function eliminar()
    {
        
    }
}