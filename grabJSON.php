<!--
/*!
 * Wikipedia Traffic Grapher
 * 
 * Version: 1.0
 *
 * Copyright 2014 Kevin Payravi (SuperHamster @ en.wiki)
 * Released under the GNU General Public License
 * https://github.com/KevinPayravi/Wikipedia-Traffic-Grapher/blob/master/LICENSE
 */
-->

<?php
	$urlBase = 'http://stats.grok.se/json/en/';
	$url = $urlBase . $_GET['date'] . "/" . $_GET['article'];
	echo file_get_contents($url);
?>
