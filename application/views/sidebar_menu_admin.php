 <div id="app-dashboard-sidebar" class="app-dashboard-sidebar position-left off-canvas off-canvas-absolute reveal-for-medium" data-off-canvas>

          
      <!-- menu mobile -->
      <div class="app-dashboard-sidebar-title-area">
                      <div class="app-dashboard-close-sidebar">
                        <!-- Close button -->
                        <button id="close-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-sidebar-close-button show-for-medium" aria-label="Close menu" type="button">
                          <span aria-hidden="true"><a href="#"><i class="fa fa-angle-double-left"></i></a></span>
                        </button>
                      </div>
                      <div class="app-dashboard-open-sidebar">
                        <button id="open-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-open-sidebar-button show-for-medium" aria-label="open menu" type="button">
                          <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-right"></i></a></span>
                        </button>
                      </div>
          </div>

      <!-- menu desktop -->
      <div class="app-dashboard-sidebar-inner bgGrey">
        <ul class="menu vertical">
        	<li>
             <a href="<?php echo base_url(); ?>" class="<?php echo (isset($inicio) && $inicio==1)?'is-active':''; ?>">
                <i class="fi-home colorBlueDark"></i><span class="app-dashboard-sidebar-text">Inicio</span>
              </a>
          </li>
          <li>

          	  <a href="<?php echo base_url().'Requisicion/requisicion_recent'; ?>" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'Requisicion/requisicion_recent') || strpos($_SERVER['REQUEST_URI'], 'Requisicion/requisicion_recent')) ? 'is-active':''; ?>"> 

            	<i class="fi-page colorBlueDark"></i><span class="app-dashboard-sidebar-text bold">Requisiciones recientes</span>
              </a>
          </li>
           <li>

          	   <a href="<?php echo base_url().'Requisicion/requisicion_borrador'; ?>" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'Requisicion/requisicion_borrador')) ? 'is-active':''; ?>">
            	<i class="fi-page-add colorBlueDark"></i><span class="app-dashboard-sidebar-text bold">Requisiciones realizadas</span>
              </a>
          </li>
          <li>
             <a href="<?php echo base_url().'Login/editar/'.$this->session->userdata('id_usuario'); ?>" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'Login/editar') || strpos($_SERVER['REQUEST_URI'], 'Login/update_user')) ? 'is-active':''; ?>">
                <i class="fi-torso colorBlueDark"></i><span class="app-dashboard-sidebar-text">Editar perfil</span>
              </a>
          </li>

          <li>
               <a href="<?php echo base_url().'Login/password'; ?>" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'Login/password') || strpos($_SERVER['REQUEST_URI'], 'Login/update_password')) ? 'is-active':''; ?>">
                 <i class="fi-unlock colorBlueDark"></i><span class="app-dashboard-sidebar-text">Modificar password</span>
               </a>
           </li>


           <li>
          	   <a href="<?php echo base_url().'Login/logout_ci'; ?>">
            	<i class="fi-arrow-left colorBlueDark"></i><span class="app-dashboard-sidebar-text">Cerrar sesión</span>
              </a>
          </li>
        </ul>
      </div>
</div>

