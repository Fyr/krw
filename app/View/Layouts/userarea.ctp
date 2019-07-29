<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="yandex-verification" content="cf3acff5b41c22d8" />
	<title>KingsRoad гайды, wiki и как в KingsRoad играть эффективнее</title>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
<?
	echo $this->Html->charset();
	echo $this->Html->meta('icon');
	echo $this->Html->css(array(
		'fonts',
		'tinyslider',
		'custom',
		'extra',
		'forms'
	));

	$js = array(
		'vendor/tinyslider.chunk',
		'vendor/sticky.chunk',
		'vendor/jquery/jquery-1.10.2.min',
		'vendor/jquery/jquery.cookie',
		'custom',
		'extra',
		'lang'
	);
	echo $this->Html->script($js);

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
</head>
<body>
	<div class="mobileWrapper">
		<div class="wrapper mainContent">

			<div class="mobileContainer">
				<div class="mobileMenuButton">Menu</div>
				<div class="logoMenu" data-sticky data-sticky-wrap>
					<div class="logoMenuInner">
						<a href="/" class="logo" title="<?=__('Go to Home page')?>">
							<img src="/img/logo.png" alt="KRwiki.net" />
						</a>
						<?=$this->element('menu')?>
					</div>
				</div>
			</div>
			<div class="header">
				<ul class="smallMenu menu">
					<li><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'dashboard'))?>"><?=__('Dashboard')?></a></li>
					<li><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'account'))?>"><?=__('Account')?></a></li>
					<li><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'profile'))?>"><?=__('Game profile')?></a></li>
					<li><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'snapshots'))?>"><?=__('Snapshots')?></a></li>
					<li><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'snapshots'))?>"><?=__('Guild stats')?></a></li>
				</ul>
				<ul class="smallMenu">
					<li class="menu">Welcome, <a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'dashboard'))?>"><?=$currUser['username']?></a></li>
					<li class="menu"><a href="<?=$this->Html->url(array('controller' => 'user', 'action' => 'logout'))?>"><?=__('Log out')?></a></li>
				</ul>
			</div>
	
			<div class="content">
				<div class="textBlock">
					<div class="block">
						<?=$this->fetch('content')?>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="footer">
				<a href="/" class="logo" title="<?=__('Go to Home page')?>">
					<img src="/img/logo.png" alt="KRwiki.net" />
				</a>
				<div class="centerMenus">
					<?=$this->element('footer')?>
				</div>
				<div class="developmentBy"><?=__('Web-site development')?>:<br /><a href="http://phppainkiller.ru" target="_blank">phppainkiller.ru</a></div>
			</div>
		</div>
	</div>
</body>
</html>