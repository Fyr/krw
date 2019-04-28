<?php
Router::parseExtensions('json', 'xml');
/*
Router::connectNamed(
    array('page' => '[\d]+'),
    array('default' => false, 'greedy' => false)
);
*/
Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
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

/*
Router::connect('/articles/:slug',
	array(
		'controller' => 'articles',
		'action' => 'view',
		'objectType' => 'SiteArticle'
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/articles/page/:page', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'SiteArticle'
));
Router::connect('/articles/', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'SiteArticle'
));
Router::connect('/articles', array(
	'controller' => 'Articles', 
	'action' => 'index',
	'objectType' => 'SiteArticle'
));
*/
/*
Router::connect('/gallery/:slug.html',
	array(
		'controller' => 'Articles',
		'action' => 'view',
		'objectType' => 'Gallery'
	),
	array(
		'pass' => array('slug')
	)
);
Router::connect('/gallery/page/:page', array(
	'controller' => 'Articles',
	'action' => 'index',
	'objectType' => 'Gallery'
));
Router::connect('/gallery/', array(
	'controller' => 'Articles',
	'action' => 'index',
	'objectType' => 'Gallery'
));
Router::connect('/gallery', array(
	'controller' => 'Articles',
	'action' => 'index',
	'objectType' => 'Gallery'
));
*/
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
/*
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
*/
CakePlugin::routes();

require CAKE.'Config'.DS.'routes.php';
