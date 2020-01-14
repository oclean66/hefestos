
<div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="min-height: 25px;">
    <div class="container">
        <?php
        setlocale(LC_TIME, 'es_ES.UTF-8');

        echo strftime("%A %d de %B del %Y %I:%M:%S %p"); // date('l jS \of F Y h:i:s A'); 
        echo ' ';
        echo Yii::app()->timeZone;
        ?>
    </div>
</div>