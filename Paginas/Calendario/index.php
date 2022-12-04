<?php

/**
 **
 **  BY iCODEART
 **
 **********************************************************************
 **                      REDES SOCIALES                            ****
 **********************************************************************
 **                                                                ****
 ** FACEBOOK: https://www.facebook.com/icodeart                    ****
 ** TWIITER: https://twitter.com/icodeart                          ****
 ** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
 ** GITHUB: https://github.com/icodeart                            ****
 ** TELEGRAM: https://telegram.me/icodeart                         ****
 ** EMAIL: info@icodeart.com                                       ****
 **                                                                ****
 **********************************************************************
 **********************************************************************
 **/

// Definimos nuestra zona horaria
date_default_timezone_set("America/Santiago");

// incluimos el archivo de funciones
include 'funciones.php';
include("../BancoDeDados/conexaoBD.php");

// incluimos el archivo de configuracion
include 'config.php';

// Pega a data/horario de inicio
if (isset($_POST['from'])) {

    // Se inserir data e horario faz o resto
    if ($_POST['from'] != "" and $_POST['to'] != "") {

        // Recibimos el fecha de inicio y la fecha final desde el form
        $Datein                    = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $Datefi                    = date('d/m/Y H:i:s', strtotime($_POST['to']));
        $inicio = _formatear($Datein);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($Datefi);

        // Recibimos el fecha de inicio y la fecha final desde el form
        $orderDate                      = date('d/m/Y H:i:s', strtotime($_POST['from']));
        $inicio_normal = $orderDate;

        // y la formateamos con la funcion _formatear
        $orderDate2                      = date('d/m/Y H:i:s', strtotime($_POST['to']));
        $final_normal  = $orderDate2;

        // Recebe o id de servico
        $servico = evaluar($_POST['servico']);

        $consultarSer = "SELECT * FROM tiposervico WHERE tiposervico.tipNome = $servico LIMIT 1";

        if ($consultarSer > 0) {
            $resultTipSer = "SELECT * FROM tiposervico";
            $resultSer = mysqli_query($conn, $resultTipSer);

            while ($rowSer = mysqli_fetch_assoc($resultSer)) {
                $idTipo = $rowSer["tipId"];
            }
        }

        // Recebe o id do fun inserido
        $funcionario   = evaluar($_POST['funcionario']);
        $consultarPes = "SELECT * FROM pessoa WHERE pessoa.pesNome = $funcionario LIMIT 1";

        if ($consultarPes > 0) {
            $resultPessoa = "SELECT * FROM pessoa";
            $resultPes = mysqli_query($conn, $resultPessoa);

            while ($rowPes = mysqli_fetch_assoc($resultPes)) {
                $idPes = $rowPes["pesId"];
                $resultFuncionario = "SELECT * FROM funcionario";
                $resultFun = mysqli_query($conn, $resultFuncionario);

                while ($rowFun = mysqli_fetch_assoc($resultFun)) {
                    if ($rowFun["funPes_id"] == $idPes) {
                        $idFun = $rowFun["funId"];
                    }
                }
            }
        }


        // insertamos el evento
        $query = "INSERT INTO trabalhosalao.evento(eveInicio, eveFim, eveInicioNormal, eveFimNormal, eveUrl, eveFun_id, eveTip_id)
         VALUES('$inicio', '$final', '$inicio_normal', '$final_normal', '', '$idTipo', '$idFun')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query) or die('<script type="text/javascript">alert("Horario No Disponible ")</script>');

        header("Location:$base_url");


        // Obtenemos el ultimo id insetado
        $im = $conexion->query("SELECT MAX(eveId) AS id FROM evento");
        $row = $im->fetch_row();
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "$base_url" . "descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query = "UPDATE evento SET eveUrl = '$link' WHERE eveId = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query);

        // redireccionamos a nuestro calendario
        //header("Location:$base_url"); 
    }
}

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Calendario - Beauty Salon</title>
    <link rel="stylesheet" type="text/css" href="<?php $base_url ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php $base_url ?>js/calendar.js">
    <link href="<?php $base_url ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php $base_url ?>css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?php $base_url ?>js/es-ES.js"></script>
    <script src="<?php $base_url ?>js/jquery.min.js"></script>
    <script src="<?php $base_url ?>js/moment.js"></script>
    <script src="<?php $base_url ?>js/calendar.js"></script>
    <script src="<?php $base_url ?>js/bootstrap.min.js"></script>
    <script src="<?php $base_url ?>js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="<?php $base_url ?>css/bootstrap-datetimepicker.min.css" />
    <link rel="shortcut icon" href="../../Logo/Letra.svg" type="image/x-icon">

