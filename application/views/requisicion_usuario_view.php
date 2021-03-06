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

				<h3 class="font2 colorFont light">Listado de Requisiciones</h3>

						<div id="login">
							<?php 
								if($this->session->flashdata('error_requisicion'))
								{
							?>
									<p><?=$this->session->flashdata('error_requisicion')?></p>
							<?php
								}
							?>
							<?php 
							if($this->session->flashdata('requisicion_valida'))
							{
							?>
							      <div class="warning2">
								<p><?=$this->session->flashdata('requisicion_valida')?></p>
							</div>
							<?php
							}
						    ?>
						<div  id="table">
							<?php if(count($registros_usuario)>0){ ?>
								<table border="1">
								  <thead>
								      <tr>
								        <th>No</th>
								        <th>Folio</th>
								        <th>Fecha realización</th>
								        <th>Guardado</th>
										<th>Estatus</th>
								        <th>Detalle</th>	        
								      </tr>
								    </thead>
								    <tbody>
								    <?php 
								    	$x = 1;
								    	foreach ($registros_usuario as $r) {
									?>
											<tr>
												<td><?php echo $x; ?></td>
													<td><?php echo $r->folio; ?></td>
													<td><?php echo $r->fecha; ?></td>
													<td><?php echo ($r->estatus==1) ? 'Enviado':'Borrador'; ?></td>
													<td id="status"><?php echo ($r->estatus_req == 1) ? 'Realizada':'En proceso'; ?></td>
													<td>
														<p class="detail"><i class=" icon fi-magnifying-glass colorBlueDark"></i><a href="<?php echo base_url().'Requisicion/detalles/'.$r->id; ?>">Ver detalle</a> </p>
														<p class="detail"><i class="  icon  fi-pencil colorBlueDark"></i><a href="<?php echo base_url().'Requisicion/editar/'.$r->id; ?>">Editar</a></p>
														<!-- <p class="detail"><i class=" icon fi-check colorBlueDark"></i><a href="<?php echo base_url().'Requisicion/enviar_requisicion/'.$r->id; ?>">Enviar</a></p> -->
														
														
												</td>
											</tr>
									<?php
											$x++;				    		
								    	}
								    ?>
								    </tbody>
							    </table>
							    <p><?php echo $links; ?></p>
							    <?php
									}else{
							    ?>
							    		<p>No existen registros en sistema.</p>
							    <?php	
							    	}
							    ?>	
							 </div>
						</div>

			</div>
		</div>
	</div>
	<script>

	</script>
<?php
require('footer.php');
?>