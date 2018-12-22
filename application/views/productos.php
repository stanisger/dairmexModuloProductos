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

          <div id="componente-buscar-productos" style="position: absolute; width: calc(100% - 64px);">
            <div class="input-group input-group-rounded" style="margin-bottom: 0;">
              <input class="input-group-field" type="search" placeholder="Buscar producto">
              <div class="input-group-button">
                <button type="button" class="button bgBlueStrong" style="height: 100%;"><i class="fi-magnifying-glass"></i></button>
              </div>
            </div>
            <ul class="list-group" style="margin-left: 0;"></ul>
          </div>

          <div id="componente-paginador">
            <h5 style="margin-top: 9vh;"></h5>

            <table style="margin-top: 3vh;">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Piezas</th>
                  <th>Categoría</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

            <nav aria-label="Pagination">
              <ul class="pagination text-center"></ul>
            </nav>
          </div>
          
          <div class="panel clearfix">
            <a href="alta" class="button right">Añadir producto</a>
          </div>
	    </div>
	    
      </div>
	</div>
	
	<!--MODULE SCRIPTS-->
	<script type="text/javascript" src="<?=base_url()?>js/productos/productos.utilidades.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/productos.servicio.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/buscar-productos.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/paginador.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/index.js"></script>

<?php require('footer.php')?>