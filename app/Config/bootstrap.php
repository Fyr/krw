<?php
define('TEST_ENV', $_SERVER['SERVER_ADDR'] == '192.168.1.22');

Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
// Configure::write('Exception.renderer', 'SiteExceptionRenderer');
Configure::write('Config.langs', array('eng' => 'EN', 'rus' => 'RU'));
// Configure::write('Config.language', 'rus');

/*
// Values from google recaptcha account
define('RECAPTCHA_PUBLIC_KEY', '6Lezy-QSAAAAAJ_mJK5OTDYAvPEhU_l-EoBN7rxV');
define('RECAPTCHA_PRIVATE_KEY', '6Lezy-QSAAAAACCM1hh6ceRr445OYU_D_uA79UFZ');

Configure::write('Recaptcha.publicKey', RECAPTCHA_PUBLIC_KEY);
Configure::write('Recaptcha.privateKey', RECAPTCHA_PRIVATE_KEY);
*/
if (TEST_ENV) {
	Configure::write('domain', array(
		'url' => 'krwiki.loc',
		'title' => 'KRwiki.loc'
	));
} else {
	Configure::write('domain', array(
		'url' => 'krwiki.net',
		'title' => 'KRwiki.net'
	));
}

define('AUTH_ERROR', __('Invalid username or password, try again'));
define('EMAIL_ADMIN', 'fyr.work@gmail.com');
define('EMAIL_ADMIN_CC', 'fyr.work@gmail.com');

define('PATH_FILES_UPLOAD', WWW_ROOT.'files'.DS);

CakePlugin::loadAll();

function fdebug($data, $logFile = 'tmp.log', $lAppend = true) {
		file_put_contents($logFile, mb_convert_encoding(print_r($data, true), 'cp1251', 'utf8'), ($lAppend) ? FILE_APPEND : null);
}