<html>
	<head>
		<title><?=( isset( $title ) ) ? $title : 'Grow'?></title>
		
		<meta charset="utf-8" />

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/redmond/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		
		<script src="<?=base_url('assets/js/jquery.flip.js')?>"></script>
		<script src="<?=base_url('assets/js/custom.js')?>"></script>
		
		<!-- Charts -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		<!-- Fancybox -->
		<script type="text/javascript" src="<?=base_url('assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/fancybox/source/jquery.fancybox.js?v=2.1.5')?>"></script>
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/fancybox/source/jquery.fancybox.css?v=2.1.5')?>" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7')?>" />
		<script type="text/javascript" src="<?=base_url('assets/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7')?>"></script>
		
		<link rel="stylesheet" href="<?=base_url('assets/css.css')?>" />

		<script type="text/javascript">

			var baseurl = '<?=base_url()?>';

			$(function() {
				$( "#datepicker" ).datepicker();
			});
			
			$(document).ready(function()
			{
				$(".fancybox").fancybox();
			});

		</script>
	</head>
	<body>
		<?
		if ( !isset($show_menu) || $show_menu == true )
		{
			?>
			<header>
				<img src="<?=base_url('assets/img/grow-logo.png')?>" class="logo" />
				<span>GROW</span>
				<ul class="usuario_menu">
					<li><?=$login->email?></li>
					<li class="division">|</li>
					<li><a href="<?=base_url('index.php/registro/logout')?>">Logout</a></li>
				</ul>
			</header>
			<?
		}