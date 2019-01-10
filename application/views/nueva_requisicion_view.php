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

			<!--∆∆∆  content-->
			<div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

				<h3 class="font2 colorFont light">Listado de Requisiciones</h3>

						<?php 
							if($this->session->flashdata('requisicion_valida'))
							{
						?>
						      <div class="warning2">
							<p ><?=$this->session->flashdata('requisicion_valida')?></p>
						</div>
						<?php
							}
							if($this->session->flashdata('requisicion_invalida'))
							{
						?>
							<p><?=$this->session->flashdata('requisicion_invalida')?></p>
						<?php
							}
						?>
						
						<div class="fol">						
							Folio : <?php echo $folio;?>
							Fecha : <?php echo date('Y-m-d');?>
						</div>
						<form name="fr-req" id="fr-req" action="<?php echo base_url().'Requisicion/guardar_requisicion'; ?>" method="post" accept-charset="utf-8" class="show-for-large">

							<div class="table-responsive">
							  <table class="table" id='tabla_req'>
							    <thead>
							      <tr>
							        <th>No</th>
							        <th>Artículo</th>
							        <th>Medida</th>
							        <th>Cantidad</th>
							        <th>Proyecto</th>
							        <?php 
							        	if($rol_usuario =='administrador'){
							        ?>
							        		<th>Estatus</th>	
							        <?php	
							        	} 
							        ?>	
							        <th>Comentarios</th>
							        <th></th>						        						        
							      </tr>
							    </thead>
							    <tbody>			    	
					    			<tr id="tr-1" class='tr-number'>
					    				<td>
					    					1						    						
					    				</td>
                                        <td class="autocompletar-productos-cliente">
                                          <textarea id="entrada" name="articulo-1" class="art ar" placeholder="Artículo" required></textarea>
                                          <ul class="list-group list-products"></ul>
                                        </td>
					    				<td>
					    					<!-- <input type="text" name="medida-1" class='art' placeholder='Medida*'> -->
					    					<textarea name="medida-1" placeholder='Medida' required class="art me"></textarea>
					    				</td>
					    				<td>
					    					<!-- <input type="text" name="cantidad-1" class='art' placeholder='Cantidad*'> -->
					    					<textarea name="cantidad-1"  placeholder='Cantidad' required class="art ca"></textarea>
					    				</td>
					    				<td>
					    					<!-- <input type="text" name="proyecto-1" class='art' placeholder='Proyecto*'> -->
					    					<textarea name="proyecto-1"  placeholder='Proyecto' required class="art pr"></textarea>
					    				</td>
					    				<?php 
							        			if($rol_usuario =='administrador'){
							        			?>
								    				<td>
								    				<!-- <input type="text" name="proyecto-1" class='art' placeholder='Proyecto*'> -->			<select name="estatus-1" required class="art es">
								    						<option value="0" <?php echo ((int)$r->estatus == 0)?'selected':''; ?> >En proceso</option>
								    						<option value="1" <?php echo ((int)$r->estatus == 1)?'selected':''; ?> >Realizado</option>
								    						<option value="2" <?php echo ((int)$r->estatus == 2)?'selected':''; ?> >No realizado</option>
								    					</select>
								    				</td>
								    			<?php 
								    			}
								    			?>
					    				<td>
					    					<textarea name="comentarios-1" placeholder='Comentarios'  class="art co"></textarea>
					    				</td>
					    				<td>
					    				<?php 
							        	if($rol_usuario !='administrador'){
							       	 	?>
						    					<div class=" show-for-large">					  	    											    						
						    					</div>
					    					<?php 
					    					}
					    				?>
					    				</td>
					    			</tr>
							    </tbody>
							  </table>		
							  <div class="add2 show-for-large">
								 <input type="hidden" name="limit" value="1" id='limit'>
								<?php 
							        if($rol_usuario !='administrador'){
							    ?> 			
										<button type="button" id="add" >Agregar fila</button>
								<?php 
									}
								?>
							</div>	
							  </div>
							  <hr>
							<div class="save">
								<?php 
							        if($rol_usuario !='administrador'){
							    ?> 			
										<input type="submit" name='btn_borrador' id='btn_borrador' value="Guardar en borrador" title="Borrador"  />
										<input type="submit" name="submit" value="Enviar requicisión" title="Enviar"  />
								<?php 
									}else{
								?>
										<input type="submit" name='btn_borrador' id='btn_borrador' value="Guardar cambios" title="Guardar cambios"  />
								<?php		
									}
								?>								
							</div>
						</form>


					<form action="<?php echo base_url().'Requisicion/guardar_requisicion'; ?>" method="post" accept-charset="utf-8"  id='fr-req-mov' name='fr-req-mov'>
						<div id='wrapper_ul'>
						<ul class="pricing-table hide-for-large" id='ul-1'>
							  <li class="title bgFont ">1</li>
							  <li class="price"><input id="entrada" type="text" name="articulo-1" class='art ar' placeholder='Artículo*' required><ul class="list-group list-products"></ul></li>
							  <li class="description"><input type="text" name="medida-1" class='art me' placeholder='Medida*' required></li>
							  <li><input type="text" name="cantidad-1" class='art ca' placeholder='Cantidad*' required></li>
							  <li><input type="text" name="proyecto-1" class='art pr' placeholder='Proyecto*' required></li>
							  <?php 
				        				if($rol_usuario =='administrador'){
			        				?>
										  <li>
											  	<select name="estatus-1" required class="art es">
						    						<option value="0" <?php echo ((int)$r->estatus == 0)?'selected':''; ?> >En proceso</option>
						    						<option value="1" <?php echo ((int)$r->estatus == 1)?'selected':''; ?> >Realizado</option>
						    						<option value="2" <?php echo ((int)$r->estatus == 2)?'selected':''; ?> >No realizado</option>
						    					</select>								  
										  </li>
								  <?php 
								  		} 
								  ?>
							  <li><textarea name="comentarios-1" class='co' placeholder='Comentarios'></textarea></li>
							  <?php 
							        if($rol_usuario !='administrador'){
							  ?>
							  			<li class="title bgFont delMovil" data-id='ul-1'>Eliminar</li>
							  <?php 
							  		}
							  ?>			
						</ul>
						</div>
						 <div class="add2 hide-for-large">
						<input type="hidden" name="limitmobil" value="1" id='limitmobil'>
							<?php 
							        if($rol_usuario !='administrador'){
							?>			
										<button type="button" id="addMobil" >Agregar columna</button>
							<?php 
									}
							?>			
						</div>	
						<hr>
						<div class="save hide-for-large">
							<?php 
							        if($rol_usuario !='administrador'){
							?>			
										<input type="submit" name='btn_borrador-mov' id='btn_borrador-mov' value="Guardar en borrador" title="Borrador"  />
										<input type="submit" name="submit" value="Enviar requicisión " title="Enviar"  />
							<?php 
									}else{
							?>
										<input type="submit" name='btn_borrador-mov' id='btn_borrador-mov' value="Guardar cambios" title="Guardar cambios"  />
							<?php			
									}
							?>
								
						</div>
					</form>

			</div>
		        <!--∆∆∆  content-->
		</div>
	    </div>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/servicios/productos.servicio.js"></script>
	<script type="text/javascript">
		var rol_usuario = "<?php echo $rol_usuario; ?>";	
	</script>
<?php		
	require('footer.php');
?>
