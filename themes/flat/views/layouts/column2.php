<?php $this->beginContent('//layouts/main'); ?>
<?php if (!empty($this->menu)) { ?>

    <div id="left"  class="sidebar-fixed">
        <form action="/search-results.html" method="GET" class='search-form'>
            <div class="search-pane">
                <input type="text" name="search" placeholder="Buscar aqui...">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        <div class="subnav">
            <div class="subnav-title">
                <a href="#" class='toggle-subnav'>
                    <i class="fa fa-angle-down"></i>
                    <span>Operaciones</span>
                </a>
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
                                    <span class="value">'.$value['data'].'</span>
                                    <span class="name">'.$value['label'].'</span>
                                    </li>';
                            }
                            ?>
                           
                        </ul>
                   
                
    <?php } ?>

        </div>
        <br>

    </div>
    <?php
} else {
    ?>
    <style type="text/css">
        #main{
            margin-left: 0;
        }

    </style>
    <?php } ?>
<div id="span9" class="span9" style="">
<?php echo $content; ?>
</div><!--/span-->
<?php $this->endContent(); ?>

