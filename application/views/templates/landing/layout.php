<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $event[0]->name; ?></title>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->    
        <link href="<?php echo base_url() ?>resources/templateLanding/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Slick slider -->
        <link href="<?php echo base_url() ?>resources/templateLanding/assets/css/slick.css" rel="stylesheet">
        <!-- Theme color -->
        <link id="switcher" href="<?php echo base_url() ?>resources/templateLanding/assets/css/theme-color/ccs-theme.css" rel="stylesheet">

        <!-- Main Style -->
        <link href="<?php echo base_url() ?>resources/templateLanding/style.css" rel="stylesheet">

        <!-- Fonts -->

        <!-- Open Sans for body font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,800" rel="stylesheet">
        <!-- Montserrat for title -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- PNotify -->
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.brighttheme.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.history.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.material.css" rel="stylesheet"> 
        <link href="<?php echo base_url() ?>resources/templateAdminGentella/vendors/pnotify/dist/pnotify.mobile.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!-- Start Header -->
        <header id="mu-hero" class="" role="banner">
            <!-- Start menu  -->
            <nav class="navbar navbar-fixed-top navbar-default mu-navbar">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Logo -->
                        <a class="navbar-brand" href="index.html">CCS</a>

                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav mu-menu navbar-right">
                            <li><a href="#mu-hero">Home</a></li>
                            <li><a href="#mu-about">Evento</a></li>
                            <li><a href="#mu-schedule">Temáticas</a></li>
                            <li><a href="#mu-speakers">Conferencistas</a></li>
                            <!--<li><a href="#mu-pricing">Precios</a></li>-->
                            <li><a href="#mu-register">Registrarme</a></li>
                            <!--<li><a href="#mu-sponsors">Sponsors</a></li>-->
                            <!--<li><a href="#mu-contact">Contactanos</a></li>-->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <!-- End menu -->

            <div class="mu-hero-overlay">
                <div class="container">
                    <div class="mu-hero-area">

                        <!-- Start hero featured area -->
                        <div class="mu-hero-featured-area">
                            <!-- Start center Logo -->
                            <div class="mu-logo-area">
                                <!-- text based logo -->
                                <!--<a class="mu-logo" href="#">Eventoz</a>-->
                                <!-- image based logo -->
                                <a href="#"><img src="<?php echo base_url() ?>resources/img/ccs_logo.png" alt="logo img"></a> 
                            </div>
                            <!-- End center Logo -->

                            <div class="mu-hero-featured-content">

                                <h1><?php echo $event[0]->name; ?></h1>
                                <!--<h2>The Biggest International IT Professional Conference</h2>-->
                                <?php
                                if ($event[0]->date_from == $event[0]->date_until) {
                                    $date = translateMonth(date("F", strtotime($event[0]->date_from))) . " " . date('d Y', strtotime($event[0]->date_from));
                                } else {
                                    $date = date('d', strtotime($event[0]->date_from)) . " de " . translateMonth(date("F", strtotime($event[0]->date_from))) . " de " . date('Y', strtotime($event[0]->date_from)) . ' al ' . date('d', strtotime($event[0]->date_until)) . " de " . translateMonth(date("F", strtotime($event[0]->date_until))) . " " . date('Y', strtotime($event[0]->date_until));
                                }
                                ?>
                                <!--<p class="mu-event-date-line">19 - 21 February, 2018. New York, USA</p>-->
                                <input type="hidden" id="date_start" value="<?php echo date('Y/m/d', strtotime($event[0]->date_from)); ?>">
                                <p class="mu-event-date-line"><?php echo $date . ", " . $event[0]->city; ?></p>

                                <div class="mu-event-counter-area">
                                    <div id="mu-event-counter">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End hero featured area -->

                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Start main content -->
        <main role="main">
            <!-- Start About -->
            <section id="mu-about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-about-area">
                                <!-- Start Feature Content -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mu-about-left">
                                            <img class="img-event" src="<?php echo base_url() . "uploads/events/landing/" . $event_resources[0]->url_logo_landing ?>" alt="Men Speaker">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mu-about-right">
                                            <h2>Sobre el Evento</h2>
                                            <p><?php echo $event_resources[0]->landing_description ?></p>                 
                                        </div>
                                    </div>
                                </div>
                                <!-- End Feature Content -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About -->

            <!-- Start Schedule  -->
            <section id="mu-schedule">
                <div class="container">
                    <div class="row">
                        <div class="colo-md-12">
                            <div class="mu-schedule-area">

                                <div class="mu-title-area">
                                    <h2 class="mu-title">Temáticas</h2>
                                    <p>A continuación podrás encontrar las temáticas que se trataran en el evento y sus respectivos instructores.</p>
                                </div>

                                <div class="mu-schedule-content-area">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs mu-schedule-menu" role="tablist">
                                        <?php
                                        if ($event[0]->date_from == $event[0]->date_until) {
                                            echo '<li role = "presentation" class = "active"><a href = "#day-1" aria-controls = "day-1" role = "tab" data-toggle = "tab">' . translateMonth(date("F", strtotime($event[0]->date_from))) . " " . date('d', strtotime($event[0]->date_from)) . '</a></li>';
                                        } else {
                                            $dates = createDateRange($event[0]->date_from, date('Y-m-d', strtotime($event[0]->date_until . ' +1 day')));
                                            for ($i = 0; $i < count($dates); $i++) {
                                                if ($i == 0) {
                                                    echo '<li role = "presentation" class = "active"><a href = "#day-' . $i . '" aria-controls = "day-' . $i . '" role = "tab" data-toggle = "tab">Día ' . ($i + 1) . ' / ' . translateMonth(date("F", strtotime($dates[$i]))) . " " . date('d', strtotime($dates[$i])) . '</a></li>';
                                                } else {
                                                    echo '<li role = "presentation" ><a href = "#day-' . $i . '" aria-controls = "day-' . $i . '" role = "tab" data-toggle = "tab">Día ' . ($i + 1) . ' / ' . translateMonth(date("F", strtotime($dates[$i]))) . " " . date('d', strtotime($dates[$i])) . '</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content mu-schedule-content">
                                        <?php if ($event[0]->date_from == $event[0]->date_until) { ?>
                                            <div role = "tabpanel" class = "tab-pane fade mu-event-timeline in active" id = "day-1">
                                                <ul>
                                                    <?php
                                                    if (count($topics) > 0) {
                                                        foreach ($topics as $topic) {
                                                            ?>
                                                            <li>
                                                                <div class="mu-single-event">
                                                                    <?php
                                                                    if ($topic->url_img_profile != "") {
                                                                        echo '<img width = "80" height = "80" src = "' . base_url() . 'uploads/providers/profile/' . $topic->url_img_profile . '" alt = "speaker img">';
                                                                    } else {
                                                                        echo '<img width = "80" height = "80" src = "' . base_url() . 'resources/img/speaker_avatar.jpg" alt = "speaker img">';
                                                                    }
                                                                    ?>
                                                                    <!--<img src="assets/images/speaker-1.jpg" alt="event speaker">-->
                                                                    <p class="mu-event-time"><?php echo $topic->thematic_area_type; ?></p>
                                                                    <h3><?php echo $topic->topic; ?></h3>
                                                                    <span>Por <?php echo $topic->provider_name . " " . $topic->provider_lastname; ?></span>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                            <?php
                                        } else {
                                            $dates = createDateRange($event[0]->date_from, date('Y-m-d', strtotime($event[0]->date_until . ' +1 day')));
                                            for ($i = 0; $i < count($dates); $i++) {
                                                if ($i == 0) {
                                                    $active = "active";
                                                } else {
                                                    $active = "";
                                                }
                                                ?>
                                                <div role="tabpanel" class="tab-pane fade mu-event-timeline in <?php echo $active; ?>" id="day-<?php echo $i; ?>">
                                                    <ul>
                                                        <?php
                                                        if (count($topics) > 0) {
                                                            foreach ($topics as $topic) {
                                                                if (date('Y-m-d', strtotime($topic->date_hour)) == $dates[$i]) {
                                                                    ?>
                                                                    <li>
                                                                        <div class="mu-single-event">
                                                                            <?php
                                                                            if ($topic->url_img_profile != "") {
                                                                                echo '<img width = "80" height = "80" src = "' . base_url() . 'uploads/providers/profile/' . $topic->url_img_profile . '" alt = "speaker img">';
                                                                            } else {
                                                                                echo '<img width = "80" height = "80" src = "' . base_url() . 'resources/img/speaker_avatar.jpg" alt = "speaker img">';
                                                                            }
                                                                            ?>
                                                                            <!--<img src="assets/images/speaker-1.jpg" alt="event speaker">-->
                                                                            <p class="mu-event-time"><?php echo date('H:i A', strtotime($topic->date_hour)); ?></p>
                                                                            <p class="mu-event-time"><?php echo $topic->thematic_area_type; ?></p>
                                                                            <h3><?php echo $topic->topic; ?></h3>
                                                                            <span>Por <?php echo $topic->provider_name . " " . $topic->provider_lastname; ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Schedule -->

            <!-- Start Speakers -->
            <section id="mu-speakers">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-speakers-area">

                                <div class="mu-title-area">
                                    <?php
                                    if (count($topics) > 1) {
                                        echo '<h2 class="mu-title">Nuestros Conferencistas</h2>';
                                    } else {
                                        echo '<h2 class="mu-title">Nuestro Conferencista</h2>';
                                    }
                                    ?>

                                    <p>Ellos serán nuestros conferencistas para este evento.</p>
                                </div>

                                <!-- Start Speakers Content -->
                                <div class="mu-speakers-content">

                                    <div class="mu-speakers-slider">

                                        <?php
                                        if (count($topics) > 0) {
                                            $instructors = array();
                                            foreach ($topics as $topic) {
                                                if (!in_array($topic->provider_id, $instructors)) {
                                                    array_push($instructors, $topic->provider_id);
                                                    ?>
                                                    <div class="mu-single-speakers">
                                                        <?php
                                                        if ($topic->url_img_profile != "") {
                                                            echo '<img width = "265" height = "236" src = "' . base_url() . 'uploads/providers/profile/' . $topic->url_img_profile . '" alt = "speaker img">';
                                                        } else {
                                                            echo '<img width = "265" height = "236" src = "' . base_url() . 'resources/img/speaker_avatar.jpg" alt = "speaker img">';
                                                        }
                                                        ?>

                                                        <div class="mu-single-speakers-info">
                                                            <h3><?php echo $topic->provider_name . " " . $topic->provider_lastname; ?></h3>
                                                            <!--<p>Digital Artist</p>-->
                                                            <ul class="mu-single-speakers-social">
                                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <!-- End Speakers Content -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Speakers -->

            <!-- Start Register  -->
            <section id="mu-register">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-register-area" >



                                <div class="mu-register-content form-register">
                                    <div class="mu-title-area">
                                        <h2 class="mu-title">Formulario de Registro</h2>
                                        <p>Por favor ingresa los siguientes datos.</a></p><br>
                                    </div>

                                    <div class="mu-register-form">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input id="event_id" type="hidden" name="event_id" value="<?php echo $event[0]->event_id; ?>">
                                                    <input id="name" placeholder="Nombre(s) y Apellido(s)" type="text" class="form-control required-register" name="name" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <select class="form-control" name="ticket" id="ticket">
                                                        <option value="">Ciudad donde te encuentras</option>
                                                        <?php
                                                        foreach ($cities as $city) {
                                                            echo "<option value='$city->city_id' city='$city->name'>" . $city->name . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input id="phone_number" placeholder="Teléfono Contacto" type="text" class="form-control required-register" name="phone_number"  value="" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input id="email" placeholder="Correo Electrónico" type="email" class="form-control required-register" name="email" value="" required>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="mu-reg-submit-btn" onclick="send_Register()">Registrarme</button>

                                    </div>
                                </div>
                            </div>

                            <div class="mu-register-area response-register" style="display:none" >
                                <div class="mu-title-area">
                                    <div id="content"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>

<!--            <section id="mu-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-register-area" >

                    <div class="mu-title-area">
                        <h2 class="mu-title">Formulario de Registro</h2>
                        <p>Llena los siguientes datos para registrarte al evento. Si ya habías participado en un evento anteriormente <a href="#">haz clic aquí</a></p>
                    </div>

                    <div class="mu-register-content">
                        <form class="mu-register-form" style='display:none'>  

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="name" placeholder="Ingresa tu número de documento" type="text" class="form-control required-client-landing" name="name" value="" required>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="mu-reg-submit-btn">Registrarme</button>

                        </form>


                        <form class="mu-register-form">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="name" placeholder="Nombre(s)" type="text" class="form-control required-client-landing" name="name" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="lastname" placeholder="Apellido(s)" type="text" class="form-control required-client-landing" name="lastname" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control required-client-landing" id="document_type" name="document_type" required>
                                            <option value="">Tipo de Documento...</option>
            <?php
            foreach ($document_types as $document_type) {
                echo "<option value='$document_type->document_type_id'>" . $document_type->name . "</option>";
            }
            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="document_number" placeholder="Número de Documento" type="text" class="form-control required-client-landing" name="document_number" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="phone_number" placeholder="Teléfono Contacto" type="text" class="form-control required-client-landing" name="phone_number" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="address" placeholder="Dirección Contacto" type="text" class="form-control required-client-landing" name="address" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="email" placeholder="Correo Electrónico" type="email" class="form-control required-client-landing" name="email" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="company" placeholder="Empresa" type="text" class="form-control required-client-landing" name="company" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input id="position" placeholder="Cargo" type="text" class="form-control required-client-landing" name="position" value="" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="mu-reg-submit-btn">Registrarme</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>-->
            <!-- End Register -->

        </main>

        <!-- End main content -->	

        <!-- Start footer -->
        <footer id="mu-footer" role="contentinfo">
            <div class="container">
                <div class="mu-footer-area">
                    <div class="mu-footer-top">
                        <div class="mu-social-media">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="mu-footer-bottom">
                        <p class="mu-copy-right">&copy; Copyright <a rel="nofollow" href="http://ccs.org.co/salaprensa/">Consejo Colombiano de Seguridad 2018</a>. Todos los Derechos Reservados.</p>
                    </div>
                </div>
            </div>

        </footer>
        <!-- End footer -->
        <?php

        function translateMonth($month) {
            switch ($month) {
                case "January":
                    $month_spanish = "Enero";
                    break;
                case "February":
                    $month_spanish = "Febrero";
                    break;
                case "March":
                    $month_spanish = "Marzo";
                    break;
                case "April":
                    $month_spanish = "Abril";
                    break;
                case "May":
                    $month_spanish = "Mayo";
                    break;
                case "June":
                    $month_spanish = "Junio";
                    break;
                case "July":
                    $month_spanish = "Julio";
                    break;
                case "August":
                    $month_spanish = "Agosto";
                    break;
                case "September":
                    $month_spanish = "Septiembre";
                    break;
                case "October":
                    $month_spanish = "Ocutbre";
                    break;
                case "November":
                    $month_spanish = "Noviembre";
                    break;
                case "December":
                    $month_spanish = "Diciembre";
                    break;
            }

            return $month_spanish;
        }

        function createDateRange($startDate, $endDate, $format = "Y-m-d") {
            $begin = new DateTime($startDate);
            $end = new DateTime($endDate);

            $interval = new DateInterval('P1D'); // 1 Day
            $dateRange = new DatePeriod($begin, $interval, $end);

            $range = [];
            foreach ($dateRange as $date) {
                $range[] = $date->format($format);
            }

            return $range;
        }
        ?>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Bootstrap -->
        <script src="<?php echo base_url() ?>resources/templateLanding/assets/js/bootstrap.min.js"></script>
        <!-- Slick slider -->
        <script type="text/javascript" src="<?php echo base_url() ?>resources/templateLanding/assets/js/slick.min.js"></script>
        <!-- Event Counter -->
        <script type="text/javascript" src="<?php echo base_url() ?>resources/templateLanding/assets/js/jquery.countdown.min.js"></script>
        <!-- Ajax contact form  -->
        <script type="text/javascript" src="<?php echo base_url() ?>resources/templateLanding/assets/js/app.js"></script>
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

        <!-- Custom js -->
        <script type="text/javascript" src="<?php echo base_url() ?>resources/templateLanding/assets/js/custom.js"></script>
        <!-- Custom js -->
        <script type="text/javascript" src="<?php echo base_url() ?>resources/js/landing.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>resources/js/validateFields.js"></script>

    </body>
</html>