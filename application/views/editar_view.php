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

			<!-- content-->
			<div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

				<h3 class="font2 colorFont light">Edición de perfil</h3>
				<div class="warning">
				<?php 
						if($this->session->flashdata('update_correcto'))
						{
					?>
						<p><?=$this->session->flashdata('update_correcto')?></p>
					<?php
						}						
					?>
					<?php 
						if($this->session->flashdata('update_incorrecto'))
						{
					?>
						<p><?=$this->session->flashdata('update_incorrecto')?></p>
					<?php
						}						
					?>
				</div>	
				<form class="form-registration-group regitro" action="<?php echo base_url().'Login/update_user'; ?>" method="post" accept-charset="utf-8">
					<input type="hidden" name="id" value="<?php echo $usuario[0]->id; ?>">
					<!-- ∆ Nombre-->
					<div class="input-group">
						<span class="input-group-label  bgBlack"  >
							<i class=" icon fi-torso colorBlueDark"></i>
						</span>
						<input class="input-group-field" type="text"   name="nombre" id="nombre" value="<?php echo ($usuario[0]->nombre !=='') ? $usuario[0]->nombre:set_value('nombre'); ?>" placeholder="Nombre*"  />
					</div>
					<?php echo form_error('nombre'); ?>
					<!-- ∆ Nombre-->

					<!-- ∆ Apellidos-->
					<div class="input-group">
						<span class="input-group-label  bgBlack"  >
							<i class="fi-torso colorBlueDark"></i>
						</span>
						<input class="input-group-field" type="text" name="apaterno" id="apaterno" value="<?php echo ($usuario[0]->apaterno !=='') ? $usuario[0]->apaterno:set_value('apaterno'); ?>" placeholder="Apellidos *"  />
					</div>

					<?php echo form_error('apaterno'); ?>
					<!-- ∆ Empresa-->
					<div class="input-group">
						<span class="input-group-label  bgBlack"  >
							<i class="fi-shopping-bag colorBlueDark"></i>
						</span>
						<input class="input-group-field" type="text"  name="empresa" id="empresa" value="<?php echo ($usuario[0]->empresa !=='') ? $usuario[0]->empresa:set_value('empresa'); ?>" placeholder="Empresa*"  />
					</div>
					<?php echo form_error('empresa'); ?>

					<!-- ∆ correo electrónico -->
					<div class="input-group">
						<span class="input-group-label  bgBlack"  >
							<i class="icon fi-mail colorBlueDark"></i>
						</span>
						<input class="input-group-field" type="email" name="email" id="email" value="<?php echo ($usuario[0]->email !=='') ? $usuario[0]->email:set_value('email'); ?>" placeholder="Email*"  />
						<!--   error -->
					</div>
					<?php echo form_error('email'); ?>
					<!-- ∆ Teléfono -->
					<div class="input-group">
						<span class="input-group-label  bgBlack"  >
							<i class="icon fi-telephone colorBlueDark"></i>
						</span>
						<input class="input-group-field" type="tel" name="telefono" id="telefono" value="<?php echo ($usuario[0]->telefono !=='') ? $usuario[0]->telefono:set_value('telefono'); ?>" placeholder="Teléfono*"  />
						<!-- error -->
					</div>
					<?php echo form_error('telefono'); ?>

					<input type="hidden" name="perfil" id='perfil' value="2">	
					<input class="form-registration-submit-button" type="submit" name="submit" value="Confirmar" title="Registrarme"  />
				</form>

			</div>
		</div>
	</div>

<?php
require('footer.php');
?>