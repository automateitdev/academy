 <!-- Brand Logo -->
 <a href="#" class="brand-link">
      <img src="{{asset('images/com/Academy Logo Final.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
      <!-- <span class="brand-text font-weight-light">Academy</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          <!-- Website Maintenance start -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Website Maintenance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('menu')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page Section</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Features</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Testimonial</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faq</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Website Maintenance end -->
          <!-- Master Setting start -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- Institute Setup start -->
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Institute Setup</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('startup.index')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Startup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('basic.index')}}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Basic Setup</p>
                    </a>
                  </li>
                  <!-- Class Setup start -->
                  <li class="nav-item">
                    <a href="#" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Class Setup</p>
                      <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Section Assign</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Group Assign</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Academic Year Assign</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Session Assign</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!-- Class Setup end -->
                </ul>
              </li>
              <!-- Institute Setup end -->
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Setup</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Master Setting end -->






          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-header">EXAMPLES</li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->