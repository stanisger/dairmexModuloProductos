<!DOCTYPE html>
	<html lang="es">
	<head>
		   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		   <meta charset="utf-8">
		    <meta http-equiv="x-ua-compatible" content="ie=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <title>CRM DAIRMEX</title>
		   <link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>css/foundation-icons.css" media="screen" />
		   <link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>css/foundation.css" media="screen" />
		   <link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>css/app.css" media="screen" />
		   <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		   <script type="text/javascript">
		   		$(document).ready(function(){
		   			$(".menu vertical").click(function(){
		   				$(".menu vertical a").removeClass('is-active');
		   				$(this).addClass('is-active');
		   			});
		   		});
		   </script>
	</head>
	<body>
		<?php if($this->session->userdata('id_usuario')!==null && !empty($this->session->userdata('id_usuario'))){
		?>
			<div class="user">
			  	<div class="content">
			  		<p class="regular colorWhite"><?php echo $this->session->userdata('username'); ?></p>
			  		<span >|</span>
			  		<a href="<?php echo base_url().'Login/logout_ci';?>" class="regular">Cerra Sesión</a>
			  	</div>
			  </div>
		<?php	
			} 
		?>
  
