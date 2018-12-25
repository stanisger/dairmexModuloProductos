<?php require('header.php')?>
  <body>


<div class="app-dashboard shrink-medium">

  <!--HEAD -->
  <?php require('head.php'); ?>  

    <!--BODY -->
    <div class="app-dashboard-body off-canvas-wrapper">
      
    <!--SIDEBAR MENU -->	
    <?=require('sidebar_menu.php')?>

    <!--CONTENT MODULE-->
    <div id="modulo-productos" class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

      
      <form id="producto">

            <h3 class="font2 colorFont light title-products">Alta de productos</h3>
           
            <div class=" grid-x grid-margin-x"> 

              <div class="medium-5 cell">
                <label>Nombre del producto
                <input type="text" name="nombre" pattern=".{3}.*" placeholder="Ingresa el nombre de producto" required>
                </label>
              </div>

              <div class="medium-3 cell">
                <label>Medidas
                <input type="number" name="medida" placeholder="Ingresa la medida" min="0" required>
                </label>
              </div>

              <div class="medium-1 cell">
                <label>Unidades
                  <select name="unidad_medida">
                    <option value="cm" selected="selected">cm</option>
                    <option value="lt">lt</option>
                    <option value="m">m</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                  </select>
                </label>
              </div>

              <div class="medium-5 cell">
                <label>Categoría
                <input type="text" required name="categoría" placeholder="Ingresa la categoría del producto">
                </label>
              </div>

              <div class="medium-4 cell">
                <label>Cantidad
                <input type="number" required min="0" name="cantidad" placeholder="Ingresa la cantidad">
                </label>
              </div>

            </div>


            <div class="grid-x grid-margin-x"> 

              <div class="medium-2 cell">
                  <label for="exampleFileUpload" class="button">Imagen</label>
                  <input type="file" name="imagen" >
                  <figure>
                    <img src="https://tse1.mm.bing.net/th?id=OIP.HaGJ4mqazIg2w8UOrpv2uQHaHL&pid=15.1&P=0&w=173&h=168" alt="">
                  </figure>
              </div>

            </div>

            <hr>

            <h3 class="font2 colorFont light title-products">Proveedor</h3>
             
             <!--proveedor-->
             <div id="pr-1"  class=" grid-x grid-margin-x">
              
              <input name="id_proveedor" type="hidden">
              
              <div class="medium-5 cell">
                <label>Nombre del proveedor
                <input name="nombre_proveedor" type="text" placeholder="Ingresa el nombre del proveedor">
                </label>
              </div>

              <div class="medium-2 cell">
                <label>Precio por unidad
                <input name="precio_por_unidad" type="text" placeholder="Ingresa el precio">
                </label>
              </div>

              <div class="medium-2 cell">
                <div class="switch">
                  <small class="colorFont" >MX</small>
                  <small class="colorFont" >USD</small>
                    <input name="unidad_precio"  type="checkbox" class="switch-input">
                    <label class="switch-paddle block" for="exampleSwitch">
                    </label>
                  </div>
              </div>

              <div class="medium-2 cell">
                <a href="">eliminar</a>
              </div>

              <!--proveedor-->
                         
             </div>
             
             <div id="pr-1"  class=" grid-x grid-margin-x">
              <input name="id_proveedor" type="hidden">
              
              <div class="medium-5 cell">
                <label>Nombre del proveedor
                <input name="nombre_proveedor" type="text" placeholder="Ingresa el nombre del proveedor">
                </label>
              </div>

              <div class="medium-2 cell">
                <label>Precio por unidad
                <input name="precio_por_unidad" type="text" placeholder="Ingresa el precio">
                </label>
              </div>

              <div class="medium-2 cell">
                <div class="switch">
                  <small class="colorFont" >MX</small>
                  <small class="colorFont" >USD</small>
                    <input name="unidad_precio"  type="checkbox" class="switch-input">
                    <label class="switch-paddle block" for="exampleSwitch">
                    </label>
                  </div>
              </div>

              <div class="medium-2 cell">
                <a href="">eliminar</a>
              </div>

              <!--proveedor-->                      
             </div>
             

             <hr>

             <div class="cell small-4"> 
               <a href="alta" class="button right w100 plus-product">Añadir provedor <i class="fi-plus"></i></a>
             </div>

             <div class="save">
              <input type="reset"  value="Cancelar" title="Cancelar"/>
			  <input type="submit" value="Guardar cambios" title="Guardar cambios"/>
	         </div>
        </form>
    </div>

  </div>
</div>

<div data-alert class="alert-box success radius">
  <p>El producto se registró correctamente</p>
  <a href="#" class="close">&times;</a>
</div>

   <!--MODULE SCRIPTS-->
    <script type="text/javascript" src="<?=base_url()?>js/productos/src/servicios/productos.servicio.js"></script>
    
    <?php if($modo=='edicion'):?>
      <script type="text/javascript" src="<?=base_url()?>js/productos/src/herramientas/hash.herramienta.js"></script>
      <script type="text/javascript" src="<?=base_url()?>js/productos/src/editar-producto.componente.js"></script>
    <?php else:?>
      <script type="text/javascript" src="<?=base_url()?>js/productos/src/nuevo-producto.componente.js"></script>
    <?php endif;?>
    
<?php require('footer.php')?>