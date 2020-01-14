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

    
    <div class="col-sm-6">
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

