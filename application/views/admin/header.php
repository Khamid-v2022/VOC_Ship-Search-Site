<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ships</title>

	<!-- Global stylesheets -->
	<link href="<?=base_url()?>assets/plugin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/app.min.js"></script>

	<script type="text/javascript">
		var SITE_URL = "<?=site_url()?>";
    	var BASE_URL = "<?=base_url()?>";
	</script>

	<!-- custom -->
	<script type="text/javascript" src="<?=base_url()?>assets/js/global.js"></script>
	<link href="<?=base_url()?>assets/css/main_layout.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		$(function() {
			$('#change_password_modal').on('hidden.bs.modal', function() {
			    $(this).find('form').trigger('reset');
			});

			$('#change_profile_modal').on('hidden.bs.modal', function() {
			    $(this).find('form').trigger('reset');
			});
		});

		function change_admin_password(id){
			var old_pass = $("#old_pass").val();
			var new_pass = $("#new_pass").val();
			var confirm_pass = $("#confirm_pass").val();
			if(!old_pass){
				swal({
					title: "Please enter the currenct password",
		            text: "",
		            type: "warning"}, function(){
		            	setTimeout(function(){
		            		$("#old_pass").focus();
		            	}, 100);
		            });
				return;
			}

			if(!new_pass || !confirm_pass || new_pass != confirm_pass){
				swal({
					title: "Please check the inputed value",
		            text: "",
		            type: "warning"});
				return;
			}

			$.post(SITE_URL + 'admin/login/update_password', 
				{
					id: id,
					old_pass: old_pass,
					new_pass: new_pass
				}, 
				function(resp){
					if(resp=="yes"){
						swal({
							title: "Updated",
				            text: "",
				            type: "success"},function(){
				            	$('#change_password_modal').modal('toggle');
				        });
					}else{
						swal({
							title: "Please check your current password",
				            text: "",
				            type: "warning"});
						return;
					}
			});
		}

		function change_admin_profile(){
			var email = $("#m_email").val();
			if(email == ""){
				swal({
					title: "Please enter the email",
		            text: "",
		            type: "error"}, function(){
		            	setTimeout(function(){
		            		$("#m_email").focus();
		            	}, 100);
		            });
				return;
			}

			$.post(SITE_URL + 'admin/login/update_profile', 
				{
					email: email
				}, 
				function(resp){
					if(resp=="yes"){
						swal({
							title: "Updated",
				            text: "",
				            type: "success"},function(){
				            	location.reload();
				        });
					}else if(resp=="no"){
						swal({
							title: "Please enter the another name",
				            text: "",
				            type: "error"});
					}
			});
		}

	</script>
</head>

<body>
	<?php 
		if(isset($this->session->admin_data)) {
	?>
	<!-- change password modal -->
	<div id="change_password_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Password</h5>
				</div>

				<form action="#" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group has-feedback">
							<label class="control-label col-sm-3">Current password: </label>
							<div class="col-sm-9">
								<input type="password" placeholder="Please enter the current password" class="form-control" id="old_pass">
								<div class="form-control-feedback">
									<i class="icon-unlocked2 text-muted"></i>
								</div>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label class="control-label col-sm-3">New password: </label>
							<div class="col-sm-9">
								<input type="password" placeholder="new password" class="form-control" id="new_pass">
								<div class="form-control-feedback">
									<i class="icon-lock text-muted"></i>
								</div>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="control-label col-sm-3">Confirm password: </label>
							<div class="col-sm-9">
								<input type="password" placeholder="Confirm password" class="form-control" id="confirm_pass">
								<div class="form-control-feedback">
									<i class="icon-lock text-muted"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer text-center">
						<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>					
						<button type="button" class="btn btn-primary" onclick="change_admin_password(<?=$this->session->admin_data['id']?>)">Change <i class="icon-sync"></i></button>			
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="change_profile_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Profile</h5>
				</div>

				<form action="#" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group has-feedback">
							<label class="control-label col-sm-3">Email: </label>
							<div class="col-sm-9">
								<input type="email" placeholder="Email" class="form-control" id="m_email" value="<?=$this->session->admin_data['email']?>" required>
								<div class="form-control-feedback">
									<i class="icon-envelop2 text-muted"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer text-center">
						<button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" onclick="change_admin_profile()">Change <i class="icon-sync"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>


	<?php if(isset($this->session->admin_data)) { ?>
		<!-- Main navbar -->
		<div class="navbar navbar-inverse navbar-primary">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?=site_url()?>admin"><img src="<?=base_url()?>assets/img/logo_main_white.png" alt=""></a>

				
				<ul class="nav navbar-nav pull-right visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				</ul>
			</div>
			
			<div class="navbar-collapse collapse" id="navbar-mobile">
				<?php if(isset($primary_menu)) {?>
					<ul class="nav navbar-nav">
						<li class="<?php if($primary_menu == 'Ships') echo 'active'?>">
							<a href="<?=site_url()?>admin/ships">
								<span>Ships</span>
							</a>
						</li>
						<li class="<?php if($primary_menu == 'Search Ships') echo 'active'?>">
							<a href="<?=site_url()?>admin/search_ships">
								<span>Search Ships</span>
							</a>
						</li>
						<li class="<?php if($primary_menu == 'Search Voyages') echo 'active'?>">
							<a href="<?=site_url()?>admin/search_voyages">
								<span>Search Voyages</span>
							</a>
						</li>
					</ul>
				<?php }?>
				<ul class="nav navbar-nav navbar-right">						
					<li class="dropdown dropdown-user">					
						<a class="dropdown-toggle" data-toggle="dropdown">
							<span style="font-size: 18px">Admin</span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a data-toggle="modal" data-target="#change_profile_modal"><i class="icon-profile"></i> Profile</a></li>
							<li><a data-toggle="modal" data-target="#change_password_modal"><i class="icon-lock5"></i> Change password</a></li>
							<li><a href="<?=site_url()?>admin/login/sign_out"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	<?php }?>
	
	<?php if(isset($this->session->admin_data) && isset($primary_menu)) {?>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h1><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=$primary_menu?></span></h1>
						</div>

					</div>					
				</div>
				<!-- /page header -->
				<?php }?>


