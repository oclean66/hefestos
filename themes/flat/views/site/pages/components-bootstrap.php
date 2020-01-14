
		
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Bootstrap elements</h1>
					</div>
					<div class="pull-right">
						<ul class="minitiles">
							<li class='grey'>
								<a href="#">
									<i class="fa fa-cogs"></i>
								</a>
							</li>
							<li class='lightgrey'>
								<a href="#">
									<i class="fa fa-globe"></i>
								</a>
							</li>
						</ul>
						<ul class="stats">
							<li class='satgreen'>
								<i class="fa fa-money"></i>
								<div class="details">
									<span class="big">$324,12</span>
									<span>Balance</span>
								</div>
							</li>
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="more-login.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="components-messages.html">Components</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="components-bootstrap.html">Bootstrap elements</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-bars"></i>
									Bootstrap elements
								</h3>
							</div>
							<div class="box-content">
								<div class="row">
									<h4>Navs</h4>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<h6>Basic tabs</h6>
										<p>
											<ul class="nav nav-tabs">
												<li class="active">
													<a href="#">Home</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
												<li>
													<a href="#">Profile</a>
												</li>
											</ul>
										</p>
										<p>
											<ul class="nav nav-tabs">
												<li class="active">
													<a href="#">Home</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
												<li class='dropdown'>
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Action
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu">
														<li>
															<a href="#">Action 1</a>
														</li>
														<li>
															<a href="#">Action 2</a>
														</li>
														<li>
															<a href="#">Action 3</a>
														</li>
													</ul>
												</li>
											</ul>
										</p>
										<h6>Basic pills</h6>
										<p>
											<ul class="nav nav-pills">
												<li class="active">
													<a href="#">Home</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
												<li class='dropdown'>
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Action
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu">
														<li>
															<a href="#">Action 1</a>
														</li>
														<li>
															<a href="#">Action 2</a>
														</li>
														<li>
															<a href="#">Action 3</a>
														</li>
													</ul>
												</li>
											</ul>
										</p>
									</div>
									<div class="col-sm-6">
										<h6>Stacked nav</h6>
										<p>
											<ul class="nav nav-pills nav-stacked">
												<li class="active">
													<a href="#">Home</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
												<li>
													<a href="#">Profile</a>
												</li>
											</ul>
										</p>
									</div>
								</div>
								<div class="row">
									<h4>Navbar, breadcrumbs &amp; pagination</h4>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<h6>Navbar</h6>
										<nav class="navbar navbar-default" role="navigation">
											<div class="container-fluid">
												<!-- Brand and toggle get grouped for better mobile display -->
												<div class="navbar-header">
													<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
														<span class="sr-only">Toggle navigation</span>
														<span class="icon-bar"></span>
														<span class="icon-bar"></span>
														<span class="icon-bar"></span>
													</button>
													<a class="navbar-brand" href="#">Brand</a>
												</div>

												<!-- Collect the nav links, forms, and other content for toggling -->
												<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
													<ul class="nav navbar-nav">
														<li class="active">
															<a href="#">Link</a>
														</li>
														<li>
															<a href="#">Link</a>
														</li>
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
																<b class="caret"></b>
															</a>
															<ul class="dropdown-menu">
																<li>
																	<a href="#">Action</a>
																</li>
																<li>
																	<a href="#">Another action</a>
																</li>
																<li>
																	<a href="#">Something else here</a>
																</li>
																<li class="divider"></li>
																<li>
																	<a href="#">Separated link</a>
																</li>
																<li class="divider"></li>
																<li>
																	<a href="#">One more separated link</a>
																</li>
															</ul>
														</li>
													</ul>
													<form class="navbar-form navbar-left" role="search">
														<div class="form-group">
															<input type="text" class="form-control" placeholder="Search">
														</div>
														<button type="submit" class="btn btn-default">Submit</button>
													</form>
												</div>
												<!-- /.navbar-collapse -->
											</div>
											<!-- /.container-fluid -->
										</nav>
									</div>
									<div class="col-sm-4">
										<h6>Breadcrumbs</h6>
										<ol class="breadcrumb">
											<li>
												<a href="#">Home</a>
											</li>
											<li class="active">Data</li>
										</ol>
										<ol class="breadcrumb">
											<li>
												<a href="#">Home</a>
											</li>
											<li>
												<a href="#">Library</a>
											</li>
											<li class="active">Data</li>
										</ol>
									</div>
									<div class="col-sm-4">
										<h6>Pagination</h6>
										<div>
											<ul class='pagination'>
												<li>
													<a href="#">Prev</a>
												</li>
												<li>
													<a href="#">1</a>
												</li>
												<li>
													<a href="#">2</a>
												</li>
												<li>
													<a href="#">3</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
											</ul>
										</div>
										<div>
											<ul class='pagination pagination-lg'>
												<li>
													<a href="#">Prev</a>
												</li>
												<li>
													<a href="#">1</a>
												</li>
												<li>
													<a href="#">2</a>
												</li>
												<li>
													<a href="#">3</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
											</ul>
										</div>
										<div>
											<ul class='pagination pagination-sm'>
												<li>
													<a href="#">Prev</a>
												</li>
												<li>
													<a href="#">1</a>
												</li>
												<li>
													<a href="#">2</a>
												</li>
												<li>
													<a href="#">3</a>
												</li>
												<li>
													<a href="#">Next</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<h4>Alerts, badges &amp; progress</h4>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<h6>Alerts</h6>
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Warning!</strong>Best check yo self, you're not looking too good.
										</div>
										<div class="alert alert-info alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Warning!</strong>Best check yo self, you're not looking too good.
										</div>
										<div class="alert alert-warning alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Warning!</strong>Best check yo self, you're not looking too good.
										</div>
										<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Warning!</strong>Best check yo self, you're not looking too good.
										</div>
									</div>
									<div class="col-sm-4">
										<h6>Badges</h6>
										<span class="badge">12</span>
										<h6>Labels</h6>
										<span class="label label-default">Default</span>
										<span class="label label-info">info</span>
										<span class="label label-success">success</span>
										<span class="label label-warning">warning</span>
										<span class="label label-danger">danger</span>
									</div>
									<div class="col-sm-4">
										<h6>Progress bars</h6>
										<div class="progress">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
												<span class="sr-only">40% Complete (success)</span>
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
												<span class="sr-only">20% Complete</span>
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
												<span class="sr-only">60% Complete (warning)</span>
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
												<span class="sr-only">80% Complete</span>
											</div>
										</div>
										<div class="progress progress-striped">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
												<span class="sr-only">40% Complete (success)</span>
											</div>
										</div>
										<div class="progress progress-striped">
											<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
												<span class="sr-only">20% Complete</span>
											</div>
										</div>
										<div class="progress progress-striped">
											<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
												<span class="sr-only">60% Complete (warning)</span>
											</div>
										</div>
										<div class="progress progress-striped">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
												<span class="sr-only">80% Complete (danger)</span>
											</div>
										</div>
										<div class="progress progress-striped active">
											<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
												<span class="sr-only">45% Complete</span>
											</div>
										</div>
										<div class="progress">
											<div class="progress-bar progress-bar-success" style="width: 35%">
												<span class="sr-only">35% Complete (success)</span>
											</div>
											<div class="progress-bar progress-bar-warning" style="width: 20%">
												<span class="sr-only">20% Complete (warning)</span>
											</div>
											<div class="progress-bar progress-bar-danger" style="width: 10%">
												<span class="sr-only">10% Complete (danger)</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
	