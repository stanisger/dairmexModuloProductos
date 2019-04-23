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

				<h3 class="font2 colorFont light">Editar borrador</h3>

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
						</div>						
						<form name="fr-req" id="fr-req" action="<?php echo base_url().'Requisicion/editar_requisicion'; ?>" method="post" accept-charset="utf-8" class="show-for-large">

							<div class="table-responsive">
							  <table class="table" id='tabla_req'>
							    <thead>
							      <tr>
							        <th>No</th>
							        <th>Artículo</th>
							        <th>Medida</th>
							        <th>Cantidad</th>
							        <th>Proyecto</th>
							        <th>Comentarios</th>
							        <th></th>						        						        
							      </tr>
							    </thead>
							    <tbody>
							    	<?php
							    		$i=1; 
							    		foreach ($registro_detalles as $r) {
							    	?>
							    			<tr id="tr-<?php echo $i; ?>" class='tr-number'>
							    				<td>
							    					<?php echo $i; ?>						    						
							    				</td>
							    				<td>							    			
							    					<textarea name="articulo-<?php echo $i; ?>" placeholder='Artículo' required class="art ar"><?php echo $r->articulo; ?></textarea>
							    				</td>
							    				<td>
							    					<!-- <input type="text" name="medida-1" class='art' placeholder='Medida*'> -->
							    					<textarea name="medida-<?php echo $i; ?>" placeholder='Medida' required class="art me"><?php echo $r->medida; ?></textarea>
							    				</td>
							    				<td>
							    					<!-- <input type="text" name="cantidad-1" class='art' placeholder='Cantidad*'> -->
							    					<textarea name="cantidad-<?php echo $i; ?>"  placeholder='Cantidad' required class="art ca"><?php echo $r->cantidad; ?></textarea>
							    				</td>
							    				<td>
							    					<!-- <input type="text" name="proyecto-1" class='art' placeholder='Proyecto*'> -->
							    					<textarea name="proyecto-<?php echo $i; ?>"  placeholder='Proyecto' required class="art pr"><?php echo $r->proyecto; ?></textarea>
							    				</td>
							    				<td>
							    					<textarea name="comentarios-<?php echo $i; ?>" placeholder='Comentarios' class="art co"><?php echo $r->comentarios; ?></textarea>
							    				</td>
							    				<td>
							    					<div class="add3 show-for-large">					  	    					
							    						<button type="button" class="del" data-id='tr-<?php echo $i; ?>'>Eliminar</button>
							    					</div>
							    				</td>
							    			</tr>
							    	<?php
							    		$i++;
							    		} 

							    	?>			    						    			
							    </tbody>
							  </table>		
							  <div class="add2 show-for-large">
								 <input type="hidden" name="limit" value="<?php echo $i; ?>" id='limit'>			
								 <input type="hidden" name="idre" value="<?php echo $idre; ?>">			
								 <button type="button" id="add" >Agregar fila</button>

							</div>	
							  </div>
							 <hr>
							<div class="save">

								<input type="submit" name='btn_borrador' id='btn_borrador' value="Guardar en borrador" title="Borrador"  />
								<input type="submit" name="submit" value="Enviar requicisión" title="Enviar"  />
							</div>

						</form>


					<form action="<?php echo base_url().'Requisicion/editar_requisicion'; ?>" method="post" accept-charset="utf-8"  id='fr-req-mov' name='fr-req-mov'>
						<div id='wrapper_ul'>
						<?php
				    		$u=1; 
				    		foreach ($registro_detalles as $r) {
				    	?>
							<ul class="pricing-table hide-for-large" id='ul-<?php echo $u; ?>'>
								  <li class="title bgFont "><?php echo $u; ?></li>
								  <li class="price"><input type="text" name="articulo-<?php echo $u; ?>" class='art ar' placeholder='Artículo*' value="<?php echo $r->articulo; ?>" required></li>
								  <li class="description"><input type="text" name="medida-<?php echo $u; ?>" class='art me' placeholder='Medida*' value="<?php echo $r->medida; ?>" required></li>
								  <li><input type="text" name="cantidad-<?php echo $u; ?>" class='art ca' placeholder='Cantidad*' value="<?php echo $r->cantidad; ?>" required></li>
								  <li><input type="text" name="proyecto-<?php echo $u; ?>" class='art pr' placeholder='Proyecto*' value="<?php echo $r->proyecto; ?>" required></li>
								  <li><textarea name="comentarios-<?php echo $u; ?>" class='co' placeholder='Comentarios'><?php echo $r->comentarios; ?></textarea></li>
								  <li class="title bgFont delMovil" data-id='ul-<?php echo $u; ?>'>Eliminar</li>
							</ul>
						<?php 
								$u++;
							}
						?>	
						</div>
						 <div class="add2 hide-for-large">
								<input type="hidden" name="limitmobil" value="<?php echo $u; ?>" id='limitmobil'>			
								<input type="hidden" name="idre" value="<?php echo $idre; ?>">
								<button type="button" id="addMobil" >Agregar columna</button>

						</div>	
						<hr>
						<div class="save hide-for-large">
								<input type="submit" name='btn_borrador-mov' id='btn_borrador-mov' value="Guardar en borrador" title="Borrador"  />
								<input type="submit" name="submit" value="Enviar requicisión " title="Enviar"  />
						</div>
					</form>

			</div>
		        <!--∆∆∆  content-->
		</div>
	    </div>
	<?php
require('footer.php');
?>