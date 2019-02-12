<?php require('header.php')?>
  <body>
    <div class="app-dashboard shrink-medium">
      <!--HEAD -->
      <?php require('head.php'); ?>  
      <!--BODY -->
      <div class="app-dashboard-body off-canvas-wrapper">
        <!--SIDEBAR MENU -->	
        <?php require('sidebar_menu.php');?>
        <!--CONTENT MODULE-->
        <div id="modulo-productos" class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>
      
          <form id="producto">
            <h3 class="font2 colorFont light title-products">Alta de productos</h3>
            <input type="hidden" id="id_producto" required>
            <div class=" grid-x grid-margin-x"> 
              <div class="medium-5 cell">
                <label>Nombre del producto
                <input type="text" id="nombre"
                  placeholder="Ingresa el nombre de producto" 
                  pattern=".{3}.*" autocomplete="off" required>
                </label>
              </div>
              <div class="medium-3 cell">
                <label>Medidas
                <input type="text" id="medida"
                  placeholder="Ingresa la medida"
                  min="0" autocomplete="off" required>
                </label>
              </div>
              <div class="medium-1 cell">
                <label>Unidades
                  <select id="unidad_medida">
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
                <input type="text" id="categoria"
                  placeholder="Ingresa la categoría del producto"
                  autocomplete="off" required>
                </label>
              </div>
              <div class="medium-4 cell">
                <label>Cantidad
                <input type="number" id="cantidad"
                  placeholder="Ingresa la cantidad"
                  required autocomplete="off" min="0">
                </label>
              </div>
            </div>
            
            <div class="grid-x grid-margin-x"> 
              <div class="medium-2 cell">
                  <label id="boton-imagen" class="button">Imagen</label>
                  <input type="file" id="imagen"
                    accept="image/x-png,image/jpeg"
                    class="show-for-sr" autocomplete="off">
                  <figure>
                    <img id="contenedor-imagen">
                  </figure>
              </div>
            </div>
            
            <hr>
            <h3 class="font2 colorFont light title-products">Proveedores</h3>
            
            <!--PROVEEDOR-->
            <div class="grid-x grid-margin-x">
              <div id="contenedor-proveedores"></div>
            </div>
              <div id="crear-proveedor" class="cell small-4"> 
                <a class="button right w100 plus-product">
                  Añadir provedor <i class="fi-plus"></i>
                </a>
              </div>
            <hr>

            <div class="save">
              <input type="submit" id="btn-reset" value="<?=$modo=='edicion'?'Restaurar':'Limpiar'?>"/>
			  <input type="submit" id="guardar" value="Guardar cambios" title="Guardar cambios"/>
	        </div>
        </form>
    </div>

  </div>
</div>


    <?php if($modo=='edicion'):?>
      <script type="text/javascript" src="<?=base_url()?>js/productos/dist/productos.edicion.js"></script>
    <?php else:?>
      <script type="text/javascript" src="<?=base_url()?>js/productos/dist/productos.alta.js"></script>
    <?php endif;?>
    
<?php require('footer.php')?>