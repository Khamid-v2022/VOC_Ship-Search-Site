<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VOC</title>
	<link href="<?=base_url()?>assets/plugin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>assets/plugin/css/components.min.css" rel="stylesheet" type="text/css">

	<!-- Core JS files -->
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/core/app.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/forms/selects/select2.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?=base_url()?>assets/plugin/js/plugins/pickers/pickadate/picker.js"></script>
	<script src="<?=base_url()?>assets/plugin/js/plugins/pickers/pickadate/picker.date.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>assets/plugin/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript">
		var SITE_URL = "<?=site_url()?>";
    	var BASE_URL = "<?=base_url()?>";
	</script>

	<link href="<?=base_url()?>assets/css/user_side.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="pace pace-inactive">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
		  <div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?=site_url()?>">
					<img src="<?=base_url()?>assets/img/logo_main_white.png" alt="">
				</a>

				<ul class="nav navbar-nav visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-paragraph-justify3"></i></a></li>
				</ul>
			</div>

			<div class="navbar-collapse collapse" id="navbar-mobile">

				<ul class="nav navbar-nav navbar-right">
					<li class='<?=$primary_menu=="About Me"?"active":""?>'>
						<a href="<?=site_url()?>">About Me</a>
					</li>
					<li class='<?=$primary_menu=="Search Ships"?"active":""?>'>
						<a href="<?=site_url()?>searchships" >Search Ships</a>
					</li>
					<li class='<?=$primary_menu=="Search Voayges"?"active":""?>'>
						<a href="<?=site_url()?>searchvoyages" >Search Voyages</a>
					</li>
					<li>
						<a href="#" >Bibliography and Sources</a>
					</li>
					<li>
						<a href="https://voc.1-2-3.live/forum" target="_black">Forum </a>
					</li>
				</ul>
			</div>
		</div>
	</div>
