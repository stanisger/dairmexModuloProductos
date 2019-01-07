<?php

class ArchivosAPI extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['resterror','restresponsejson']);
        $this->load->library(['session']);
        $this->load->database('default');
    }
    
    public function imagenes()
    {
        $consulta  = jsonSolicitud();
        $direccionImagenes = APPPATH . '../img/subidas/';
        
        if (file_put_contents(
            $direccionImagenes
          . $consulta['nombre'] . '.'
          . $consulta['extension'],
          base64_decode($consulta['contenido'])
        )) {
            jsonRespuesta(['url'=>"img/subidas/{$consulta['nombre']}.{$consulta['extension']}"]);
        } else {
            restError('Problemas al cargar la imagen', 500);
        };
    }
}