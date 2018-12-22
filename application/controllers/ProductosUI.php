<?php
class ProductosUI extends CI_Controller
{
    /**
     *  Inicializa los datos de sesi�n y la base de datos.
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
     * Vista principal del m�dulo de productos.
     */
    public function index()
    {
        $this->load->view('productos');
    }
    
    public function alta()
    {
        $this->load->view('productos_alta_edicion');
    }
    
    public function editar()
    {
        $this->load->view('productos_alta_edicion');
    }
}