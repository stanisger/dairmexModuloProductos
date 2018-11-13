
<?php
require('header.php');
?>
	<body>
	<?php
	$username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
	$password = array('name' => 'password',	'placeholder' => 'introduce tu password');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
	?>

              <!-- ∆∆ Form registration ∆∆ -->
	<div class="form-registration">

         	<!-- ∆ img ∆-->
	  <figure class="form-registration-img">
		    <img src="<?php echo base_url();?>img/index.jpg" alt="Dairmex" />
	  </figure>
	  <br>
		    <h3 class="form-registration-img-caption colorFont font2 light uppercase bgWhite text-center block">Acceso a <strong
		    	class="bold">CRM </strong></h3>
	  <!-- ∆ img ∆-->


	<?php 
	     if($this->session->flashdata('registro_correcto'))
		{
		?>
		   <p class="warning"><?=$this->session->flashdata('registro_correcto')?></p>
		<?php
		}
	?>

   	<!-- ∆ Form -->
	  <form class="form-registration-group" action="<?php echo base_url().'Login/new_user'; ?>" method="post" accept-charset="utf-8">

	    <!-- ∆ correo electrónico -->
	      <div class="input-group">
	            <span class="input-group-label bgBlack">
	              <i class="fi-mail colorBlueDark"></i>
	            </span>
	            <input class="input-group-field"  type="text" name="email"  value="<?php echo set_value('email'); ?>"   placeholder="Correo electrónico">
	      </div>

	      <!-- ∆ Pass-->
	      <div class="input-group">
	            <span class="input-group-label bgBlack">
	               <i class="fi-unlock colorBlueDark"></i>
	            </span>
	            <input class="input-group-field" type="password"  name="password" value="<?php echo set_value('password'); ?>"   placeholder="Contraseña">
	      </div>
                    <?php echo form_hidden('token',$token) ?>
	     <input class="form-registration-submit-button" type="submit" name="submit" value="Iniciar sesión" title="Iniciar sesión"  />
	     <hr>
	     <span class="text-center block">¿Eres nuevo usuario?</span>
	      <p class="form-registration-member-signin"><a class="light" href="<?php echo base_url().'Login/registro'; ?>">Crea tu cuenta</a></p>
	  </form>
	  <!-- ∆ Form -->
	<hr>

	  <div class="manual grid-x">
	  	<div class="cell small-6">	<a class="text-center block" href="http://dairmex.com/crm/manual-crm.pdf" target="_blank"> ¿Comó usar el CRM?</a></div>
	  	<div class="cell small-6">	<a class="text-center block" href="aviso.pdf"> Aviso de privacidad</a></div>
	  
	  </div>
													
         <div class="warning">
		  <?php 
		     if($this->session->flashdata('usuario_incorrecto'))
			{
			?>
			<p><?=$this->session->flashdata('usuario_incorrecto')?></p>
			<?php
			}

			echo validation_errors();
		?>
	</div>


	</div>
	  <!-- ∆∆ Form registration ∆∆ -->




<?php
require('footer.php');
?>
