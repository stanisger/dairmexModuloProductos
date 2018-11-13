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

				<h3 class="font2 colorFont light">Detalles de requisición</h3>


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
				<div>
					<div  id="table">
					<?php if(count($registro_detalles)>0){ ?>
						<table border="1">
							<thead>
						      <tr>
						        <th>No</th>
						        <th>Artículo</th>
						        <th>Medida</th>
						        <th>Cantidad</th>
						        <th>Proyecto</th>
						        <th>Comentarios</th>	        
						      </tr>
						    </thead>
						    <tbody>
						    <?php 
						    	$x = 1;
						    	foreach ($registro_detalles as $r) {
							?>
									<tr>
										<td><?php echo $x; ?></td>
										<td><?php echo $r->articulo; ?></td>
										<td><?php echo $r->medida; ?></td>
										<td><?php echo $r->cantidad; ?></td>
										<td><?php echo $r->proyecto; ?></td>
										<td><?php echo $r->comentarios; ?></td>								
									</tr>
							<?php
									$x++;				    		
						    	}
						    ?>
						    </tbody>
					    </table>
					    <?php
							}else{
					    ?>
					    		<p>No existen registros en sistema.</p>
					    <?php	
					    	}
					    ?>
					    <a class="back form-registration-submit-button" href="<?php echo base_url().'Requisicion/index'; ?>">
					    	<i class="fi-arrow-left"></i>
					    	Regresar</a>
					 </div>

					</div>





			</div>
		</div>
	</div>

			
<?php
require('footer.php');
?>