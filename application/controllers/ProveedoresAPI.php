<?php
/**
 * Este controlador representa el flujo de operaciones de Altas, Bajas y
 * Consolutas con los registros de proveedores de productos como REST API. 
 * 
 * @author Ricardo Berm�dez Berm�dez <ricardob.sistemas@gmail.com>
 * @since  Dec 12th, 2018.
 * @use    CI_Controller
 */
class ProveedoresAPI extends CI_Controller
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
     * Regresa los detalles completos de cada proveedor pasado en el vector
     * <b>identificadores</b> que viene como par�metro en la URL de petici�n.
     * 
     * Esta operaci�n solo se puede utilizar con el m�todo GET.
     */
    public function obtener()
    {
        $proveedores = $this->Proveedores_Modelo;
        $consulta    = $this->input->get();
        
        if ($this->input->server('REQUEST_METHOD')!=='GET') {
            restErrorMetodoNoPermitido();
        }
        
        if ( !$consulta['identificadores'] ) {
            restErrorOperacionNoPermitida();
        }
        
        jsonRespuesta(
            $proveedores->obtener($consulta['identificadores'])
        );
    }
    
    
    /**
     * Obtiene todos los proveedores de la base de datos con alg�n nombre
     * parecido al que se pasa a trav�s de la URL en el par�metro
     * <b>nombre</b>.
     *
     * Esta operaci�n solo se puede utilizar con el m�todo GET.
     */
    public function obtenerPorNombre()
    {
        $proveedores = $this->Proveedores_Modelo;
        $consulta    = $this->input->get();
        
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
}