</head>
</head>

<style>
    [class*="cal-cell"] {
        float: left;
        margin-left: 0;
        min-height: 1px;
    }

    .cal-row-fluid {
        width: 100%;
        *zoom: 1;
    }

    .cal-row-fluid:before,
    .cal-row-fluid:after {
        display: table;
        content: "";
        line-height: 0;
    }

    .cal-row-fluid:after {
        clear: both;
    }

    .cal-row-fluid [class*="cal-cell"] {
        display: block;
        width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        float: left;
        margin-left: 0%;
        *margin-left: -0.05213764337851929%;
    }

    .cal-row-fluid [class*="cal-cell"]:first-child {
        margin-left: 0;
    }

    .cal-row-fluid .controls-row [class*="cal-cell"]+[class*="cal-cell"] {
        margin-left: 0%;
    }

    .cal-row-fluid .cal-cell7 {
        width: 100%;
        *width: 99.94669509594883%;
    }

    .cal-row-fluid .cal-cell6 {
        width: 85.71428571428571%;
        *width: 85.66098081023453%;
    }

    .cal-row-fluid .cal-cell5 {
        width: 71.42857142857142%;
        *width: 71.37526652452024%;
    }

    .cal-row-fluid .cal-cell4 {
        width: 57.14285714285714%;
        *width: 57.089552238805965%;
    }

    .cal-row-fluid .cal-cell3 {
        width: 42.857142857142854%;
        *width: 42.80383795309168%;
    }

    .cal-row-fluid .cal-cell2 {
        width: 28.57142857142857%;
        *width: 28.518123667377395%;
    }

    .cal-row-fluid .cal-cell1 {
        width: 14.285714285714285%;
        *width: 14.232409381663112%;
    }

    .cal-week-box .cal-offset7,
    .cal-row-fluid .cal-offset7,
    .cal-row-fluid .cal-offset7:first-child {
        margin-left: 100%;
        *margin-left: 99.89339019189765%;
    }

    .cal-week-box .cal-offset6,
    .cal-row-fluid .cal-offset6,
    .cal-row-fluid .cal-offset6:first-child {
        margin-left: 85.71428571428571%;
        *margin-left: 85.60767590618336%;
    }

    .cal-week-box .cal-offset5,
    .cal-row-fluid .cal-offset5,
    .cal-row-fluid .cal-offset5:first-child {
        margin-left: 71.42857142857142%;
        *margin-left: 71.32196162046907%;
    }

    .cal-week-box .cal-offset4,
    .cal-row-fluid .cal-offset4,
    .cal-row-fluid .cal-offset4:first-child {
        margin-left: 57.14285714285714%;
        *margin-left: 57.03624733475479%;
    }

    .cal-week-box .cal-offset3,
    .cal-row-fluid .cal-offset3,
    .cal-row-fluid .cal-offset3:first-child {
        margin-left: 42.857142857142854%;
        *margin-left: 42.750533049040506%;
    }

    .cal-week-box .cal-offset2,
    .cal-row-fluid .cal-offset2,
    .cal-row-fluid .cal-offset2:first-child {
        margin-left: 28.57142857142857%;
        *margin-left: 28.46481876332622%;
    }

    .cal-week-box .cal-offset1,
    .cal-row-fluid .cal-offset1,
    .cal-row-fluid .cal-offset1:first-child {
        margin-left: 14.285714285714285%;
        *margin-left: 14.17910447761194%;
    }

    .cal-row-fluid .cal-cell1 {
        width: 14.285714285714285%;
        *width: 14.233576642335766%;
    }

    [class*="cal-cell"].hide,
    .cal-row-fluid [class*="cal-cell"].hide {
        display: none;
    }

    [class*="cal-cell"].pull-right,
    .cal-row-fluid [class*="cal-cell"].pull-right {
        float: right;
    }

    .cal-row-head [class*="cal-cell"]:first-child,
    .cal-row-head [class*="cal-cell"] {
        min-height: auto;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cal-events-num {
        margin-top: 20px;
    }

    .cal-month-day {
        position: relative;
        display: block;
        width: 100%;
    }

    #cal-week-box {
        position: absolute;
        width: 70px;
        left: -71px;
        top: -1px;
        padding: 8px 5px;
        cursor: pointer;
    }

    #cal-day-tick {
        position: absolute;
        right: 50%;
        bottom: -21px;
        padding: 0px 5px;
        cursor: pointer;
        z-index: 5;
        text-align: center;
        width: 26px;
        margin-right: -17px;
    }

    .cal-year-box #cal-day-tick {
        margin-right: -7px;
    }

    #cal-slide-box {
        position: relative;
    }

    #cal-slide-tick {
        position: absolute;
        width: 16px;
        margin-left: -7px;
        height: 9px;
        top: -1px;
        z-index: 1;
    }

    #cal-slide-tick.tick-month1 {
        left: 12.5%;
    }

    #cal-slide-tick.tick-month2 {
        left: 37.5%;
    }

    #cal-slide-tick.tick-month3 {
        left: 62.5%;
    }

    #cal-slide-tick.tick-month4 {
        left: 87.5%;
    }

    #cal-slide-tick.tick-day1 {
        left: 7.14285714285715%;
    }

    #cal-slide-tick.tick-day2 {
        left: 21.42857142857143%;
    }

    #cal-slide-tick.tick-day3 {
        left: 35.71428571428572%;
    }

    #cal-slide-tick.tick-day4 {
        left: 50%;
    }

    #cal-slide-tick.tick-day5 {
        left: 64.2857142857143%;
    }

    #cal-slide-tick.tick-day6 {
        left: 78.57142857142859%;
    }

    #cal-slide-tick.tick-day7 {
        left: 92.85714285714285%;
    }

    .events-list {
        position: absolute;
        bottom: 0;
        left: 0;
        overflow: hidden;
    }

    #cal-slide-content ul.unstyled {
        margin-bottom: 0;
    }

    .cal-week-box {
        position: relative;
    }

    .cal-week-box [data-event-class] {
        white-space: nowrap;
        height: 30px;
        margin: 1px 1px;
        line-height: 30px;
        text-overflow: ellipsis;
        overflow: hidden;
        padding-left: 10px;
    }

    .cal-week-box .cal-column {
        position: absolute;
        height: 100%;
        z-index: -1;
    }

    .cal-week-box .arrow-before,
    .cal-week-box .arrow-after {
        position: relative;
    }

    .cal-week-box .arrow-after:after {
        content: "";
        position: absolute;
        top: 0px;
        width: 0;
        height: 0;
        right: 0;
        border-top: 15px solid #ffffff;
        border-left: 8px solid;
        border-bottom: 15px solid #FFFFFF;
    }

    .cal-week-box .arrow-before:before {
        content: "";
        position: absolute;
        top: 0px;
        width: 0;
        height: 0;
        left: 1px;
        border-top: 15px solid transparent;
        border-left: 8px solid #FFFFFF;
        border-bottom: 15px solid transparent;
    }

    #cal-day-box {
        text-wrap: none;
    }

    #cal-day-box .cal-day-hour-part {
        height: 30px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border-bottom: thin dashed #e1e1e1;
    }

    #cal-day-box .cal-day-hour .day-highlight {
        height: 30px;
    }

    #cal-day-box .cal-hours {
        font-weight: bolder;
    }

    #cal-day-box .cal-day-hour:nth-child(odd) {
        background-color: #fafafa;
    }

    #cal-day-box #cal-day-panel {
        position: sticky;
        padding-left: 60px;
    }

    #cal-day-box #cal-day-panel-hour {
        position: absolute;
        width: 100%;
        margin-left: -60px;
        z-index: -1;
    }

    #cal-day-box .day-event {
        max-width: 200px;
        overflow: hidden;
    }

    #cal-day-box .day-highlight {
        line-height: 30px;
        padding-left: 8px;
        padding-right: 8px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 1px solid #c3c3c3;
        margin: 1px 1px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #cal-day-box .day-highlight.dh-event-important {
        border: 1px solid #ad2121;
    }

    #cal-day-box .day-highlight.dh-event-warning {
        border: 1px solid #e3bc08;
    }

    #cal-day-box .day-highlight.dh-event-info {
        border: 1px solid #1e90ff;
    }

    #cal-day-box .day-highlight.dh-event-inverse {
        border: 1px solid #1b1b1b;
    }

    #cal-day-box .day-highlight.dh-event-success {
        border: 1px solid #006400;
    }

    #cal-day-box .day-highlight.dh-event-special {
        background-color: #ffe6ff;
        border: 1px solid #800080;
    }

    .event {
        display: block;
        background-color: #c3c3c3;
        width: 12px;
        height: 12px;
        margin-right: 2px;
        margin-bottom: 2px;
        -webkit-box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        box-shadow: inset 0px 0px 5px 0px rgba(0, 0, 0, 0.4);
        border-radius: 8px;
        border: 1px solid #ffffff;
    }

    .event-block {
        display: block;
        background-color: #c3c3c3;
        width: 20px;
        height: 100%;
    }

    .cal-event-list .event.pull-left {
        margin-top: 3px;
    }

    .event-important {
        background-color: #ad2121;
    }

    .event-info {
        background-color: #1e90ff;
    }

    .event-warning {
        background-color: #e3bc08;
    }

    .event-inverse {
        background-color: #1b1b1b;
    }

    .event-success {
        background-color: #006400;
    }

    .event-special {
        background-color: #800080;
    }

    .day-highlight:hover,
    .day-highlight {
        background-color: #dddddd;
    }

    .day-highlight.dh-event-important:hover,
    .day-highlight.dh-event-important {
        background-color: #fae3e3;
    }

    .day-highlight.dh-event-warning:hover,
    .day-highlight.dh-event-warning {
        background-color: #fdf1ba;
    }

    .day-highlight.dh-event-info:hover,
    .day-highlight.dh-event-info {
        background-color: #d1e8ff;
    }

    .day-highlight.dh-event-inverse:hover,
    .day-highlight.dh-event-inverse {
        background-color: #c1c1c1;
    }

    .day-highlight.dh-event-success:hover,
    .day-highlight.dh-event-success {
        background-color: #caffca;
    }

    .day-highlight.dh-event-special:hover,
    .day-highlight.dh-event-special {
        background-color: #ffe6ff;
    }

    .cal-row-head [class*="cal-cell"]:first-child,
    .cal-row-head [class*="cal-cell"] {
        font-weight: bolder;
        text-align: center;
        border: 0px solid;
        padding: 14px 0;
        z-index: 1;
        margin-top: -4%;
    }

    .cal-row-head [class*="cal-cell"] small {
        font-weight: normal;
    }

    .cal-year-box .row-fluid:hover,
    .cal-row-fluid:hover {
        background-color: #fafafa;
    }

    .cal-month-day {
        height: 100px;
    }

    [class*="cal-cell"]:hover {
        background-color: #ededed;
    }

    .cal-year-box [class*="span"],
    .cal-month-box [class*="cal-cell"] {
        min-height: 100px;
        border-right: 1px solid #e1e1e1;
        position: relative;
    }

    .cal-year-box [class*="span"] {
        min-height: 60px;
    }

    .cal-year-box .row-fluid [class*="span"]:last-child,
    .cal-month-box .cal-row-fluid [class*="cal-cell"]:last-child {
        border-right: 0px;
    }

    .cal-year-box .row-fluid,
    .cal-month-box .cal-row-fluid {
        border-bottom: 1px solid #e1e1e1;
        margin-left: 0px;
        margin-right: 0px;
    }

    .cal-year-box .row-fluid:last-child,
    .cal-month-box .cal-row-fluid:last-child {
        border-bottom: 0px;
    }

    .cal-month-box,
    .cal-year-box,
    .cal-week-box {
        border-top: 1px solid #e1e1e1;
        border-bottom: 1px solid #e1e1e1;
        border-right: 1px solid #e1e1e1;
        border-left: 1px solid #e1e1e1;
        border-radius: 2px;
    }

    span[data-cal-date] {
        font-size: 1.2em;
        font-weight: normal;
        opacity: 0.5;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.1s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        -ms-transition: all 0.1s ease-in-out;
        -o-transition: all 0.1s ease-in-out;
        margin-top: 15px;
        margin-right: 15px;
    }

    span[data-cal-date]:hover {
        opacity: 1;
    }

    .cal-day-outmonth span[data-cal-date] {
        opacity: 0.1;
        cursor: default;
    }

    .cal-day-today {
        background-color: #e8fde7;
    }

    .cal-day-today span[data-cal-date] {
        color: darkgreen;
    }

    .cal-month-box .cal-day-today span[data-cal-date] {
        font-size: 1.9em;
    }

    .cal-day-holiday span[data-cal-date] {
        color: #800080;
    }

    .cal-day-weekend span[data-cal-date] {
        color: darkred;
    }

    #cal-week-box {
        border: 1px solid #e1e1e1;
        border-right: 0px;
        border-radius: 5px 0 0 5px;
        background-color: #fafafa;
        text-align: right;
    }

    #cal-day-tick {
        border: 1px solid #e1e1e1;
        border-top: 0px solid;
        border-radius: 0 0 5px 5px;
        background-color: #ededed;
        text-align: center;
    }

    #cal-slide-box {
        border-top: 0px solid #8c8c8c;
    }

    #cal-slide-content {
        padding: 20px;
        color: #ffffff;
        background-color: steelblue;
    }

    #cal-slide-tick {
        background-image: url("../img/tick.png?2");
    }

    #cal-slide-content a.event-item {
        color: #ffffff;
        font-weight: normal;
        line-height: 22px;
    }

    .events-list {
        max-height: 47px;
        padding-left: 5px;
    }

    .cal-column {
        border-left: 1px solid #e1e1e1;
    }

    a.cal-event-week {
        text-decoration: none;
        color: #151515;
    }

    .badge-important {
        background-color: #b94a48;
    }
