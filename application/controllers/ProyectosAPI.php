<?php
class ProyectosAPI extends CI_Controller
{
    /**
     *  Inicializa los datos de sesión y la base de datos.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Reportes_Modelo', 'Equipos_Modelo']);
        $this->load->helper(['resterror','restresponsejson','cors_config']);
        $this->load->library(['session','form_validation',"pagination"]);
        $this->load->helper(array('url','form'));
        $this->load->database('default');
        
        CORSAvailability();
        
        if ($this->input->server('REQUEST_METHOD')==='OPTIONS') {
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
            if (!empty($this->input->get('id'))){
               jsonRespuesta( $this->Reportes_Modelo->obtener($this->input->get('id')) );
            } else {
               jsonRespuesta( $this->Reportes_Modelo->obtenerPorFiltro(
                   $this->input->get('fecha'),
                   $this->input->get('ciudad'),
                   $this->input->get('nombre')
               ) );
            }
            
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
    
    public function equipo()
    {
        
        if ($this->input->server('REQUEST_METHOD')==='GET') {
            jsonRespuesta(
                $this->Equipos_Modelo
                ->obtenerPorReporte($this->input->get('id_reporte'))
            );
        }
        
        if ($this->input->server('REQUEST_METHOD')==='POST') {
          $equipo = jsonSolicitud();
          jsonRespuesta( $this->Equipos_Modelo->agregar($equipo) );
        }
        
        if ($this->input->server('REQUEST_METHOD')==='DELETE') {
         jsonRespuesta(
           $this->Equipos_Modelo->eliminar($this->input->get('id_equipo'))
         );
        }
    }
}