<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestor de Eventos</title>

        <!-- Bootstrap --> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- PNotify -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.brighttheme.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.history.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.material.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.mobile.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- FullCalendar -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Ion.RangeSlider -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/normalize-css/normalize.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Lightbox -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/lightbox/css/lightbox.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Jquery smart wizard -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jQuery-Smart-Wizard/css/smart_wizard_theme_arrows.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/build/css/custom.css" rel="stylesheet">
    </head>

    <body class="nav-md" style='padding: 0px 0px 0px 0px !important;'>
        <div class="container body">

            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="home" class="site_title"> <span>Gestor de Eventos</span></a>
                        </div>
                        <?php $this->load->view('templates/admin/sidebar_left'); ?>
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="#" onclick="closeSession()">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('templates/admin/header'); ?>
            <div class="right_col" role="main">
                <div class="row">
                    <div id="content-msg" class="col-md-12 col-sm-12 col-xs-12">
                    </div>
                </div>	
                <?php $this->load->view($content); ?>
            </div>

        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jquery/dist/jquery.redirect.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jquery/dist/jquery.inputmask.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- EChart.js -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/echarts/dist/echarts.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/echarts/map/js/world.js"></script>
        <!-- gauge.js -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Flot/jquery.flot.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Flot/jquery.flot.time.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- morris.js -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/morris.js/morris.min.js"></script>
        <!-- DateJS -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- PNotify -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.buttons.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.nonblock.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.animate.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.callbacks.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.confirm.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.desktop.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.history.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.mobile.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.reference.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.tooltip.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/nprogress/nprogress.js"></script>
        <!-- FullCalendar -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/fullcalendar/dist/locale/es.js"></script>
        <!-- jQuery Smart Wizard -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->    
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <!-- Ion.RangeSlider -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/iCheck/icheck.min.js"></script>
        <!-- Lightbox -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/lightbox/js/lightbox.js"></script>
        <!-- validator -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/validator/validator.js"></script>
        <!-- Datatables -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <!--Custom Theme Scripts -->
        <script src="<?php echo base_url() ?>resources/templateAdminGentella/build/js/custom.js"></script>

        <script src="<?php echo base_url() ?>resources/js/utilities.js"></script>
        <script src="<?php echo base_url() ?>resources/js/validateFields.js"></script>

        <?php if ($this->session->userdata('module') == 'login') { ?>
            <script src="<?php echo base_url() ?>resources/js/login.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'home') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/home.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'dashboard') {
            ?>
            <script src = "<?php echo base_url() ?>resources/js/dashboard.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'events') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/events.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'clients') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/clients.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'providers') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/providers.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'topics') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/topics.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'mycourses') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/mycourses.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'users') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/users.js"></script>
            <?php
        }
        if ($this->session->userdata('module') == 'settings') {
            ?>
            <script src="<?php echo base_url() ?>resources/js/settings.js"></script>
        <?php } ?>

    </body>
</html>
