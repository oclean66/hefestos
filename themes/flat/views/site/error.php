
<div class="wrapper">
    <div class="code">
        <span><?php echo $code?></span>
        <i class="fa fa-warning"></i>
    </div>
    <div class="desc"><?php echo $code=='401'?"Ud no tiene permisos para ".CHtml::encode(CrugeTranslator::t('classes',$message)):"Algo salio mal... Pero ya estamos trabajando para arreglarlo ".$message;?></div>
    <form action="http://www.eakroko.de/flat/more-searchresults.html" class='form-horizontal'>
        <div class="input-group" style="    padding: 2px 2px;">
            <input type="text" name="search" placeholder="Buscar.." class='form-control'>
            <span class="input-group-btn">
                <button type='submit' class='btn'>
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <div class="buttons">
        <div class="pull-left">
            <a href="index.html" class="btn">
                <i class="fa fa-arrow-left"></i>Atrás</a>
        </div>
         <div class="pull-right">
            <a href="/hocitem/cruge/ui/login" class="btn">
                Iniciar Sesion<i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>
