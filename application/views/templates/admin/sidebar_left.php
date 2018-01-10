<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3><?php echo MODE; ?></h3>
        <ul class="nav side-menu">
            <?php
            $permissions_home = array(EVENTS_CALENDAR);
            if (array_intersect($permissions_home, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="<?php echo base_url() ?>home">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <?php
            }
            $permissions_dashboard = array(DASHBOARD_PLATFORM, DASHBOARD_EVENT);
            if (array_intersect($permissions_dashboard, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="<?php echo base_url() ?>dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <?php
            }
            $permissions_events = array(VIEW_EVENTS, CREATE_PRESENTIAL_EVENT, CREATE_VIRTUAL_EVENT);
            if (array_intersect($permissions_events, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a>
                        <i class="fa fa-book"></i> Eventos <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_view_events = array(VIEW_EVENTS);
                        if (array_intersect($permissions_view_events, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>event"> Ver Eventos</a></li>
                            <?php
                        }
                        $permissions_create_events = array(CREATE_PRESENTIAL_EVENT, CREATE_VIRTUAL_EVENT);
                        if (array_intersect($permissions_create_events, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>event/create"> Registrar Nuevo</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            $permissions_topics = array(VIEW_TOPICS, CREATE_TOPIC);
            if (array_intersect($permissions_topics, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="#">
                        <i class="fa fa-server"></i> Temáticas <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_view_topics = array(VIEW_TOPICS);
                        if (array_intersect($permissions_view_topics, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>topics"> Ver Tématicas</a></li>
                            <?php
                        }
                        $permissions_create_topics = array(CREATE_TOPIC);
                        if (array_intersect($permissions_create_topics, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>topics/create"> Registrar Nueva</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            $permissions_providers = array(VIEW_PROVIDERS, CREATE_PROVIDERS);
            if (array_intersect($permissions_providers, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="#">
                        <i class="fa fa-truck"></i> Proveedores  <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_view_providers = array(VIEW_PROVIDERS);
                        if (array_intersect($permissions_view_providers, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>providers"> Ver Proveedores</a></li>
                            <?php
                        }
                        $permissions_create_providers = array(CREATE_PROVIDERS);
                        if (array_intersect($permissions_create_providers, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>providers/create"> Crear Nuevo</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            $permissions_clients = array(VIEW_CLIENTS, CREATE_CLIENTS);
            if (array_intersect($permissions_clients, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="#">
                        <i class="fa fa-users"></i> Clientes  <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_view_clients = array(VIEW_CLIENTS);
                        if (array_intersect($permissions_view_clients, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>clients"> Ver Clientes</a></li>
                            <?php
                        }
                        $permissions_create_clients = array(CREATE_CLIENTS);
                        if (array_intersect($permissions_create_clients, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>clients/create"> Crear Nuevo</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('user_type')=='CLIENT') { ?>
                <li>
                    <a href="<?php echo base_url() ?>mycourses">
                        <i class="fa fa-pencil"></i>  <span>Mis Cursos</span>
                    </a>
                </li>
            <?php } ?>

            <?php
            $permissions_users = array(VIEW_USERS, CREATE_USERS);
            if (array_intersect($permissions_users, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="#">
                        <i class="fa fa-user"></i> Usuarios <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_view_users = array(VIEW_USERS);
                        if (array_intersect($permissions_view_users, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>users"> Ver Usuarios </a></li>
                            <?php
                        }
                        $permissions_create_users = array(CREATE_USERS);
                        if (array_intersect($permissions_create_users, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>users/create"> Crear Usuario</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            $permissions_settings = array(VIEW_PROFILES);
            if (array_intersect($permissions_settings, $this->session->userdata('permissions'))) {
                ?>
                <li>
                    <a href="#">
                        <i class="fa fa-cog"></i> Configuraciones <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php
                        $permissions_profile_settings = array(VIEW_PROFILES);
                        if (array_intersect($permissions_profile_settings, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>settings/list_profiles"> Perfiles </a></li>
                        <?php }
                        ?>
                        <?php
                        $permissions_offline_settings = array(SYNC_OFFLINE_DATA);
                        if (array_intersect($permissions_offline_settings, $this->session->userdata('permissions'))) {
                            ?>
                            <li><a href="<?php echo base_url() ?>settings/show_OfflineMode"> Modo Offline </a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->