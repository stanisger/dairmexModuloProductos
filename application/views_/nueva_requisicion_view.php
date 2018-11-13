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
							        <th>Comentarios</th>
							        <th></th>						        						        
							      </tr>
							    </thead>
							    <tbody>			    	
					    			<tr id="tr-1" class='tr-number'>
					    				<td>
					    					1						    						
					    				</td>
					    				<td>
					    			
					    					<textarea name="articulo-1" placeholder='Artículo' required class="art ar"></textarea>
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
					    				<td>
					    					<textarea name="comentarios-1" placeholder='Comentarios'  class="art co"></textarea>
					    				</td>
					    				<td>
					    					<div class=" show-for-large">					  	    					
					    						<button type="button" class="del" data-id='tr-1'>Eliminar</button>
					    					</div>
					    				</td>
					    			</tr>
							    </tbody>
							  </table>		
							  <div class="add2 show-for-large">
								 <input type="hidden" name="limit" value="1" id='limit'>			
								<button type="button" id="add" >Agregar fila</button>
							
							</div>	
							  </div>
							  <hr>
							<div class="save">

								<input type="submit" name='btn_borrador' id='btn_borrador' value="Guardar en borrador" title="Borrador"  />
								<input type="submit" name="submit" value="Enviar requicisión" title="Enviar"  />
							</div>
						</form>


					<form action="<?php echo base_url().'Requisicion/guardar_requisicion'; ?>" method="post" accept-charset="utf-8"  id='fr-req-mov' name='fr-req-mov'>
						<div id='wrapper_ul'>
						<ul class="pricing-table hide-for-large" id='ul-1'>
							  <li class="title bgFont ">1</li>
							  <li class="price"><input type="text" name="articulo-1" class='art ar' placeholder='Artículo*' required></li>
							  <li class="description"><input type="text" name="medida-1" class='art me' placeholder='Medida*' required></li>
							  <li><input type="text" name="cantidad-1" class='art ca' placeholder='Cantidad*' required></li>
							  <li><input type="text" name="proyecto-1" class='art pr' placeholder='Proyecto*' required></li>
							  <li><textarea name="comentarios-1" class='co' placeholder='Comentarios'></textarea></li>
							  <li class="title bgFont delMovil" data-id='ul-1'>Eliminar</li>
						</ul>
						</div>
						 <div class="add2 hide-for-large">
						<input type="hidden" name="limitmobil" value="1" id='limitmobil'>			
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