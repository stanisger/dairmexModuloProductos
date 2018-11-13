<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Requisicion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();		
		$this->load->model('Requisicion_model');
		$this->load->model('DetalleRequisicion_model');
		$this->load->model('Login_model');
		$this->load->library(array('session','form_validation',"pagination"));
		$this->load->helper(array('url','form'));
		$this->load->database('default');		                
    }
	
	public function index()
	{
		$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){

			$config 				= array();
	        $config["base_url"] 	= base_url() . "Requisicion/index";
	        $config["total_rows"] 	= $this->Requisicion_model->record_count($id_user);	        
	        $config["per_page"] 	= 10;
	        $config["uri_segment"] 	= 3;
	        $choice = $config["total_rows"] / $config["per_page"];
    		$config["num_links"] = round($choice);

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;	        	        
			$registros_usuario = $this->Requisicion_model->requisicion_usuario($id_user,$config["per_page"], $page);
			$data['seccion'] = 1;
			$data["links"] = $this->pagination->create_links();
			$data['registros_usuario'] = $registros_usuario;
			$this->load->view('requisicion_usuario_view',$data);

		}else{
			redirect(base_url().'Login/');
		}		
	}

	public function requisicion_borrador()
	{	
		$admin = $this->session->userdata('perfil');	
		if(!empty($admin) && $admin =='administrador'){

			$config 				= array();
	        $config["base_url"] 	= base_url() . "Requisicion/requisicion_borrador";
	        $config["total_rows"] 	= $this->Requisicion_model->record_count_adm();	        
	        $config["per_page"] 	= 10;
	        $config["uri_segment"] 	= 3;
	        $choice = $config["total_rows"] / $config["per_page"];
    		$config["num_links"] = round($choice);

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;	        	        			
			$registros_usuario 	= $this->Requisicion_model->requisicion_borrador($config["per_page"], $page);
			$data['seccion'] 	= 1;
			$data["links"] 		= $this->pagination->create_links();
			$data['registros_usuario'] = $registros_usuario;

			$usuarios 		= $this->Login_model->get_users();
			$formatdatauser = array(); 

			foreach ($usuarios as $usuario) {				
				$formatdatauser[$usuario->id]	= $usuario->nombre.' '.$usuario->apaterno;	
			}

			$data['usuarios']		   = 	$formatdatauser;
			$this->load->view('requisicion_borrador_view',$data);
		}else{
			redirect(base_url().'Login/');
		}		
	}

	public function requisicion_recent()
	{	
		$admin = $this->session->userdata('perfil');	
		if(!empty($admin) && $admin =='administrador'){

			$config 				= array();
	        $config["base_url"] 	= base_url() . "Requisicion/requisicion_recent";
	        $config["total_rows"] 	= $this->Requisicion_model->record_count_recent_adm();	        
	        $config["per_page"] 	= 10;
	        $config["uri_segment"] 	= 3;
	        $choice = $config["total_rows"] / $config["per_page"];
    		$config["num_links"] = round($choice);

	        $this->pagination->initialize($config);

	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;	
	        $data["links"] 		= $this->pagination->create_links();
			$registros_usuario 	= $this->Requisicion_model->requisicion_ultimas($config["per_page"], $page);
			$data['seccion'] 	= 1;			
			$data['registros_usuario'] = $registros_usuario;
			$usuarios 		= $this->Login_model->get_users();
			$formatdatauser = array(); 
			
			foreach ($usuarios as $usuario) {				
				$formatdatauser[$usuario->id]	= $usuario->nombre.' '.$usuario->apaterno;	
			}

			$data['usuarios']		   = 	$formatdatauser;
			$this->load->view('requisicion_recent_view',$data);

		}else{
			redirect(base_url().'Login/');
		}		
	}

	public function detalles($idre)
	{
		$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){
			if(!empty($idre) && $idre!==NULL){
				$idre 		= intval(strip_tags(trim($idre)));
				$registro_detalles 	= $this->Requisicion_model->detalle_requisicion($idre);				
				$data['registro_detalles'] = $registro_detalles;
				$this->load->view('detalles_requisicion_view',$data);	
			}else{
				$this->session->set_flashdata('error_requisicion','Identificador inválido.');
				$this->load->view('requisicion_usuario_view',$data);	
			}						
		}else{
			redirect(base_url().'Login/');
		}		
	}

	public function enviar_email($envia,$destino,$html){

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
	    $mail->SetFrom('backend@codehaus.mx','Dairmex - Nueva requisición');
	    $mail->Subject = "Dairmex - Nueva requisición";

	    $mail->Body = $html;	    
	    $mail->AddAddress($destino);
	    $mail->AddAddress($envia);	
	    $mail->AddAddress('admin@dairmex.com');    
	           
	     if(!$mail->Send()) {
	        return FALSE;
	     } else {        
	        return TRUE;
	     }
	}

	public function guardar_requisicion(){

		$perfil = $this->session->userdata('perfil');	
		if(!empty($perfil) && $perfil !=='administrador'){

			if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
			{
				$elementos_ordenados = array();			
				$x  = 0;
		
				if( (isset($_POST['limit']) && !empty($_POST['limit'])) || (isset($_POST['limitmobil']) && !empty($_POST['limitmobil'])) ){
					$limite  = (isset($_POST['limitmobil']) && !empty($_POST['limitmobil'])) ? intval($_POST['limitmobil']):intval($_POST['limit']);
					//echo $limite;die;		
					for ($i =1; $i <= $limite; $i++) { 
						if((isset($_POST['articulo-'.$i]) && !empty($_POST['articulo-'.$i])) && (isset($_POST['cantidad-'.$i]) && !empty($_POST['cantidad-'.$i])) && (isset($_POST['medida-'.$i]) && !empty($_POST['medida-'.$i])) && (isset($_POST['proyecto-'.$i]) && !empty($_POST['proyecto-'.$i]))){

							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['articulo-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['cantidad-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['medida-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['proyecto-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['comentarios-'.$i])));							

							$x++;
						}
					}
					if(count($elementos_ordenados)>0){
						$id_user = $this->session->userdata('id_usuario');
						if(!empty($id_user) && $id_user!==''){
							$folio 			= $this->Requisicion_model->folio();
							$folio 			= ($folio =='' || $folio ==NULL)?'RE00-1':'RE00-'.($folio+1);
							$flag_borrador  = 0;
						    if(isset($_POST['borrador']) && intval(strip_tags($_POST['borrador']))==1){
								$requesicion_id = $this->Requisicion_model->new_requisicion($id_user,2);
								$flag_borrador = 1;
							}else{
								$requesicion_id = $this->Requisicion_model->new_requisicion($id_user);	
							}
							
									
							if($requesicion_id!==NULL && $requesicion_id!==''){													
								foreach ($elementos_ordenados as $req) {
									$resultadoRequisicion = $this->DetalleRequisicion_model->nuevo_registro($req[0],$req[2],$req[1],utf8_decode($req[3]),$req[4],$folio,$requesicion_id,0,null,null);	
								}
								if($resultadoRequisicion===TRUE){

									if($flag_borrador ==0){
										
										date_default_timezone_set('America/Mexico_City');
										ini_alter('date.timezone','America/Mexico_City');
										$fecha			= date('Y-m-d');

										$data['folio']  			  = $folio;
										$data['fecha']  			  = $fecha;
										$data['elementos_ordenados']  = $elementos_ordenados;
										$data['de_email']  			  = $this->session->userdata('email');

										$Emailtemplate = $this->load->view('emails/template.php',$data,TRUE);								 

										$de_email 	= $this->session->userdata('email');									
										$para_email = 'compras@dairmex.com';		
										//$para_email = 'themstudio@hotmail.com';		

										$enviar_email = $this->enviar_email($de_email,$para_email,$Emailtemplate); 
										if($enviar_email==TRUE){
											$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');									
										}else{
											$this->session->set_flashdata('requisicion_valida','Error, no se pudo enviar el email de la operación');
										
										}
									}else{
										$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');
										redirect(base_url().'Requisicion/nueva_requisicion');
									}
								
									redirect(base_url().'Requisicion/nueva_requisicion');								
								}
							}

						}else{
							redirect(base_url().'Login');		
						}	
					}else{
						$this->session->set_flashdata('requisicion_invalida','Operación no realizable, formato de información incorrecto.');
						$this->load->view('nueva_requisicion_view');		
					}				
				}
			}else{
				redirect(base_url().'Login/');
			}
		}else{
			redirect(base_url().'Login/');
		}
	}

	public function editar($idre)
	{
		$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){
			if(!empty($idre) && $idre!==NULL && is_numeric(strip_tags(trim($idre))) ){
				$idre 		= intval(strip_tags(trim($idre)));
				$registro_detalles 	= $this->Requisicion_model->detalle_requisicion($idre);							
				$data['idre'] 				= $idre;
				$data['registro_detalles']  = $registro_detalles;
				$this->load->view('editar_requisicion_view',$data);	
			}else{
				$this->session->set_flashdata('error_requisicion','Identificador inválido.');
				$this->load->view('requisicion_usuario_view',$data);	
			}						
		}else{
			redirect(base_url().'Login/');
		}		
	}

	public function editar_requisicion(){

		if($this->input->server('REQUEST_METHOD') == 'POST' && count($_POST)>0)
		{
			
			if( isset($_POST['idre']) && !empty($_POST['idre']) && is_numeric(strip_tags(trim($_POST['idre']))) ){				

				$limite  = (isset($_POST['limitmobil']) && !empty($_POST['limitmobil'])) ? intval($_POST['limitmobil']):intval($_POST['limit']);

					$requesicion_id  = intval(strip_tags(trim($_POST['idre'])));
				
					$elementos_ordenados = array();			
					$x  = 0;

					for ($i =1; $i <= $limite; $i++) { 
						if((isset($_POST['articulo-'.$i]) && !empty($_POST['articulo-'.$i])) && (isset($_POST['cantidad-'.$i]) && !empty($_POST['cantidad-'.$i])) && (isset($_POST['medida-'.$i]) && !empty($_POST['medida-'.$i])) && (isset($_POST['proyecto-'.$i]) && !empty($_POST['proyecto-'.$i]))) {

							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['articulo-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['cantidad-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['medida-'.$i])));
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['proyecto-'.$i])));							
							$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['comentarios-'.$i])));
							if( isset($_POST['estatus-'.$i]) ){
								$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['estatus-'.$i])));	
							}else{
								$elementos_ordenados[$x][] =	0;	
							}
							if( isset($_POST['fecha_entrega-'.$i]) && !empty($_POST['fecha_entrega-'.$i]) ){
								$elementos_ordenados[$x][] =	strip_tags(htmlentities(trim($_POST['fecha_entrega-'.$i])));
							}else{
								$elementos_ordenados[$x][] =	NULL;	
							}
							
							$x++;
						}
					}
					if(count($elementos_ordenados)>0){
						$id_user = $this->session->userdata('id_usuario');
						if(!empty($id_user) && $id_user!==''){		
							if($requesicion_id!==NULL && $requesicion_id!==''){													

								$folio = 'RE00-'.$requesicion_id;
								$previos_registros = $this->DetalleRequisicion_model->borrar_registros_previos($requesicion_id);								
								if($previos_registros){									
									foreach ($elementos_ordenados as $req) {
										$resultadoRequisicion = $this->DetalleRequisicion_model->nuevo_registro($req[0],$req[2],$req[1],utf8_decode($req[3]),$req[4],$folio,$requesicion_id,$req[5],1,$req[6]);	
									}
									if($resultadoRequisicion===TRUE){

										$flag_borrador  = 0;
									    if(isset($_POST['borrador']) && intval(strip_tags($_POST['borrador']))==1){					
											$flag_borrador = 1;
											$update_status 	= $this->Requisicion_model->update_status($requesicion_id,2);
										}else{
											$update_status 	= $this->Requisicion_model->update_status($requesicion_id);				
										}

										$perfil = $this->session->userdata('perfil');	
										if(!empty($perfil) && $perfil=='administrador'){

											$email_user = $this->Requisicion_model->requisicion_enviar_estatus($requesicion_id);											
											if(count($email_user) > 0){

												date_default_timezone_set('America/Mexico_City');
												ini_alter('date.timezone','America/Mexico_City');
												$fecha			= date('Y-m-d');

												$data['folio']  			  = $folio;
												$data['fecha']  			  = $fecha;
												$data['elementos_ordenados']  = $elementos_ordenados;
												$data['de_email']  			  = $this->session->userdata('email');

												$Emailtemplate = $this->load->view('emails/template.php',$data,TRUE);								 

												$de_email 	= $this->session->userdata('email');									
												$para_email = $email_user[0]->email;		
												//$para_email = 'themstudio@hotmail.com';		

												$enviar_email = $this->enviar_email($de_email,$para_email,$Emailtemplate); 
												if($enviar_email==TRUE){
													$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');									
												}else{
													$this->session->set_flashdata('requisicion_valida','Error, no se pudo enviar el email de la operación');										
												}
											}

													

										}

										if($flag_borrador ==0){
											
											date_default_timezone_set('America/Mexico_City');
											ini_alter('date.timezone','America/Mexico_City');
											$fecha			= date('Y-m-d');

											$data['folio']  			  = $folio;
											$data['fecha']  			  = $fecha;
											$data['elementos_ordenados']  = $elementos_ordenados;
											$data['de_email']  			  = $this->session->userdata('email');

											$Emailtemplate = $this->load->view('emails/template.php',$data,TRUE);								 

											$de_email 	= $this->session->userdata('email');									
											$para_email = 'compras@dairmex.com';		
											//$para_email = 'themstudio@hotmail.com';		

											$enviar_email = $this->enviar_email($de_email,$para_email,$Emailtemplate); 
											if($enviar_email==TRUE){
												$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');									
											}else{
												$this->session->set_flashdata('requisicion_valida','Error, no se pudo enviar el email de la operación');										
											}										

										}else{
											$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');
											redirect(base_url().'Requisicion/editar/'.$requesicion_id);	
										}
									
										redirect(base_url().'Requisicion/editar/'.$requesicion_id);
									}
								}else{
									$this->session->set_flashdata('error_requisicion','No se pudo actualizar la información');
									redirect(base_url().'Requisicion/index');	
								}
							}else{
								$this->session->set_flashdata('error_requisicion','Identificador inválido.');
								redirect(base_url().'Requisicion/index/');	
							}

						}else{
							redirect(base_url().'Login');		
						}	
				}else{
					$this->session->set_flashdata('requisicion_invalida','Operación no realizable, formato de información incorrecto.');
					redirect(base_url().'Requisicion/editar/'.$requesicion_id);
				}

			}else{
				$this->session->set_flashdata('error_requisicion','Identificador inválido.');
				$this->load->view('editar_requisicion_view');
			}
			
		}else{
			redirect(base_url().'Login/');
		}
	}

	public function enviar_requisicion($idr){
		
		if($idr !=0 && is_numeric($idr)){
			
			$id_user = $this->session->userdata('id_usuario');
			$registro_detalles 	= $this->Requisicion_model->requisicion_id($idr,$id_user);
			$elementos_ordenados = array();
			if(count($registro_detalles)>0){
				$x=0;
				foreach($registro_detalles as $registro){
					
					$elementos_ordenados[$x][] =	$registro->articulo;
					$elementos_ordenados[$x][] =	$registro->cantidad;
					$elementos_ordenados[$x][] =	$registro->medida;
					$elementos_ordenados[$x][] =	$registro->proyecto;					
					$elementos_ordenados[$x][] =	$registro->comentarios;
					$elementos_ordenados[$x][] =	$registro->estatus;
					$x++;	
				}	
				
				date_default_timezone_set('America/Mexico_City');
				ini_alter('date.timezone','America/Mexico_City');
				$fecha			= date('Y-m-d');
				$data['folio']  			  = $registro_detalles[0]->folio;
				$data['fecha']  			  = $fecha;
				$data['elementos_ordenados']  = $elementos_ordenados;
				$data['de_email']  			  = $this->session->userdata('email');

				$Emailtemplate = $this->load->view('emails/template.php',$data,TRUE);								 

				$de_email 	= $this->session->userdata('email');									
				$para_email = 'compras@dairmex.com';						

				$enviar_email = $this->enviar_email($de_email,$para_email,$Emailtemplate); 
				if($enviar_email==TRUE){
					$update_status 	= $this->Requisicion_model->update_status($idr);					
					$this->session->set_flashdata('requisicion_valida','Operación realizada correctamente.');									
				}else{
					$this->session->set_flashdata('requisicion_valida','Error, no se pudo enviar el email de la operación');				
				}
				redirect(base_url().'Requisicion/index');
			}else{
				$this->session->set_flashdata('requisicion_valida','Error, id de requisición inválido');
				redirect(base_url().'Requisicion/index');	
			}
				
		}else{
			redirect(base_url().'Requisicion/index');
		}	
	}

	public function nueva_requisicion()
	{
		$folio 			= $this->Requisicion_model->folio();
		$folio 			= ($folio =='' || $folio ==NULL) ?'RE00-1':'RE00-'.($folio+1);
		$data['folio']  = $folio;

		$id_user = $this->session->userdata('id_usuario');
		if(!empty($id_user) && $id_user!==''){
			$this->load->view('nueva_requisicion_view',$data);
		}else{
			redirect(base_url().'Login');		
		}
	}

	public function estatus_req(){
		$result = array();
		if(isset($_POST) && count($_POST)>0){
			if( (isset($_POST['idr']) && !empty($_POST['idr'])) && (isset($_POST['estatus'])) ){
					
					$idr = intval(strip_tags($_POST['idr']));
					$est = intval(strip_tags($_POST['estatus']));
					$update_status 	= $this->Requisicion_model->update_statusRequisicion($idr,$est);
					
					if($update_status ==true){
						$result = array('code'=>1, 'txt'=>'Operación realizada correctamente');	
					}else{
						$result = array('code'=>0, 'txt'=>'Error, error inesperado, inténtelo nuevamente');	
					}

			}else{
				$result = array('code'=>0, 'txt'=>'Error, parámetos incorrectos');	
			}

		}else{
			$result = array('code'=>0, 'txt'=>'Error, parámetos incorrectos');
		}

		echo json_encode($result);
		die;
	}
	
}
