
<?php
require('header.php');
?>
	<body>	
		<div class="form-registration">

			  <figure class="form-registration-img">
			    <img src="<?php echo base_url();?>img/interna.jpg" alt="" />
			    <figcaption class="form-registration-img-caption bgWhite font2 light colorBlueDark">REGISTRO</figcaption>
			  </figure>
			  <?php 
				if($this->session->flashdata('registro_correcto'))
				{
				?>
				<p><?=$this->session->flashdata('registro_correcto')?></p>
				<?php
				}
			  ?>

			  <form class="form-registration-group registro" action="<?php echo base_url().'Login/save_user'; ?>" method="post" accept-charset="utf-8">
			     
			      <!-- ∆ Nombre-->
			       <div class="input-group">
			            <span class="input-group-label  bgBlack"  >
			              	   <i class=" icon fi-torso colorBlueDark"></i>
			            </span>
			            	 <input class="input-group-field" type="text"   name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" placeholder="Nombre*"  />
			            <!-- error	  -->
			        </div>
			            <?php echo form_error('nombre'); ?>
			         <!-- ∆ Nombre-->

			       <!-- ∆ Apellidos-->
			        <div class="input-group">
			            <span class="input-group-label  bgBlack"  >
			               <i class="fi-torso colorBlueDark"></i>
			            </span>
			            <input class="input-group-field" type="text" name="apaterno" id="apaterno" value="<?php echo set_value('apaterno'); ?>" placeholder="Apellidos*"  />
			            <!-- error -->
			        </div>
			            <?php echo form_error('apaterno'); ?>

			       <!-- ∆ Empresa-->
			        <div class="input-group">
			            <span class="input-group-label  bgBlack"  >
			               <i class="fi-shopping-bag colorBlueDark"></i>
			            </span>
			            <input class="input-group-field" type="text"  name="empresa" id="empresa" value="<?php echo set_value('empresa'); ?>" placeholder="Empresa*"  />
			        </div>
			              <?php echo form_error('empresa'); ?>

			        <!-- ∆ correo electrónico -->
			      <div class="input-group">
			            <span class="input-group-label  bgBlack"  >
			              <i class="icon fi-mail colorBlueDark"></i>
			            </span>
			            <input class="input-group-field" type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="Email*"  />
			          <!--   error -->
			      </div>
			          <?php echo form_error('email'); ?>


			         <!-- ∆ Teléfono -->
			      <div class="input-group">
			            <span class="input-group-label  bgBlack"  >
			              <i class="icon fi-telephone colorBlueDark"></i>
			            </span>
			            <input class="input-group-field" type="tel" name="telefono" id="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Teléfono*"  />
			            <!-- error -->
			      </div>
				<?php echo form_error('telefono'); ?>

						

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
			        <input class="form-registration-submit-button" type="submit" name="submit" value="Crear cuenta" title="Registrarme"  />
			  </form>

			

	  </div>


<?php
require('footer.php');
?>
