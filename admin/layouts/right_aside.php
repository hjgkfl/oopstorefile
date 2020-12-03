  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="img-admin/kaver.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="img-admin/kaver.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['name'] ?></a>
          </div>
        </div>
       <?php
       $run=getComment();
       $t=mysqli_num_rows($run);
       ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            
            <li class="nav-item">
              <a href="dashboard.php?get_cate" class="nav-link">
                <i class="nav-icon fa fa-list fa-2x"></i>
                <p>
                  لیست دسته بندی ها
                  <span class="right badge badge-danger">جدید</span>
                </p>
              </a>
            </li>
						<li class="nav-item">
              <a href="dashboard.php?insert_cate" class="nav-link">
                <i class="nav-icon fa fa-list-alt fa-2x"></i>
                <p>
                  دسته بندی جدید
                </p>
              </a>
            </li>
              <li class="nav-item">
              <a href="dashboard.php?get_post" class="nav-link">
                <i class="nav-icon fa fa-list fa-2x"></i>
                <p>
                  لیست پست ها
                  <span class="right badge badge-danger">جدید</span>
                </p>
              </a>
            </li>
              <li class="nav-item">
              <a href="dashboard.php?insert_post" class="nav-link">
                <i class="nav-icon fa fa-list-alt fa-2x"></i>
                <p>
                  پست جدید
                </p>
              </a>
              </li>
              <li class="nav-item">
                  <a href="dashboard.php?comment" class="nav-link">
                      <i class="nav-icon fa fa-comment fa-2x"></i>
                      <p>
                          نظرات
                          <span class="right badge badge-danger"><?= $t ?></span>
                      </p>
                  </a>
              </li>
					</ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>

    <!-- /.sidebar -->
  </aside>
