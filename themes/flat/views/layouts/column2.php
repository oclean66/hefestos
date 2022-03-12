<?php $this->beginContent('//layouts/main'); ?>
<?php if (!empty($this->menu)) { ?>

    <div id="left" class="sidebar-fixed" style="z-index:50">
        <?php if (!empty($this->index)) { ?>
            <div class="subnav">
                <?php $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'subnav-menu'),
                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                    'encodeLabel' => false,
                    'items' => $this->index
                ));
                ?>
            </div>
        <?php } ?>
        <div class="subnav">
            <div class="subnav-title">
                <!-- <a href="#" class='subnav'> -->                    
                    <span><?php echo $this->menuTitle;?></span>
                <!-- </a> -->
            </div>
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'subnav-menu'),
                'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                'encodeLabel' => false,
                'items' => $this->menu
            ));

            if (!empty($this->widget)) {
            ?>

                <div class="subnav-title">
                    <a id="mio" href="#" class='toggle-subnav'>
                        <i class="fa fa-angle-down"></i>
                        <span>Estadisticas Rapidas</span>
                    </a>
                </div>

                <ul class="quickstats" id="my">
                    <?php
                    foreach ($this->widget as $value) {
                        echo ' <li>
                                    <span class="value">' . $value['data'] . '</span>
                                    <span class="name">' . $value['label'] . '</span>
                                    </li>';
                    }
                    ?>

                </ul>

            <?php } ?>

        </div>
    </div>
<?php
} else {
?>
    <style type="text/css">
        #main {
            margin-left: 0;
        }
    </style>
<?php } ?>
<div id="span9" class="span9" style="">
    <?php echo $content; ?>
</div>
<!--/span-->
<?php $this->endContent(); ?>