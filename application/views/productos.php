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
            <input type="text" placeholder="Buscar producto" style="margin-bottom: 0;">
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
	    </div>
	    
      </div>
	</div>
	
	<!--MODULE SCRIPTS-->
	<script type="text/javascript" src="<?=base_url()?>js/productos/productos.servicio.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/productos.utilidades.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>js/productos/buscar-productos.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/paginador.componente.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/productos/index.js"></script>

<?php require('footer.php')?>