<?php
Router::parseExtensions('json', 'xml');
/*
Router::connectNamed(
    array('page' => '[\d]+'),
    array('default' => false, 'greedy' => false)
);
*/
Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
Router::connect('/updates', array('controller' => 'pages', 'action' => 'updates'));
Router::connect('/pages/inprogress', array('controller' => 'pages', 'action' => 'inprogress'));
Router::connect('/pages/:slug',
	array(
		'controller' => 'pages', 
		'action' => 'view',
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/wiki/:slug',
	array(
		'controller' => 'wiki',
		'action' => 'view',
		'objectType' => 'WikiArticle'
	),
	array(
		'pass' => array('slug')
	)
);

Router::connect('/articles', array(
	'controller' => 'Articles',
	'action' => 'index',
	'objectType' => 'SiteArticle',
),
	array('named' => array('page' => 1))
);
Router::connect('/articles/:slug',
	array(
		'controller' => 'Articles',
		'action' => 'view',
		'objectType' => 'SiteArticle'
	),
	array('pass' => array('slug'))
);
Router::connect('/articles/page/:page', array(
	'controller' => 'Articles',
	'action' => 'index',
	'objectType' => 'SiteArticle'
),
	array('named' => array('page' => '[\d]*'))
);

Router::connect('/gallery', array(
	'controller' => 'Gallery',
	'action' => 'index',
	'objectType' => 'GalleryArticle',
),
	array('named' => array('page' => 1))
);
Router::connect('/gallery/:slug',
	array(
		'controller' => 'Gallery',
		'action' => 'view',
		'objectType' => 'GalleryArticle'
	),
	array('pass' => array('slug'))
);
Router::connect('/gallery/page/:page', array(
	'controller' => 'Gallery',
	'action' => 'index',
	'objectType' => 'GalleryArticle'
),
	array('named' => array('page' => '[\d]*'))
);

/*
Router::connect('/news/:slug.html', 
	array(
		'controller' => 'Articles', 
		'action' => 'view',
		'objectType' => 'News'
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/news/page/:page', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'News'
));
Router::connect('/news/', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'News'
));
Router::connect('/news', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'News'
));
*/

CakePlugin::routes();

require CAKE.'Config'.DS.'routes.php';
