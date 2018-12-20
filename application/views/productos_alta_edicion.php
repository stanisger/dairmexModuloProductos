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
          hola mundo desde edición de productos
	    </div>
	    
      </div>
	</div>

<?php require('footer.php')?>