<!doctype html>
<html>
	<head>
		<title>Zentric</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="http://cdn.zentric.es/img/favicon.ico" type="image/x-icon">		
		<link rel="stylesheet" href="<?php echo MY_CSS ?>">
	</head>

	<body class="header-fixed footer-fixed">

		<header class="fixed">
			<div class="container flex">				
				<a class="brand" href="<?php echo HOME ?>">Zentric</a>
				<?php $this->nav() ?>
				<i class="toggler fa fa-bars" data-target-id="nav-main"></i>
			</div>
		</header>

		<main><div class="container">
			<?php $this->main() ?>						
		</div></main>

		
		<?php $this->runinfo()?>
		

		<footer class="fixed"><div class="container flex">
			<span>&nbsp;</span>
			<button class="no-border toggler transparent"
				title="Show-Hide contextual information" 
				data-target-id="panel-info-context"> 
				<i class="fa fa-info-circle fa-3"></i>
			</button>				
		</div></footer>

		<script src="<?php echo MY_JS ?>"></script>
		<?php $this->javascript() ?>

	</body

</html>