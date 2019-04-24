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
        $this->load->helper(['resterror','restresponsejson','cors_config']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
        
        CORSAvailability();
        if($this->input->server('REQUEST_METHOD')==='OPTIONS'){
            exit(0);
        }
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
        if ($this->input->server('REQUEST_METHOD')==='GET') {
            jsonRespuesta(
                $this->Reportes_Modelo->obtener(
                    $this->input->get('id')
                )
            );
        }
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