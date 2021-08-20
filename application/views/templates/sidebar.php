<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="ml=2 brand-text font-weight-light"><b>AZURA</b> BAKEHOUSE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-success">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/users.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $users['username']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

                <!-- Query Menu-->
                <?php
                $id_role = $this->session->userdata('id_role');
                $queryMenu = "SELECT `user_menu`.`id`, `menu` 
                  FROM `user_menu` JOIN `user_access_menu`
                  ON `user_menu`.`id` = `user_access_menu`.`id_menu`
                  WHERE `user_access_menu`.`id_role` = $id_role
                  ORDER BY `user_access_menu`.`id_menu` ASC
                  ";
                $menu = $this->db->query($queryMenu)->result_array();
                ?>

                <!-- LOOPING MENU -->
                <?php foreach ($menu as $m) : ?>
                    <li class="nav-header"><?= strtoupper($m['menu']); ?></li>
                    <!-- LOOPING SUBMENU -->
                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
                         FROM `user_sub_menu` JOIN `user_menu`
                         ON `user_sub_menu`.`id_user_menu` = `user_menu`.`id`
                         WHERE `user_sub_menu`.`id_user_menu` = $menuId
                         ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>

                    <?php foreach ($subMenu as $sm) : ?>
                        <?php if ($title == $sm['judul']) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url($sm['url']); ?>" class="nav-link active">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                    <p>
                                        <?= $sm['judul']; ?>
                                    </p>

                                </a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                    <p>
                                        <?= $sm['judul']; ?>
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>