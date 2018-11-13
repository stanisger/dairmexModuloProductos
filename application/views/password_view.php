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

				<h3 class="font2 colorFont light">Modificar Password</h3>
				<?php 
				     if($this->session->flashdata('password_correcto'))
					{
					?>
					   <p class="success"><?=$this->session->flashdata('password_correcto')?></p>
					<?php
					}
					if($this->session->flashdata('password_incorrecto'))
					{
					?>
					   <p class="warning"><?=$this->session->flashdata('password_incorrecto')?></p>
					<?php
					}
				?>
				<form class="form-registration-group regitro" action="<?php echo base_url().'Login/update_password'; ?>" method="post" accept-charset="utf-8">

					<!-- ∆ Pass-->
						
					      <div class="input-group">
					            <span class="input-group-label  bgBlack"  >
					              <i class="icon fi-unlock colorBlueDark"></i>
					            </span>
					            	
					            <input class="input-group-field" type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="Contraseña*"  />
					       <!-- error -->
					      </div>
					    	<?php echo form_error('password'); ?>	   


					        <!-- ∆ Confirmar Pass-->
					        
					      <div class="input-group">
					            <span class="input-group-label  bgBlack"  >
					              <i class="icon fi-lock colorBlueDark "></i>
					            </span>
					            
					            <input class="input-group-field" type="password"  name="cpassword" id="cpassword" value="<?php echo set_value('cpassword'); ?>" placeholder="Repetir contraseña*"  />
					            <!-- error -->
					      </div>
			      		 <?php echo form_error('cpassword'); ?>	

					<input type="hidden" name="perfil" id='perfil' value="2">	
					<input class="form-registration-submit-button" type="submit" name="submit" value="Confirmar" title="Registrarme"  />
				</form>

			</div>
		</div>
	</div>
<?php
require('footer.php');
?>