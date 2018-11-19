<?php
/**
 * Este controlador representa el flujo de operaciones de Altas, Bajas y
 * Consultas que puede realizar el usuario a la tabla de productos.
 * 
 * @author Ricardo Berm�dez Berm�dez <ricardob.sistemas@gmail.com>
 * @since  Nov 19th, 2018. <f.c.>
 * @use CI_Controller
 */
class Productos extends CI_Controller{
    
    /**
     *  Inicializa los datos de sesi�n y la base de datos.
     */
    public function __construct(){
        parent::__construct();
        $this->load->library(array('session','form_validation',"pagination"));
        $this->load->helper(array('url','form'));
        $this->load->database('default');
    }
    
    /**
     * Acci�n inicial.
     */
    public function index() {
        $this->load->view('productos');
    }
}