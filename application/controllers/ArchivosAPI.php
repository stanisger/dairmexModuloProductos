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
        $direcci�nImagen = "img/subidas/{$consulta['nombre']}.{$consulta['extension']}";
        
        if (file_exists($direcci�nImagen)) {
            unlink($direcci�nImagen);
        }
        
        if (file_put_contents(
              $direcci�nImagen,
              base64_decode($consulta['contenido'])
        )) {
            jsonRespuesta([ 'url' => $direcci�nImagen ]);
        } else {
            restError('Problemas al cargar la imagen', 500);
        };
    }
}