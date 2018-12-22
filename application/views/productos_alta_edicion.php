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

      
      <form>

          <h3 class="font2 colorFont light title-products">Alta de productos</h3>
            <div id=""  class=" grid-x grid-margin-x"> 

              <div class="medium-5 cell">
                <label>Nombre del producto
                <input type="text" id="name_product"placeholder="Ingresa el nombre de producto">
                </label>
              </div>

              <div class="medium-3 cell">
                <label>Medidas
                <input type="text" id="measure" placeholder="Ingresa la medida">
                </label>
              </div>

              <div class="medium-1 cell">
                <label>Unidades
                  <select id="unity">
                    <option value="husker">lt</option>
                    <option value="starbuck">cm</option>
                    <option value="hotdog">m</option>
                    <option value="apollo">kg</option>
                    <option value="apollo">g</option>
                  </select>
                </label>
              </div>

              <div class="medium-5 cell">
                <label>Categoría
                <input type="text" id="category_product" placeholder="Ingresa el nombre de producto">
                </label>
              </div>

              <div class="medium-2 cell">
                <label>Cantidad
                <input type="text" id="quantity" placeholder="Ingresa la cantidad">
                </label>
              </div>

            </div>


            <div id=""  class=" grid-x grid-margin-x"> 

              <div class="medium-2 cell">
                  <label for="exampleFileUpload" class="button">Imagen</label>
                  <input type="file" id="exampleFileUpload" class="show-for-sr">
                  <figure>
                    <img src="https://tse1.mm.bing.net/th?id=OIP.HaGJ4mqazIg2w8UOrpv2uQHaHL&pid=15.1&P=0&w=173&h=168" alt="">
                  </figure>
              </div>

            </div>

            <hr>

            <h3 class="font2 colorFont light title-products">Proveedor</h3>
             
             <!--proveedor-->
             <div id=""  class=" grid-x grid-margin-x"> 

             <div class="medium-5 cell">
                <label>Nombre del proveedor
                <input type="text" id="name_pro" placeholder="Ingresa el nombre del proveedor">
                </label>
              </div>

              <div class="medium-2 cell">
                <label>Precio por unidad
                <input type="text" id="price" placeholder="Ingresa el precio">
                </label>
              </div>

              <div class="medium-2 cell">
                <div class="switch">
                  <small class="colorFont" >MX</small>
                  <small class="colorFont" >USD</small>
                    <input class="switch-input" id="exampleSwitch" type="checkbox" name="exampleSwitch">
                    <label class="switch-paddle block" for="exampleSwitch">
                    </label>
                  </div>
              </div>

              <div class="medium-2 cell">
                <a href="">eliminar</a>
              </div>

              <!--proveedor-->
              

              <div class="cell small-4"> 
               <a href="alta" class="button right w100 plus-product">Añadir provedor <i class="fi-plus"></i></a>
              </div>

             </div>


             <hr>


             <div class="save">

              <input type="submit" name='btn_borrador-mov'  value="Cancelar" title="Cancelar  "  />
	
							<input type="submit" name='btn_borrador-mov' value="Guardar cambios" title="Guardar cambios"  />
	
						</div>



        </form>

    </div>

  </div>
</div>

<?php require('footer.php')?>