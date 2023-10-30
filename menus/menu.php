

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
             <a href="/index.php" class="app-brand-link">
              <img src="/assets/img/logo/logo2.png"  width="50%" height="50%">
              <span class="app-brand-text demo menu-text fw-bolder ms-2"></span> 
            </a></img>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Inicio</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Gestion</span>
            </li>

            <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==3)){ ?>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                
                  <div data-i18n="Account Settings">Pedidos Clientes</div>
                </a>

                <ul class="menu-sub">
                   <li class="menu-item">
                    <a href="/clientes/clientes.php" class="menu-link">
                      <div data-i18n="Notifications">Clientes</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/pedidos/pedidos.php" class="menu-link">
                      <div data-i18n="Notifications">Pedidos</div>
                    </a>
                  </li>
                
                  <li class="menu-item">
                    <a href="/clientes/presupuesto.php" class="menu-link">
                      <div data-i18n="Presupuesto">Presupuesto</div>
                    </a>
                  </li>
                  
                 
                 
                </ul>
              </li>
            <?php } ?>
            
            
            <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==2)){ ?>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Account Settings">Proveedores</div>
                </a>
              
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="/proveedores/proveedores.php" class="menu-link">
                      <div data-i18n="Account">Proveedores</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/proveedores/estadisticas.php" class="menu-link">
                      <div data-i18n="Notifications">Estadisticas Proveedor</div>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
          
            <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==2)){ ?>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                   <div data-i18n="Account Settings">Pedidos Proveedores</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="/pedidos_proveedores/productos.php" class="menu-link">
                      <div data-i18n="Account">Productos</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/pedidos_proveedores/pedidos.php" class="menu-link">
                      <div data-i18n="Account">Pedidos</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="/pedidos_proveedores/estadisticas.php" class="menu-link">
                      <div data-i18n="Notifications">Estadisticas Pedidos</div>
                    </a>
                  </li>
                  </ul>
              </li>
            <?php } ?>

            <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==4)){ ?>
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-package"></i>
                  <div data-i18n="Account Settings">Stock</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/stock/articulos.php" class="menu-link">
                    <div data-i18n="Account">Articulos</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/stock/alertas.php" class="menu-link">
                    <div data-i18n="Account">Alertas</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/stock/almacenes.php" class="menu-link">
                    <div data-i18n="Account">Almacenes</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/stock/estadisticas.php" class="menu-link">
                    <div data-i18n="Notifications">Estadisticas de Stock</div>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>
          
          <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==5)){ ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt"></i>
                
                <div data-i18n="Account Settings">Reportes</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/reportes/reportes.php" class="menu-link">
                    <div data-i18n="Account">Reportes</div>
                  </a>
                </li>

               </ul>
            </li>
          <?php } ?>


          <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==5)){ ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file   "></i>
                
                <div data-i18n="Account Settings">ABM</div>
              </a>
              <ul class="menu-sub">
              <li class="menu-item">
                    <a href="/clientes/clientes.php" class="menu-link">
                      <div data-i18n="Clientes">Clientes</div>
                    </a>
                  </li>
               </ul>
            </li>
          <?php } ?>

          <?php if(($_SESSION['Usuario_Nivel_Id']==1) or ($_SESSION['Usuario_Nivel_Id']==5)){ ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                
                <div data-i18n="Account Settings">Usuarios</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/usuarios/usuarios.php" class="menu-link">
                    <div data-i18n="Account">Usuarios</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/usuarios/roles.php" class="menu-link">
                    <div data-i18n="Notifications">Roles</div>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>
            <br>
            
          </ul>
        </aside>
        <!-- / Menu -->

     