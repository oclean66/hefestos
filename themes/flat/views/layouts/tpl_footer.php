<div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="min-height: 25px;">
    <div class="container-fluid">
        <p class="navbar-text navbar-right" style='margin:0; padding:0;'>
            <?php
            // setlocale(LC_TIME, 'es_ES.UTF-8');/

            // echo  date('d M, h:ia'); 
            // echo strftime ("%A, %d %b %Y - %I:%M %p", strtotime(date("Y-m-d H:i")));
            // echo date("D, d M Y - h:i a",strtotime(date("Y-m-d H:i").' -4 hours'));
            echo " Tiempo de Espera: " . round(CLogger::getExecutionTime(), 2) . " Seg |";
            echo " Memoria: " . round(CLogger::getMemoryUsage() / 1048576, 2) . "MB | ";

            echo Yii::app()->locale->dateFormatter->format("EEEE, d MMM yyyy - hh:mma", date("Y-m-d H:i"));

            echo ' ';
            echo Yii::app()->timeZone;
            ?>
        </p>
    </div>
</div>