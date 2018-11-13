<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DetalleRequisicion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Login_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->database('default');
    }
	
	public function index()
	{	
		$usuario 			= $this->Login_model->get_user($this->session->userdata('id_usuario'));			
		$data['usuario'] 	= $usuario;
		switch ($this->session->userdata('perfil')) {	
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Acceso al sistema';
				$this->load->view('login_view',$data);
				break;
			case 'administrador':
				$this->load->view('admin_view',$data);				
				break;
			case 'editor':
				redirect(base_url().'editor');
				break;	
			case 'suscriptor':
				$this->load->view('suscriptor_view',$data);
				break;
			default:		
				$data['titulo'] = 'Acceso al sistema';
				$this->load->view('login_view',$data);
				break;		
		}
	}

	public function new_user()
	{
			if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
			{
				
	            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[150]');
	 
	 			$this->form_validation->set_message('required','El %s es obligatorio');	            
	            $this->form_validation->set_message('valid_email','El %s no es válido');
	            $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
	            $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');

	        	//lanzamos mensajes de error si es que los hay            
				if($this->form_validation->run() == FALSE)
				{	
					$data['token'] 	= $this->token();
					$data['titulo'] = 'Acceso al sistema';
					$this->load->view('login_view',$data);				
					
				}else{
					$email = $this->input->post('email');
					$password = sha1($this->input->post('password'));
					$check_user = $this->Login_model->login_user($email,$password);
					if($check_user == TRUE)
					{
						$data = array(
		                'is_logued_in' 	=> 		TRUE,
		                'id_usuario' 	=> 		$check_user->id,
		                'perfil'		=>		$check_user->perfil,
		                'username' 		=> 		$check_user->username
	            		);		
						$this->session->set_userdata($data);
						$this->index();
					}
				}
			}else{
				redirect(base_url().'Login/');
			}
	}

	public function registro()
    {
        $data = array('titulo' => 'Registro de usuario');

        $this->load->view('register_view',$data);
    }

    public function password()
    {
        $data = array('titulo' => 'Modificar password');

        $this->load->view('password_view',$data);
    }

    public function update_password(){

    	if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
        {

        	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[150]');
	        $this->form_validation->set_rules('cpassword', 'Confirmar password', 'required|matches[password]|trim|min_length[8]|max_length[150]');
	        $this->form_validation->set_message('required','El %s es obligatorio');                
	        $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
	        $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');        

	        if($this->form_validation->run() == FALSE)
	        {
						
				$this->load->view('password_view');

            }else{
            	$id 		= $this->session->userdata('id_usuario');
            	$password 	= sha1($this->input->post('password',TRUE));
            	if($this->Login_model->password_user($id,$password) == TRUE){
        			$this->session->set_flashdata('password_incorrecto','Password actualizado correctamente');
					$this->load->view('password_view');
        		}else{
        			$this->session->set_flashdata('password_incorrecto','Password no actualizado');
					$this->load->view('password_view');
        		}
	        }
        }else{
        	$this->session->set_flashdata('password_incorrecto','Error, parámetros incorrectos');
			redirect(base_url().'Login/password','refresh');
        }
    	
    }
 
 	//función para eliminar usuarios
    public function delete_user()
    {
        
        //comprobamos si es una petición ajax y existe la variable post id
        if($this->input->is_ajax_request() && $this->input->post('id'))
        {

        	$id = $this->input->post('id');

			$this->Login_model->delete_user($id);

        }

    }
 
 	//con esta función añadimos y editamos usuarios dependiendo 
 	//si llega la variable post id, en ese caso editamos
    public function save_user()
    {

    	//comprobamos si es una petición ajax
    	if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
        {            
        	                    	

            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[100]');            
            $this->form_validation->set_rules('apaterno', 'Apellido Paterno', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('amaterno', 'Apellido Materno', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|trim');
            $this->form_validation->set_rules('perfil', 'Perfil', 'required|min_length[1]|max_length[2]|regex_match[/^[1-3]{1}$/]|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[150]');
            $this->form_validation->set_rules('cpassword', 'Confirmar password', 'required|matches[password]|trim|min_length[8]|max_length[150]');
            
            $this->form_validation->set_message('required','El %s es obligatorio');
            $this->form_validation->set_message('is_unique','El %s ya está registrado');
            $this->form_validation->set_message('valid_email','El %s no es válido');
            $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');
            $this->form_validation->set_message('regex_match','El %s es inválido');
			
            if($this->form_validation->run() == FALSE)
            {
					
				$this->load->view('register_view');

            }else{

            	$perfil 	= $this->input->post('perfil',TRUE);
            	$nombre 	= $this->input->post('nombre',TRUE);
	        	$apaterno 	= $this->input->post('apaterno',TRUE);
	        	$amaterno 	= $this->input->post('amaterno',TRUE);
	        	$telefono 	= $this->input->post('telefono',TRUE);
	        	$email 		= $this->input->post('email',TRUE);	        	
	        	$password 	= sha1($this->input->post('password',TRUE));	        	

        		if($this->Login_model->new_user($perfil,$nombre,$apaterno,$amaterno,$telefono,$email,$password) == TRUE){
        			$this->session->set_flashdata('registro_correcto','El usuario fué registrado correctamente');
					redirect(base_url().'Login','refresh');
        		}            		        	

            }
 
        }
        
    }

    public function update_user(){

    	if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
        {            
        	                    	

            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[100]');            
            $this->form_validation->set_rules('apaterno', 'Apellido Paterno', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('amaterno', 'Apellido Materno', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|trim');
            $this->form_validation->set_rules('perfil', 'Perfil', 'required|min_length[1]|max_length[2]|regex_match[/^[1-3]{1}$/]|trim');            
            $this->form_validation->set_message('required','El %s es obligatorio');            
            $this->form_validation->set_message('valid_email','El %s no es válido');
            $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');
            $this->form_validation->set_message('regex_match','El %s es inválido');
			
            if($this->form_validation->run() == FALSE)
            {
					
				$this->load->view('register_view');

            }else{
	        	//si estamos editando
            	if($this->input->post('id'))
            	{
            		$nombre 	= $this->input->post('nombre',TRUE);
		        	$apaterno 	= $this->input->post('apaterno',TRUE);
		        	$amaterno 	= $this->input->post('amaterno',TRUE);
		        	$telefono 	= $this->input->post('telefono',TRUE);
		        	$email 		= $this->input->post('email',TRUE);
            		$id = $this->input->post('id');

            		$usuario 			= $this->Login_model->get_user($id);			
					$data['usuario'] 	= $usuario;

            		if($this->Login_model->edit_user($id,$nombre,$apaterno,$amaterno,$telefono,$email) == 1){            								            			
            			redirect(base_url().'Login/index/e/1','refresh');

            		}else{
            			
						redirect(base_url().'Login/index/e/2','refresh');
            		}
            		
            	}else{            	            		
					redirect(base_url().'Login/index/e/2','refresh');
            	}	        	

            }
 
        }
    }

    public function editar($id_usuario){
    	
    	if(!empty($id_usuario)){

			$usuario 			= $this->Login_model->get_user($id_usuario);			
			$data['usuario'] 	= $usuario;
			$data['titulo'] 	= 'Editar perfil';
			$this->load->view('editar_view',$data);

    	}else{
    		$this->session->set_flashdata('id_invalido','El id del es inválido.');
			$this->index();
    	}
    }
	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function logout_ci()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
