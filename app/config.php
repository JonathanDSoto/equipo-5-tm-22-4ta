<?php 
	session_start();

	if (!isset($_SESSION['global_token'])) {
		$_SESSION['global_token'] = md5( uniqid( mt_rand(),true ) );
	}

	if (!defined('BASE_PATH')) {
		define('BASE_PATH','http://localhost:8888/programacionavanzadaIDSTM2022/');
	}
?>