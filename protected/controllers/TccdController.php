<?php

class TccdController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		// $this->render('view',array(
		// 	'model'=>$this->loadModel($id),
		// ));
		$model = $this->loadModel($id);
		echo CJSON::encode(
			array($model,
			'<div class="row">					
				<div class="col-sm-10">
					<h4 class="modal-title" id="myModalLabel">
						<a href="#" class="listTitle" data-placement="right">Modal title</a>
					</h4>

					<span>En la Lista Pendientes</span>
					<br/>
					<h5 style="margin-top:0">Descripcion</h5>
					<p 
						class="listTitle" 
						data-placement="bottom" 
						id="TCCA_Name" 
						style="padding: 10px; background-color: rgb(238, 238, 238);border-radius: 5px;font-weight: bolder;"
						data-type="textarea" 
						
						data-original-title="Nombre del Tablero">Lorem ipsum anim ad culpa ex id anim Excepteur esse et do cillum dolor in dolore cillum. Lorem ipsum Ut est consequat pariatur sint ut incididunt nisi dolore occaecat.</p>


					<div class="box box-color box-bordered lightgrey">
						<div class="box-title" style="margin-top:0px;">
							<h3><i class="fa fa-check"></i>Tareas</h3>
							<div class="actions">
								<a href="#new-task" data-toggle="modal" class="btn btn-mini">
									<i class="fa fa-plus-circle"></i> Nueva Tarea</a>
							</div>
						</div>
						<div class="box-content nopadding">
							<ul class="tasklist ui-sortable">
								

								<li class="bookmarked">
									<div class="check">
										<div class="icheckbox_square-blue" >
											<!-- <input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> -->
											<input tabindex="1" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" id="input-1">
											<label for="this" style="display:none;"> </label>
											<!-- <ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins> -->
										</div>
									</div>
									<span class="task">
										<!-- <i class="fa fa-bar-chart-o"></i> -->
										<span>Check statistics</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<!-- <a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-empty"></i>
										</a> -->
									</span>
								</li>

								<li>
									<div class="check">
										<div class="icheckbox_square-blue" >
											<!-- <input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> -->
											<input tabindex="1" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" id="input-1">
											<label for="this" style="display:none;"> </label>
											<!-- <ins style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins> -->
										</div>
									</div>
									<span class="task">
										<i class="fa fa-bar-chart-o"></i>
										<span>Check statistics</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<!-- <a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-empty"></i>
										</a> -->
									</span>
								</li>

								<li class="done">
									<div class="check">
										<div class="icheckbox_square-blue checked" >
										<!-- <input type="checkbox" class="icheck-me" data-skin="square" data-color="blue"  style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"> -->
										<input tabindex="1" type="checkbox" data-skin="square" data-color="blue"  class="icheck-me" id="input-1">

										<label for="this" style="display:none;"> </label>

										
										</div>
									</div>
									<span class="task">
										<i class="fa fa-envelope"></i>
										<span>Check for new mails</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-o"></i>
										</a>
									</span>
								</li>
								<!-- <li>
									<div class="check">
										<div class="icheckbox_square-blue" style="position: relative;">
											<input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
											
											<label for="this" style="display:none;"> </label>

										</div>
									</div>
									<span class="task">
										<i class="fa fa-comment"></i>
										<span>Chat with John Doe</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-o"></i>
										</a>
									</span>
								</li>
								<li>
									<div class="check">
										<div class="icheckbox_square-blue" style="position: relative;">
											<input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
											<label for="this" style="display:none;"> </label>

										</div>
									</div>
									<span class="task">
										<i class="fa fa-retweet"></i>
										<span>Go and tweet some stuff</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-o"></i>
										</a>
									</span>
								</li>
								<li>
									<div class="check">
										<div class="icheckbox_square-blue" style="position: relative;">
										<input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
										<label for="this" style="display:none;"> </label>

										</div>
									</div>
									<span class="task">
										<i class="fa fa-edit"></i>
										<span>Write an article</span>
									</span>
									<span class="task-actions">
										<a href="#" class="task-delete" rel="tooltip" title="" data-original-title="Delete that task">
											<i class="fa fa-times"></i>
										</a>
										<a href="#" class="task-bookmark" rel="tooltip" title="" data-original-title="Mark as important">
											<i class="fa fa-bookmark-o"></i>
										</a>
									</span>
								</li> -->
							</ul>
						</div>
					</div>

					<div class="box box-color box-bordered green">
						<div class="box-title">
							<h3>
								<i class="fa fa-bullhorn"></i> Actividad Reciente
							</h3>
							
						</div>
						<div class="box-content" style="padding:0">
							<table class="table table-nohead" id="">
								<tbody>
									<tr style="display: table-row;">
										<td>
											<span class="label label-info">
											<i class="fa fa-shopping-cart"></i>
											</span> New order received
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-warning">
												<i class="fa fa-comment"></i>
											</span> 
											<a href="#">John Doe</a> commented on <a href="#">News #123</a>
										</td>
									</tr>
								
									<tr style="display: table-row;">
										<td>
											<span class="label label-info">
												<i class="fa fa-shopping-cart"></i>
											</span> New order received
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-info">
											<i class="fa fa-shopping-cart"></i>
											</span> New order received
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span> 
											<a href="#">John Doe</a> commented on <a href="#">News #123</a>
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-default">
											<i class="fa fa-plus-square"></i></span> 
											<a href="#">John Doe</a> added a new photo
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-default">
											<i class="fa fa-plus-square"></i></span> 
											<a href="#">John Doe</a> added a new photo
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-default">
											<i class="fa fa-plus-square"></i></span> 
											<a href="#">John Doe</a> added a new photo
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span> 
											<a href="#">John Doe</a> commented on <a href="#">News #123</a>
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-success">
											<i class="fa fa-user"></i></span> New user registered</td></tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span> 
											<a href="#">John Doe</a> commented on <a href="#">News #123</a>
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span> 
											<a href="#">John Doe</a> commented on <a href="#">News #123</a>
										</td>
									</tr>
									<tr style="display: table-row;">
										<td>
										<span class="label label-success">
										<i class="fa fa-user"></i></span> New user registered</td></tr>
									<tr>
										<td>
											<span class="label label-default">
											<i class="fa fa-plus-square"></i></span>
											<a href="#">John Doe</a>added a new photo</td>
									</tr>
									<tr>
										<td>
											<span class="label label-success">
											<i class="fa fa-user"></i></span>New user registered</td>
									</tr>
									<tr>
										<td>
											<span class="label label-info">
											<i class="fa fa-shopping-cart"></i></span>New order received</td>
									</tr>
									<tr>
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span><a href="#">John Doe</a>commented on<a href="#">News #123</a>
										</td>
									</tr>
									<tr>
										<td>
											<span class="label label-success">
											<i class="fa fa-user"></i></span>New user registered</td>
									</tr>
									<tr>
										<td>
											<span class="label label-info">
											<i class="fa fa-shopping-cart"></i></span>New order received</td>
									</tr>
									<tr>
										<td>
											<span class="label label-warning">
											<i class="fa fa-comment"></i></span><a href="#">John Doe</a>commented on<a href="#">News #123</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>													
						
					</div>

				</div>

				<div class="col-sm-2">
				
					<h5>Content</h5>

					<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-block">Save changes</button>

					<h5>Content</h5>

					<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-block">Save changes</button>

				</div>	

			</div>'));
		// return $model;

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tccd;
		if(isset($_POST['name']) && $_POST['name']=='TCCA_New'){
			// print_r($_POST);
				// $model=new Tcca;
				$model->TCCD_Title = $_POST['value'];
				$model->TCCA_Id=$_POST['pk'];
				$model->TCCD_Order=Tccd::model()->count('TCCA_Id='.$_POST['pk']);
				// $model->TCCA_BoardId=$id;
				// $model->TCCA_Type=1;			

				if($model->save()){
					echo CJSON::encode(					
						array(
							'id'=>$model->TCCD_Id,
							'board'=>$model->TCCA_Id,
							'position'=>$model->TCCD_Order,
							'title'=>$model->TCCD_Title
						)
					);
					return $model;

			 }else{
				throw new CHttpException(404,'The requested page does not exist.');
			 }
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tccd']))
		{
			$model->attributes=$_POST['Tccd'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->TCCD_Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tccd']))
		{
			$model->attributes=$_POST['Tccd'];
			if(isset($_POST['Old'])){
				echo $_POST['Old'];
			}
			if($model->save())
				// $this->redirect(array('view','id'=>$model->TCCD_Id));
				print_r($model);
				echo "Updated";
		}
		// print_r($_POST);
		// $this->render('update',array(
		// 	'model'=>$model,
		// ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tccd');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tccd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tccd']))
			$model->attributes=$_GET['Tccd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Tccd the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Tccd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Tccd $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tccd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