</style>

<body style="background: #eadfdb;">
    <div class="container">
        <div class="row">
            <!--<div class="page-header"><h4></h4></div>-->
            <div class="pull-left form-inline"><br>
                <div class="btn-group">
                    <button class="btn btn-primary" style="background-color: #b44a60; border-color: #b44a60" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i> </button>
                    <button class="btn" data-calendar-nav="today">Hoje</button>
                    <button class="btn btn-primary" style="background-color: #b44a60; border-color: #b44a60" data-calendar-nav="next"><i class="fa fa-arrow-right"></i> </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning" style="background-color: #cc7f91; border-color: #cc7f91" data-calendar-view="year">Ano</button>
                    <button class="btn btn-warning active" style="background-color: #cc7f91; border-color: #cc7f91" data-calendar-view="month">Mês</button>
                    <button class="btn btn-warning" style="background-color: #cc7f91; border-color: #cc7f91" data-calendar-view="week">Semana</button>
                    <button class="btn btn-warning" style="background-color: #cc7f91; border-color: #cc7f91" data-calendar-view="day">Dia</button>
                </div>
            </div>
            <div class="pull-right form-inline"><br>
                <button class="btn btn-info" style="background-color: #b44a60; border-color: #b44a60" data-toggle='modal' data-target='#add_evento'>Marcar Horário</button>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->

        </div>
        <!--ventana modal para el calendario-->
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" style="float: right;"> <i class="glyphicon glyphicon-remove "></i> </a>
                        <br>
                    </div>
                    <div class="modal-body" style="height: 400px">
                        <p>One fine body&hellip;</p>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <script src="<?php $base_url ?>js/underscore-min.js"></script>
    <script src="<?php $base_url ?>js/calendar.js"></script>
    <script type="text/javascript">
        (function($) {
            //creamos la fecha actual
            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

            //establecemos los valores del calendario
            var options = {

                // definimos que los agenda se mostraran en ventana modal
                modal: '#events-modal',

                // dentro de un iframe
                modal_type: 'iframe',

                //obtenemos los agenda de la base de datos
                events_source: '<?php $base_url ?>obtener_eventos.php',

                // mostramos el calendario en el mes
                view: 'month',

                // y dia actual
                day: yyyy + "-" + mm + "-" + dd,


                // definimos el idioma por defecto
                language: 'pt-br',

                //Template de nuestro calendario
                tmpl_path: '<?php $base_url ?>tmpls/',
                tmpl_cache: false,


                // Hora de inicio
                time_start: '08:00',

                // y Hora final de cada dia
                time_end: '22:00',

                // intervalo de tiempo entre las hora, en este caso son 30 minutos
                time_split: '30',

                // Definimos un ancho del 100% a nuestro calendario
                width: '100%',

                onAfterEventsLoad: function(events) {
                    if (!events) {
                        return;
                    }
                    var list = $('#eventlist');
                    list.html('');

                    $.each(events, function(key, val) {
                        $(document.createElement('li'))
                            .html('<a href="' + val.url + '">' + val.title + '</a>')
                            .appendTo(list);
                    });
                },
                onAfterViewLoad: function(view) {
                    $('#page-header').text(this.getTitle());
                    $('.btn-group button').removeClass('active');
                    $('button[data-calendar-view="' + view + '"]').addClass('active');
                },
                classes: {
                    months: {
                        general: 'label'
                    }
                }
            };


            // id del div donde se mostrara el calendario
            var calendar = $('#calendar').calendar(options);

            $('.btn-group button[data-calendar-nav]').each(function() {
                var $this = $(this);
                $this.click(function() {
                    calendar.navigate($this.data('calendar-nav'));
                });
            });

            $('.btn-group button[data-calendar-view]').each(function() {
                var $this = $(this);
                $this.click(function() {
                    calendar.view($this.data('calendar-view'));
                });
            });

            $('#first_day').change(function() {
                var value = $(this).val();
                value = value.length ? parseInt(value) : null;
                calendar.setOptions({
                    first_day: value
                });
                calendar.view();
            });
        }(jQuery));
    </script>

    <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agendar Novo Horário</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">

                        <!-- DATAS  -->
                        <label for="from">Inicio</label>
                        <div class='input-group date' id='from'>
                            <input type='text' id="from" name="from" class="form-control" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>

                        <br>

                        <label for="to">Final</label>
                        <div class='input-group date' id='to'>
                            <input type='text' name="to" id="to" class="form-control" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>

                        <br>


                        <!-- MOSTRA SERVIÇOS -->
                        <label for="tipo">Tipo de Serviço</label>
                        <select class="form-control" name="servico" id="tipo">
                            <?php
                            $result = "SELECT * FROM trabalhosalao.tiposervico";
                            $resultado = mysqli_query($conexion, $result);

                            while ($row_func = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='event-important'>" . $row_func['tipNome'] . "</option>";
                            }
                            ?>

                        </select>

                        <br>

                        <!-- MOSTRA FUNCIONARIOS -->
                        <label for="tipo">Funcionario</label>
                        <select class="form-control" name="funcionario" id="tipo">
                            <?php
                            $resultPessoa = "SELECT * FROM trabalhosalao.pessoa";
                            $resultadoP = mysqli_query($conexion, $resultPessoa);


                            while ($row_func = mysqli_fetch_assoc($resultadoP)) {

                                // Verifica se são funcionarios
                                $pessoa_id = $row_func['pesId'];
                                $consulta = mysqli_query($conexion, "SELECT * FROM funcionario WHERE funPes_id = '$pessoa_id' limit 1");


                                if (mysqli_num_rows($consulta) > 0) { // entra
                                    echo "<option value='event-info'>" . $row_func['pesNome'] . "</option>";
                                }
                            }
                            ?>

                        </select>

                        <br>

                        <label for="body">Evento</label>
                        <textarea id="body" name="event" required class="form-control" rows="3"></textarea>

                        <script type="text/javascript">
                            $(function() {
                                $('#from').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });
                                $('#to').datetimepicker({
                                    language: 'es',
                                    minDate: new Date()
                                });

                            });
                        </script>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>