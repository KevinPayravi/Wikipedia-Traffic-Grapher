<?php
	$urlBase = 'http://stats.grok.se/json/en/';
	$url = $urlBase . $_GET['date'] . "/" . $_GET['article'];
	echo file_get_contents($url);
?>
