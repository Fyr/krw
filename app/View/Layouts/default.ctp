<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="yandex-verification" content="cf3acff5b41c22d8" />
	<title>KingsRoad wiki</title>
<?
	echo $this->Html->charset();
	echo $this->Html->meta('icon');
	echo $this->Html->css(array(
		'fonts',
		'tinyslider',
		'custom',
		'extra'
	));

	$js = array(
		'vendor/tinyslider.chunk',
		'vendor/sticky.chunk',
		'vendor/jquery/jquery-1.10.2.min',
		'custom'
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
			<div class="header">
				<ul class="smallMenu menu">
					<li><a href="/">Главная</a></li>
					<li><a href="<?=$this->Html->url(array('controller' => 'pages', 'action' => 'about'))?>">О проекте</a></li>
					<li><a href="#">Контакты</a></li>
				</ul>
				<!--ul class="smallMenu languages">
					<li><a href="#">RU</a></li>
					<li><a href="#">EN</a></li>
				</ul-->
			</div>
	
			<div class="slider">
				<div class="item" style="background-image: url('/img/temp/promo.png')"></div>
			</div>
	
			<div class="mobileContainer">
				<div class="mobileMenuButton">Menu</div>
				<div class="logoMenu" data-sticky data-sticky-wrap>
					<div class="logoMenuInner">
						<a href="/" class="logo" title="Перейти на главную страниицу">
							<img src="/img/logo.png" alt="Перейти на главную страниицу" />
						</a>
						<?=$this->element('menu')?>
					</div>
				</div>
			</div>

			<div class="content">
				<div class="sidebar">
					<?=$this->element('categories')?>
					<div class="subSection">
						<div class="block">
							<h2><a href="#">Subsection with title1</a></h2>
							<div class="frame leftImg">
								<img src="https://gmbay.ru/media/screenshots/castlot-screenshot-16.jpg?mode=pad&w=1024&h=700" alt=""  />
							</div>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							<div class="more"><a href="#">Подробнее</a></div>
						</div>
						<div class="block">
							<h2><a href="#">Subsection with title2</a></h2>
							<div class="frame leftImg">
								<img src="https://gmbay.ru/media/screenshots/castlot-screenshot-16.jpg?mode=pad&w=1024&h=700" alt=""  />
							</div>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							<div class="more"><a href="#">Подробнее</a></div>
						</div>
					</div>
				</div>
				<div class="textBlock">
					<div class="block">
						<?=$this->fetch('content')?>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<div class="footer">
				<a href="#" class="logo">
					<img src="/img/logo.png" alt="" />
				</a>
				<div class="centerMenus">
					<ul class="smallMenu">
						<li><a href="#">Главная</a></li>
						<li><a href="#">Wiki</a></li>
						<li><a href="#">Игрокам</a></li>
						<li><a href="#">Биржа</a></li>
						<li><a href="#">Галерея</a></li>
					</ul>
					<ul class="smallMenu subMenu">
						<li><a href="#">О проекте</a></li>
						<li><a href="#">Контакты</a></li>
						<li><a href="#">Отказ от прав</a></li>
					</ul>
				</div>
				<div class="developmentBy">Разработка сайта:<br /><a href="#">phppainkiller.ru</a></div>
			</div>
		</div>
	</div>
</body>
</html>