<html>
<head>
	<title></title>

	<link rel="stylesheet" href="<?php echo asset('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo asset('bower_components/fontawesome/css/font-awesome.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo asset('bower_components/bs-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo asset('assets/css/style.css') ?>" />
	<script type="text/javascript" src="<?php echo asset('bower_components/jquery/dist/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/moment/min/moment.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/bs-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/tinymce/tinymce.min.js') ?>"></script>
	<script type="text/javascript">
		var server_url = '<?php echo url(''); ?>';
	</script>
</head>
<body>
	<div id="header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><strong>PT. PAS</strong></a>
				</div>
				<!-- navbar-header -->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo url('client') ?>">Klien</a></li>
						<li><a href="<?php echo url('company') ?>">Perusahaan</a></li>
						<li><a href="<?php echo url('product') ?>">Alat</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">Dokumen <i class="caret"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo url('invoice') ?>">Invoice</a></li>
								<li><a href="<?php echo url('kwitansi') ?>">Kwitansi</a></li>
								<li><a href="<?php echo url('receipt') ?>">Tanda Terima</a></li>
								<li><a href="<?php echo url('contract') ?>">Kontrak</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">Report <i class="caret"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo url('report/total-station') ?>">Report Total Station</a></li>
								<li><a href="<?php echo url('report/theodolite') ?>">Report Theodolite</a></li>
								<li><a href="<?php echo url('report/automatic-level') ?>">Report Automatic Level</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<!-- header -->
	<div id="content">
		<div class="container">
			<?php 
				if(isset($errors) && $errors->getbag('default')->count()){
					echo '<pre style="padding:10px; border:#ddd solid 1px; background:#eee; color:#999;">';
					print_r($errors->getbag('default')->getMessage());
					echo '</pre>';
				}

				echo Notification::container();
			?>
			<?php include(app_path().'/views/'.$content.'.php'); ?>
		</div>
	</div>
	<!-- content -->
	<div id="footer"></div>
	<!-- footer -->
	<script type="text/javascript" src="<?php echo asset('assets/js/functions.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('assets/js/script.js') ?>"></script>
</body>
</html>