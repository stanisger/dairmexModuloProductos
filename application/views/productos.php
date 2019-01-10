<?php require('header.php')?>
  <body>

    <div class="app-dashboard shrink-medium">
      <!--HEAD -->
	  <?php require('head.php'); ?>  
	  <!--BODY -->
	  <div class="app-dashboard-body off-canvas-wrapper">
	    <!--SIDEBAR MENU -->	
	    <?php require('sidebar_menu.php')?>

        <!--CONTENT MODULE-->
        <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>
          <h3 class="font2 colorFont light title-products">Mis Productos</h3>
          <div id="componente-buscar-productos"  class="search-products grid-x grid-margin-x">
            <div class="cell small-8 autocomplete-productos">
              <div class="input-group input-group-rounded">
                <input class="input-group-field" type="search" placeholder="Buscar productos">
                <div class="input-group-button">
                  <button type="button" class="button bgBlueStrong"><i class="fi-magnifying-glass"></i></button>
                </div>
              </div>
              <ul class="list-group list-products"></ul>
            </div>

            <div class="cell small-4"> 
              <a href="alta" class="button right w100 plus-product">
                Añadir producto <i class="fi-plus"></i>
              </a>
            </div>
          </div>
          <div id="componente-paginador" class="componente-paginador">
            <h5 class="font2 colorFont light"></h5>
            
            <table>
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Piezas</th>
                  <th>Categoría</th>
                  <th class="btn-table">Editar</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

            <nav aria-label="Pagination">
              <ul class="pagination text-center"></ul>
            </nav>
          </div>
	    </div>
	    
      </div>
	</div>

	<!--MODULE SCRIPTS-->
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/nucleo/componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/interfaz-de-usuario/mensaje.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/interfaz-de-usuario/mensajes.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/interfaz-de-usuario/dialogo-de-confirmacion.componente.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/productos/src/interfaz-de-usuario/animacion-de-espera.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/herramientas/hash.herramienta.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/herramientas/paginador.herramienta.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/servicios/productos.servicio.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/buscar-productos.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/src/paginador-de-productos.componente.js"></script>

<?php require('footer.php')?>