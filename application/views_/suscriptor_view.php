<?php
require('header.php');
?>
	<body>	

	    <div class="app-dashboard shrink-medium">
        		<!--∆ head -->
		  <?php require('head.php'); ?>   

		 <!-- ∆∆ Body off canvas -->
		  <div class="app-dashboard-body off-canvas-wrapper">
			      
		      <!-- ∆menus -->	
		     <?php require('sidebar_menu.php'); ?>   

    <div id="app-dashboard-sidebar" class="app-dashboard-sidebar position-left off-canvas off-canvas-absolute reveal-for-medium" data-off-canvas>
      <div class="app-dashboard-sidebar-title-area">
        <div class="app-dashboard-close-sidebar">
          <!-- Close button -->
          <button id="close-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-sidebar-close-button show-for-medium" aria-label="Close menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-left"></i></a></span>
          </button>
        </div>
        <div class="app-dashboard-open-sidebar">
          <button id="open-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-open-sidebar-button show-for-medium" aria-label="open menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-right"></i></a></span>
          </button>
        </div>
      </div>
     <?php require('sidebar_menu.php'); ?>      
    </div>

    <div class="app-dashboard-body-content off-canvas-content contenido" data-off-canvas-content>
    	<div class="contenido">
	      <h2 class="font2 colorFont light"><strong class="bold">Bienvenido</strong> al sistema de requisiciones<br> de Dairmex </h2>
	      <p class="regular colorFont">Hola <strong><?php echo $this->session->userdata('username'); ?></strong> te damos la bienvenida a nuestro sistema de requisiciones, está herramienta nos brinda un mejor control sobre tus ordenes de compra. 
Aquí podrás revisar el historial de estás, así como editar tu perfil de usuario. </p>
	    </div>

    </div>
  </div>
</div>
<!--
 <div class="container_12">
 <div class="grid_12">
 <h1 style="text-align: center">Bienvenido usuario</h1>
 <?=anchor(base_url().'Login/editar/'.$this->session->userdata('id_usuario'), 'Editar perfil')?>
 <?=anchor(base_url().'Login/password/', 'Modificar password')?>
 <?=anchor(base_url().'Requisicion/', 'Mis requisiciones')?>
 <?=anchor(base_url().'Requisicion/nueva_requisicion/', 'Nueva requisición')?>
 <?=anchor(base_url().'Login/logout_ci', 'Cerrar sesión')?>
 </div>
 <h3>Datos del perfil</h3>
 	<?php 	
 				$get = $this->uri->uri_to_assoc();				
				if(isset($get['e']) && $get['e']==1)
				{
			?>
				<p>El usuario fue actualizado correctamente</p>
			<?php
				}						
			?>
			<?php 
				if(isset($get['e']) && $get['e']==2)
				{
			?>
				<p>El usuario no pudo ser actualizado</p>
			<?php
				}						
			?>
	<br/><br/>
	<p>Nombre: <?php echo ($usuario[0]->nombre !=='') ? $usuario[0]->nombre: ''; ?></p>
	<br/>
	<p>Apellido paterno: <?php echo ($usuario[0]->apaterno !=='') ? $usuario[0]->apaterno: ''; ?></p>
	<br/>
	<p>Empresa: <?php echo ($usuario[0]->empresa !=='') ? $usuario[0]->empresa: ''; ?></p>
	<br/>
	<p>Email: <?php echo ($usuario[0]->email !=='') ? $usuario[0]->email: ''; ?></p>
	<br/>
	<p>Teléfono: <?php echo ($usuario[0]->telefono !=='') ? $usuario[0]->telefono: ''; ?></p>
	<br/>
 </div> 
 -->
<?php
require('footer.php');
?>

  </body>
</html>