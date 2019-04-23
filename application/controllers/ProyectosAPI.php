<?php
class ProyectosAPI extends CI_Controller
{
    /**
     *  Inicializa los datos de sesión y la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Reportes_Modelo']);
        $this->load->helper(['resterror','restresponsejson']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
        
        if (!$this->session->userdata('is_logued_in')) {
            restAccesoDenegado();
        }
    }
    
    public function index() 
    {
        jsonRespuesta(
            $this->Reportes_Modelo->totalDeRegistros()
        );
    }
    
    public function reporte() 
    {
        if ($this->input->server('REQUEST_METHOD')==='POST') {
            $reporte = jsonSolicitud();
            
            jsonRespuesta(
                $this->Reportes_Modelo->agregar($reporte)
            );
        }
        if ($this->input->server('REQUEST_METHOD')==='DELETE') {
            jsonRespuesta(
                $this->Reportes_Modelo->eliminar(
                    $this->input->get('id')
                )
            );
        }
    }
    
    
}