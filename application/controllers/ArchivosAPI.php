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
        $direcciónImagen = "img/subidas/{$consulta['nombre']}.{$consulta['extension']}";
        
        if (file_exists($direcciónImagen)) {
            unlink($direcciónImagen);
        }
        
        if (file_put_contents(
              $direcciónImagen,
              base64_decode($consulta['contenido'])
        )) {
            jsonRespuesta([ 'url' => $direcciónImagen ]);
        } else {
            restError('Problemas al cargar la imagen', 500);
        };
    }
}