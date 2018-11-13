<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
	</head>
	<body>
		<div class="container_12">
			<div class="grid_12">				
				<h1 style="text-align: center">Bienvenido <?=$this->session->userdata('perfil')?></h1>				
				 <?=anchor(base_url().'Login/editar/'.$this->session->userdata('id_usuario'), 'Editar perfil')?>
				 <?=anchor(base_url().'Login/password/', 'Modificar password')?>
				 <?=anchor(base_url().'Requisicion/nueva_requisicion/', 'Nueva requisición')?>
				 <?=anchor(base_url().'login/logout_ci', 'Cerrar sesión')?>
			</div>			
			<?php 				
				if(isset($_GET['e']) && $_GET['e']==1)
				{
			?>
				<p>El usuario fue actualizado correctamente</p>
			<?php
				}						
			?>
			<?php 
				if(isset($_GET['e']) && $_GET['e']==2)
				{
			?>
				<p>El usuario no pudo ser actualizado</p>
			<?php
				}						
			?>
			<br/><br/>
			<h3>Datos del perfil</h3>
			<br/><br/>
			<p>Nombre: <?php echo ($usuario[0]->nombre !=='') ? $usuario[0]->nombre: ''; ?></p>
			<br/>
			<p>Apellido paterno: <?php echo ($usuario[0]->apaterno !=='') ? $usuario[0]->apaterno: ''; ?></p>
			<br/>
			<p>Apellido materno: <?php echo ($usuario[0]->amaterno !=='') ? $usuario[0]->amaterno: ''; ?></p>
			<br/>
			<p>Email: <?php echo ($usuario[0]->email !=='') ? $usuario[0]->email: ''; ?></p>
			<br/>
			<p>Teléfono: <?php echo ($usuario[0]->telefono !=='') ? $usuario[0]->telefono: ''; ?></p>
			<br/>

		</div>	
	</body>
</html>