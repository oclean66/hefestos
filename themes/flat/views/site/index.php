<style>
    #main{
        margin-left: 0px;
    }   
    #left{
        display: none;
    }
</style>
<?php
if (Yii::app()->user->isGuest)
    $this->redirect('cruge/ui/login');
?>
<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>
<div class="page-header">
    <div class="pull-left">
        <ul class="minitiles">
            <li class="">
                <img style="width: 190px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/brand.png">
            </li>
           
        </ul>

    </div>
    <div class="pull-right">

        <ul class="stats">

            <li class="lightred">
                <i class="fa fa-calendar"></i>
                <div class="details">
                    <span class="big"><?php echo date('j \d\e M Y'); ?></span>
                    <span><?php echo date('l, h:ia'); ?></span>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--Logo de dashbord-->
<div> 

    
    <div class="col-sm-12">
        <ul class="tiles">


 


            <li class="blue long">
                <a href="#">
                    <span class="nopadding">
                        <h5>@oclean66</h5>
                        <p>Bienvenido, Tenemos nuevas actualizaciones</p>
                    </span>
                    <span class="name">
                        <i class="fa fa-twitter"></i>
                        <span class="right">09/01/2020</span>
                    </span>
                </a>
            </li>

            <li class="orange "> 
        <a target="_blank" href="<?php echo Yii::app()->createUrl('gcca/admin');?>">
                <span class="count">
                    <i class="fa fa-home"></i> </span>
                <span class="name">Agencias</span>
            </a>
        </li>

        <!-- <li class="pink ">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/admin');?>">
                <span class="count">
                    <i class="fa fa-print"></i> </span>
                <span class="name">Activos</span>
            </a>
        </li> -->

        <li class="darkblue ">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fccu/add');?>">
                <span class="count">
                    <i class="fa fa-star"></i> </span>
                <span class="name">Agregar Activo</span>
            </a>
        </li>

        <li class="lime">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/create');?>">
                <span class="count">
                    <i class="fa fa-plus-square"></i> </span>
                <span class="name">Asignar Activo</span>
            </a>
        </li>

        <li class="red">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/less');?>">
                <span class="count">
                    <i class="fa fa-minus-square"></i> </span>
                <span class="name">Recibir Activo</span>
            </a>
        </li>


        
        <li class="teal ">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/admin');?>">
                <span class="count">
                <i class="fa fa-sitemap"></i> </span>
                <span class="name">Arbol</span>
            </a>
        </li>


        <li class="green ">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/report.html?FCCN_Id=2');?>">
                <span class="count">
                <i class="fa fa-sign-in"></i> </span>
                <span class="name">Entradas</span>
            </a>
        </li>
        <li class="blue ">
            <a target="_blank" href="<?php echo Yii::app()->createUrl('fcco/report.html?FCCN_Id=1');?>">
                <span class="count">
                <i class="fa fa-sign-out"></i> </span>
                <span class="name">Salidas</span>
            </a>
        </li>

        
        




        </ul>
    </div>

</div>

<script id="source" language="javascript" type="text/javascript">

    setInterval(function () {
        $.ajax({
            url: '/hocitem/site/log', //the script to call to get data          
            data: "", //you can insert url argumnets here to pass to api.php
            //for example "id=5&parent=6"
            dataType: 'json', //data format      
            success: function (data)          //on recieve of reply
            {
                $.each(data, function (id, value) {
                    console.log(value.value); // 15
                    $('#myrandomFeed').find('tbody').prepend("<tr><td><span class='label label-warning'><i class='fa fa-comment'></i></span> " + value.value + "</td></tr>");

                });


//                var id = data[0];              //get id
//                var vname = data[1];           //get name
//
//                $('#output').html("<b>id: </b>" + id + "<b> name: </b>" + vname); //Set output element html
//                $('#randomFeed').find('tbody').prepend("<tr><td><span class='label label-warning'><i class='fa fa-comment'></i></span> 	<a href='#'>" + id + "</a> commented on <a href='#'>" + vname + "</a></td></tr>");

            }
        });
    }, 5000); //5 seconds


</script>

