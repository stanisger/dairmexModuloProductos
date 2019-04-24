<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Login_model');
		$this->load->helper(['resterror','restresponsejson', 'cors_config']);
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->database('default');
    }
	
	public function index()
	{	
		$usuario 			= $this->Login_model->get_user($this->session->userdata('id_usuario'));			
		$data['usuario'] 	= $usuario;
		$data['inicio'] 	= 1;
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
	
	public function apiLogin() {
	    CORSAvailability();
	    
	    $consulta     = $this->input->get();
	    $credenciales = $this->Login_model->login_user_api($consulta['e'],$consulta['p']);
	    
	    if (empty($credenciales)) {
	        restAccesoDenegado();
	    }
	    
	    $credenciales['session_token'] = session_id();
	    $this->session->set_userdata($credenciales);
	    jsonRespuesta($credenciales);
	}
	
	public function apiLogout()
	{
	    CORSAvailability();
	    $this->session->sess_destroy();
	    
	    jsonRespuesta([
	        "code"    => 200,
	        "message" => "The session has destroyed",
	    ]);
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
		                'username' 		=> 		$check_user->nombre.' '.$check_user->apaterno,
		                'email' 		=> 		$check_user->email
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
    	$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){
	        $data = array('titulo' => 'Modificar password');

	        $this->load->view('password_view',$data);
	    }else{
			redirect(base_url().'Login/');	    	
	    }
    }

    public function update_password(){

    	if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
        {

        	$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[150]');
	        $this->form_validation->set_rules('cpassword', 'Confirmar password', 'required|matches[password]|trim|min_length[8]|max_length[150]');
	        $this->form_validation->set_message('required','El %s es obligatorio');
	        $this->form_validation->set_message('matches','El %s no es igual');                
	        $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
	        $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');        

	        if($this->form_validation->run() == FALSE)
	        {
						
				$this->load->view('password_view');

            }else{
            	$id 		= $this->session->userdata('id_usuario');
            	$password 	= sha1($this->input->post('password',TRUE));
            	if($this->Login_model->password_user($id,$password) == TRUE){
        			$this->session->set_flashdata('password_correcto','Password actualizado correctamente');
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
            $this->form_validation->set_rules('apaterno', 'Apellidos', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('empresa', 'Empresa', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|trim');
            $this->form_validation->set_rules('perfil', 'Perfil', 'required|min_length[1]|max_length[2]|regex_match[/^[1-3]{1}$/]|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[150]');
            $this->form_validation->set_rules('cpassword', 'Confirmar password', 'required|matches[password]|trim|min_length[8]|max_length[150]');
            
            $this->form_validation->set_message('required','%s es obligatorio');
            $this->form_validation->set_message('is_unique','%s ya está registrado');
            $this->form_validation->set_message('valid_email','%s no es válido');
            $this->form_validation->set_message('matches','El %s no es igual');
            $this->form_validation->set_message('max_length', '%s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', '%s no puede tener menos de %s carácteres');
            $this->form_validation->set_message('regex_match','%s es inválido');
			
            if($this->form_validation->run() == FALSE)
            {
					
				$this->load->view('register_view');

            }else{

            	$perfil 	= $this->input->post('perfil',TRUE);
            	$nombre 	= $this->input->post('nombre',TRUE);
	        	$apaterno 	= $this->input->post('apaterno',TRUE);
	        	$empresa 	= $this->input->post('empresa',TRUE);
	        	$telefono 	= $this->input->post('telefono',TRUE);
	        	$email 		= $this->input->post('email',TRUE);	        	
	        	$password 	= sha1($this->input->post('password',TRUE));	        	

        		if($this->Login_model->new_user($perfil,$nombre,$apaterno,$empresa,$telefono,$email,$password) == TRUE){
					$fullname = $nombre.' '.$apaterno;
					$Emailtemplate ="<!DOCTYPE html>
													<html>
													<head>
														<title>Accesos CRM Dairmex</title>
													</head>
													<body>
														<br><br>
														<p><b>Hola: ".$fullname."</b> tus accesos a CRM Dairmex son:</p>
														<table>
															<tbody>
																<tr>
																	<td>Usuario: </td><td>".$email."</td>
																	<td>Password: </td><td>".$this->input->post('password',TRUE)."</td>
																</tr>
															</tbody>
														</table>
													</body>
													</html>";

								$de_email 	= 'backend@codehaus.mx';
								$para_email = $email;		

								$enviar_email = $this->enviar_email_password($de_email,$para_email,$Emailtemplate); 
								if($enviar_email==TRUE){
									$this->session->set_flashdata('registro_correcto','El usuario fué registrado correctamente, sus accesos han sido enviados al email proporcionado');
								}else{	
									$this->session->set_flashdata('registro_correcto','El usuario fué registrado correctamente, no se pudo enviar el email con sus accesos');
								}        			        			
								redirect(base_url().'Login','refresh');
        		}            		        	

            }
 
        }
    }

    public function enviar_email_password($envia,$destino,$html){

		require_once(APPPATH.'libraries/PHPMailer/class.phpmailer.php');	
	  	$mail = new PHPMailer(); // create a new object	  	
	    $mail->CharSet="UTF-8";
	    $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
	    $mail->SMTPAuth = true; // authentication enabled
	    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
	    $mail->Host = "mail.codehaus.mx";
	    $mail->Port = 465; // or 587
	    $mail->IsHTML(true);
	    $mail->Username = "backend@codehaus.mx";
	    $mail->Password = "89CodeHaus";
	    $mail->SetFrom('backend@codehaus.mx','Dairmex - CRM');
	    $mail->Subject = "Dairmex - Accesos CRM";

	    $mail->Body = $html;	    
	    $mail->AddAddress($destino);  
	           
	     if(!$mail->Send()) {
	        return FALSE;
	     } else {        
	        return TRUE;
	     }
	}
        
    

    public function update_user(){

    	if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
        {            
        	                    	
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[2]|max_length[100]');            
            $this->form_validation->set_rules('apaterno', 'Apellidos', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('empresa', 'Empresa', 'required|trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required|min_length[10]|max_length[10]|regex_match[/^[0-9]{10}$/]|trim');
            $this->form_validation->set_rules('perfil', 'Perfil', 'required|min_length[1]|max_length[2]|regex_match[/^[1-3]{1}$/]|trim');            
            $this->form_validation->set_message('required','%s es obligatorio');            
            $this->form_validation->set_message('valid_email','%s no es válido');
            $this->form_validation->set_message('max_length', '%s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', '%s no puede tener menos de %s carácteres');
            $this->form_validation->set_message('regex_match','%s es inválido');
			
            if($this->form_validation->run() == FALSE)
            {
            	$id_usuario 		= $this->session->userdata('id_usuario');            	
				$usuario 			= $this->Login_model->get_user($id_usuario);			
				$data['usuario'] 	= $usuario;				
				$this->load->view('editar_view',$data);

            }else{
	        	//si estamos editando
            	if($this->input->post('id'))
            	{
            		$nombre 	= $this->input->post('nombre',TRUE);
		        	$apaterno 	= $this->input->post('apaterno',TRUE);
		        	$empresa 	= $this->input->post('empresa',TRUE);
		        	$telefono 	= $this->input->post('telefono',TRUE);
		        	$email 		= $this->input->post('email',TRUE);
            		$id_usuario = $this->session->userdata('id_usuario');



            		if($this->Login_model->edit_user($id_usuario,$nombre,$apaterno,$empresa,$telefono,$email) == 1){            		

            		 	$this->session->set_userdata('username', $nombre.' '.$apaterno);
            		 	$this->session->set_userdata('email', $email);								                       			
            			$this->session->set_flashdata('update_correcto','El usuario fué actualizado correctamente');
            			$this->editar($id_usuario);

            			//redirect(base_url().'Login/index/e/1','refresh');
            		}else{
						$this->session->set_flashdata('update_incorrecto','Error, el usuario no fué actualizado');
            			$this->editar($id_usuario);            			
            		}
            		
            	}else{            	            		
            		$this->session->set_flashdata('update_incorrecto','Error, el usuario no fué actualizado');
            		$this->editar($id_usuario);						
            	}	        	

            }
 
        }
    }

    public function editar($id_usuario){
    	$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){
	    	if(!empty($id_usuario) && $id_user == $id_usuario){

				$usuario 			= $this->Login_model->get_user($id_usuario);			
				$data['usuario'] 	= $usuario;
				$data['titulo'] 	= 'Editar perfil';
				$this->load->view('editar_view',$data);

	    	}else{
	    		$this->session->set_flashdata('id_invalido','El id del es inválido.');
				$this->index();
	    	}
	    }else{
	    	redirect(base_url().'Login/');
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