<div id="spinner" class="show bg-colo position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="sk-wave sk-primary">
                        <div class="sk-wave-rect"></div>
                        <div class="sk-wave-rect"></div>
                        <div class="sk-wave-rect"></div>
                        <div class="sk-wave-rect"></div>
                        <div class="sk-wave-rect"></div>
                      </div>
        </div>
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a id="bt4" href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="../assets/logo/bt4-logo.png" alt class="w-px-30 h-auto">
              </span>
              <span class="app-brand-text demo menu-text fw-bold"><?php echo ''.$server_data['server_name'].'';?></span>
            </a>

            <a id="bt4" href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a id="bt4" href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div>Home</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a id="bt4" href="index.php" class="menu-link">
                    <div>Dashboard</div>
                  </a>
                </li>
              </ul>
            </li>
            
          
            
            
            <li class="menu-item">
              <a id="bt4" href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-brand-android"></i>
                <div>Apk Management</div>
              </a>
              <ul class="menu-sub">
              
                
                <li class="menu-item">
                  <a id="bt4" href="download-apk.php" class="menu-link">
                    <div>Download Apk</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
            <li class="menu-item">
              <a id="bt4" href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-code"></i>
                <div>Script Management</div>
              </a>
              <ul class="menu-sub">
              
                
                <li class="menu-item">
                  <a id="bt4" href="download-script.php" class="menu-link">
                    <div>Download Script</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
            
            <li class="menu-item">
              <a id="bt4" href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file"></i>
                <div>Lib Management</div>
              </a>
              <ul class="menu-sub">
              
                
                <li class="menu-item">
                  <a id="bt4" href="download-lib.php" class="menu-link">
                    <div>Download Lib</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
            

            <li class="menu-item">
              <a id="bt4" href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-sitemap"></i>
                <div>Products Management</div>
              </a>
              <ul class="menu-sub">
              
                <li class="menu-item">
                  <a id="bt4" href="../" class="menu-link">
                    <div>Buy Products</div>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a id="bt4" href="../my-orders.php" class="menu-link">
                    <div>My Orders</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
           
                
              </ul>
            </li>
          <br>
        <br>
      <br>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a id="bt4" class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                  <a id="bt4" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a id="bt4" class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a id="bt4" class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a id="bt4" class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ti ti-bell ti-md"></i>
                    <?php if ($notif['n'] == "all") { ?>
                    <span class="badge bg-danger rounded-pill badge-notifications"><?php $fetch_t = mysqli_query($con, "SELECT * FROM nt WHERE `n` = 'all'");
	$count = mysqli_num_rows($fetch_t);
	echo $count; ?></span>
                    <?php } ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a
                          href="javascript:void(0)">
                          <i class="ti ti-mail-opened fs-4"></i></a>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                      
                      <!-- BT4 -->
                      <?php
					$query_nt = mysqli_query($con,"SELECT * FROM nt WHERE `n` = 'all' ORDER BY id ASC");
					while ($row = mysqli_fetch_assoc($query_nt)) {
				?>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../assets/img/avatars/bt4.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1"><?php echo $row['nt']; ?></h6>
                              
                              <small class="text-muted"><?php echo $row['dt']; ?></small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a id="bt4" href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span></a>
                              
                            </div>
                          </div>
                        </li>
                        <?php } ?>
                        <!-- BT4 -->
                        
                      </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                      <div
                        
                        class=" d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                        
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a id="bt4" class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo ''.$login_data['profile'].'';?>" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a id="bt4" class="dropdown-item" href="profile.php">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo ''.$login_data['profile'].'';?>" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block"><?php echo ''.$_SESSION['is_logged_in'].'';?></span>
                            <small class="text-muted">Reseller</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a id="bt4" class="dropdown-item" href="profile.php">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>             
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a id="bt4" class="dropdown-item" href="../logout.php" target="_blank">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->