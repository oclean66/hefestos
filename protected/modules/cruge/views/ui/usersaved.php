<?php 
	// llamada cuando el actionEditProfile termina de guardar un usuario
?>
<div class='hero-unit'><hr />
        <div class="space"></div>
        <h3 style="text-align: center"><?php echo CrugeTranslator::t("Sus datos han sido guardados con exito!");?></h3>
        <hr />
        <div class="space"></div>
         <div class="row-fluid">
             <div class="center" style="text-align: center;">
                <?php
                echo CHtml::button('Volver', array('class' => 'btn btn-danger', 'onclick' => "history.go(-1)"));
                ?>&nbsp;&nbsp;<?php
                echo CHtml::button('Inicio', array('submit' => array('/site/index'), 'class' => 'btn btn-primary'));
                ?>
            </div>
        </div>
</div>