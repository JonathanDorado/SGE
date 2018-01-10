<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url() . 'resources/img/speaker_avatar.jpg'; ?>" alt="">
                        <?php
                        if ($this->session->userdata('user_id') != '' OR $this->session->userdata('client_id') != '') {
                            echo $this->session->userdata('name') . " " . $this->session->userdata('lastname');
                        }
                        ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php echo base_url() ?>logout/closeSession"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                    </ul>
                </li>


                <!--                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/img.jpg" alt="">
                                        <div class="name_session" style="display:inline">
                <?php
                if ($this->session->userdata('user_id') != '' OR $this->session->userdata('client_id') != '') {
                    echo $this->session->userdata('name') . " " . $this->session->userdata('lastname');
                }
                ?>
                                        </div>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <a href="<?php echo base_url() ?>logout/closeSession">
                                                <i class="fa fa-power-off"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
