<?php
/* @var $this FcucController */
/* @var $model Fcuc */

$this->breadcrumbs = array(
    'Fcucs' => array('index'),
    'Create',
);

$this->menu = array(
    //array('label'=>'List Fcuc', 'url'=>array('index')),
    array('label' => 'Administrar Fcuc', 'url' => array('admin')),
);
?>

<!--- <h1>Create Fcuc</h1>-->

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>