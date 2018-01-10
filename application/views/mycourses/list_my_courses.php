
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="title_left">
                <h3>Mis Cursos Realizados

            </div>
        </div>
        <!--<div class="x_panel">-->

        <!--<div class="x_content">-->
        <div class="row">
            <?php
            if (!empty($courses)) {
                ?>
                <?php foreach ($courses as $course) { ?>
                    <a href="#" onclick="show_CourseDetail(<?php echo $course->event_id ?>,<?php echo $course->event_client_id ?>)">

                        <div class="col-md-55">
                            <div class="thumbnail">
                                <div class="image view view-first">
                                    <img style="width: 100%; display: block;" src="<?php echo base_url() . "uploads/events/logo/" . $course->url_logo_event ?>" alt="image" />
                                </div>
                                <div class="caption">
                                    <b><i class="fa fa-calendar"> </i>  <?php echo translateMonth(date("F", strtotime($course->date_from))) . " " . date('d Y', strtotime($course->date_from)); ?></b>
                                    <br><?php echo $course->event; ?>
                                </div>
                            </div>
                        </div>
                    </a>

                    <?php
                }
            } else {
                ?>
                <div class="callout callout-info">
                    <h4>Atención</h4>

                    <p>Ud. no ha realizado ningun curso todavía.</p>

                </div>
            <?php } ?>     

        </div>
        <!--</div>-->
        <!--</div>-->
    </div>
</div>

<?php
//function translateMonth($month) {
//    switch ($month) {
//        case "January":
//            $month_spanish = "Enero";
//            break;
//        case "February":
//            $month_spanish = "Febrero";
//            break;
//        case "March":
//            $month_spanish = "Marzo";
//            break;
//        case "April":
//            $month_spanish = "Abril";
//            break;
//        case "May":
//            $month_spanish = "Mayo";
//            break;
//        case "June":
//            $month_spanish = "Junio";
//            break;
//        case "July":
//            $month_spanish = "Julio";
//            break;
//        case "August":
//            $month_spanish = "Agosto";
//            break;
//        case "September":
//            $month_spanish = "Septiembre";
//            break;
//        case "October":
//            $month_spanish = "Ocutbre";
//            break;
//        case "November":
//            $month_spanish = "Noviembre";
//            break;
//        case "December":
//            $month_spanish = "Diciembre";
//            break;
//    }
//
//    return $month_spanish;
//}
?>