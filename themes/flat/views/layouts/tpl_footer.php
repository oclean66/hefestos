
<div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="min-height: 25px;">
    <div class="container">
        <?php
        // setlocale(LC_TIME, 'es_ES.UTF-8');/

        // echo  date('d M, h:ia'); 
        // echo strftime ("%A, %d %b %Y - %I:%M %p", strtotime(date("Y-m-d H:i")));
        // echo date("D, d M Y - h:i a",strtotime(date("Y-m-d H:i").' -4 hours'));
        echo Yii::app()->locale->dateFormatter->format("EEEE, d MMM yyyy - hh:mma",date("Y-m-d H:i"));

        echo ' ';
        echo Yii::app()->timeZone;
        ?>
    </div>
</div>