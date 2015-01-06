<?php /*
 * Wikipedia Traffic Grapher
 * 
 * Version: 1.0
 *
 * Copyright 2014 Kevin Payravi (SuperHamster @ en.wiki)
 * Released under the GNU General Public License
 * https://github.com/KevinPayravi/Wikipedia-Traffic-Grapher/blob/master/LICENSE
*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Wikipedia Traffic Grapher</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="A tool for graphic monthly traffic of articles on the English Wikipedia.">
	<meta name="keywords" content="wikipedia, traffic, grapher, graphs, charts">
	<link rel="stylesheet" type="text/css" href="css/skeleton.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<br><br>
<div class="container">
	<div class="row">
		<div class="three columns">
			<h4><b>Wikipedia Multi-Page Traffic Grapher</b></h4>
			<h6>
				Made with <3 by <a href="http://www.kevinpayravi.com/">Kevin Payravi</a>
				<br>
				(<a href="http://en.wikipedia.org/wiki/User:SuperHamster">SuperHamster</a> at en.wiki)
				<br><br>
				Data from <a href="http://stats.grok.se/">stats.grok.se</a>
				<br>
				Made using <a href="http://getskeleton.com/">Skeleton</a> and <a href="http://www.chartjs.org/">Chart.js</a>
			</h6>
			<br>
			Enter up to 5 articles:<br>
			<form id="articleForm" action="javascript:void(0);" method="get">
				<input type="text" name="articleOne" /><br>
				<input type="text" name="articleTwo" /><br>
				<input type="text" name="articleThree" /><br>
				<input type="text" name="articleFour" /><br>
				<input type="text" name="articleFive" /><br>
				<input type="submit" onclick="loadStart()" value="" style="display:none;" />
			</form>
   			<br>
			<form id="checkForm" action="javascript:void(0);" method="get">
                		<input type="checkbox" id="showLineGraph" checked="checked" /><label for="showLineGraph">Line Graph</label>
                		<br>
				<input type="checkbox" id="showBarGraph" /><label for="showBarGraph">Bar Graph</label>
				<input type="submit" onclick="loadStart()" value="" style="display:none;" />
			</form>
			<br>
			Select Month:
			<br>
			<select id="date">
				<option selected="selected" value="201501">January '15</option>
				<option value="201412">December '14</option>
				<option value="201411">November '14</option>
				<option value="201410">October '14</option>
				<option value="201409">September '14</option>
				<option value="201408">August '14</option>
				<option value="201407">July '14</option>
				<option value="201406">June '14</option>
				<option value="201405">May '14</option>
				<option value="201404">April '14</option>
				<option value="201403">March '14</option>
				<option value="201402">February '14</option>
				<option value="201401">January '14</option>
				<option value="201312">December '13</option>
				<option value="201311">November '13</option>
				<option value="201310">October '13</option>
				<option value="201309">September '13</option>
				<option value="201308">August '13</option>
				<option value="201307">July '13</option>
				<option value="201306">June '13</option>
				<option value="201305">May '13</option>
				<option value="201304">April '13</option>
				<option value="201303">March '13</option>
				<option value="201302">February '13</option>
				<option value="201301">January '13</option>
				<option value="201212">December '12</option>
				<option value="201211">November '12</option>
				<option value="201210">October '12</option>
				<option value="201209">September '12</option>
				<option value="201208">August '12</option>
				<option value="201207">July '12</option>
				<option value="201206">June '12</option>
				<option value="201205">May '12</option>
				<option value="201204">April '12</option>
				<option value="201203">March '12</option>
				<option value="201202">February '12</option>
				<option value="201201">January '12</option>
				<option value="201112">December '11</option>
				<option value="201111">November '11</option>
				<option value="201110">October '11</option>
				<option value="201109">September '11</option>
				<option value="201108">August '11</option>
				<option value="201107">July '11</option>
				<option value="201106">June '11</option>
				<option value="201105">May '11</option>
				<option value="201104">April '11</option>
				<option value="201103">March '11</option>
				<option value="201102">February '11</option>
				<option value="201101">January '11</option>
				<option value="201012">December '10</option>
				<option value="201011">November '10</option>
				<option value="201010">October '10</option>
				<option value="201009">September '10</option>
				<option value="201008">August '10</option>
				<option value="201007">July '10</option>
				<option value="201006">June '10</option>
				<option value="201005">May '10</option>
				<option value="201004">April '10</option>
				<option value="201003">March '10</option>
				<option value="201002">February '10</option>
				<option value="201001">January '10</option>
				<option value="200912">December '09</option>
				<option value="200911">November '09</option>
				<option value="200910">October '09</option>
				<option value="200909">September '09</option>
				<option value="200908">August '09</option>
				<option value="200907">July '09</option>
				<option value="200906">June '09</option>
				<option value="200905">May '09</option>
				<option value="200904">April '09</option>
				<option value="200903">March '09</option>
				<option value="200902">February '09</option>
				<option value="200901">January '09</option>
				<option value="200812">December '08</option>
				<option value="200811">November '08</option>
				<option value="200810">October '08</option>
				<option value="200809">September '08</option>
				<option value="200808">August '08</option>
				<option value="200807">July '08</option>
				<option value="200806">June '08</option>
				<option value="200805">May '08</option>
				<option value="200804">April '08</option>
				<option value="200803">March '08</option>
				<option value="200802">February '08</option>
				<option value="200801">January '08</option>
			</select>
			<br><br>
			<input class="button-primary" type="submit" onclick="loadStart()" value="Submit" />
			<br><br><br><br><br>
		</div>

		<div id="keyContainer" class="nine columns" style="align:center;">
			<div id="keyTitle" align="center" class="three columns" style="align:center; text-align:center; display:none;">Key: </div>
			<div id="keyOne" align="center" class="three columns" style="align:center; text-align:center; background:#5686BF; border-radius:5px; color:white;"></div>
			<div id="keyTwo" align="center" class="three columns" style="align:center; text-align:center; background:#A0BF62; border-radius:5px; color:white;"></div>
			<div id="keyThree" align="center" class="three columns" style="align:center; text-align:center; background:#F79B4F; border-radius:5px; color:white;"></div>
		</div>
		<br><br>
		<div id="keyContainerTwo" class="nine columns" style="align:center;">
			<div id="spacerOne" align="center" class="three columns" style="align:center; text-align:center; background:#FFFFFF; border-radius:5px;">&nbsp;</div>
			<div id="keyFour" align="center" class="three columns" style="align:center; text-align:center; background:#C25754; border-radius:5px; color:white;"></div>
			<div id="keyFive" align="center" class="three columns" style="align:center; text-align:center; background:#8368A4; border-radius:5px; color:white;"></div>
			<div id="spacerTwo" align="center" class="three columns" style="align:center; text-align:center; background:#FFFFFF; border-radius:5px;">&nbsp;</div>
		</div>
		<br><br>
		<div id="chartContainer" class="nine columns" classstyle="align:center;"></div>
		<div class="loader" id="loader"></div>
	</div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script>
function loadStart() {
	// Clear charts:
	$('#chartContainer').empty();
	if (typeof lineChart !== 'undefined') {
		lineChart.destroy();
    	}
	if (typeof barChart !== 'undefined') {
		barChart.destroy();
    	}

	// Clear keys:
	document.getElementById("keyTitle").style.display="none";
	$('#keyOne').empty();
	$('#keyTwo').empty();
	$('#keyThree').empty();
	$('#keyFour').empty();
	$('#keyFive').empty();

	// Check if graph type has been selected; if not, activate loading overlay and call main method:
	if (!document.getElementById("showLineGraph").checked && !document.getElementById("showBarGraph").checked) {
		alert("Please select the type(s) of graph you want!");
	} else {
		document.getElementById("loader").style.display="inline";
		setTimeout(main, 0);
	}
}

function main() {

	//////// GRAB ARTICLE TITLES ////////
	var formData = document.getElementById("articleForm");
	var articles = [];

	// Grab article titles from form:
	for (var i = 0; i < formData.length; i++) {
		var articleTitle = formData.elements[i].value;
		if(articleTitle != ""){
			// Trim spaces:
			articleTitle = articleTitle.trim();

			// If string is only empty spaces, get rid of them:
			articleTitle = articleTitle.concat("#$%");
			articleTitle = articleTitle.trim();
			articleTitle = articleTitle.replace("#$%", "");

			// Replace remaining spaces with underscores:
			articleTitle = articleTitle.replace(/ /g, "_");

			// Replace evil code-breaking characters will unicode or empty characters:
			articleTitle = articleTitle.replace("\%", "");
			articleTitle = articleTitle.replace("\#", "");
			articleTitle = articleTitle.replace("\&", "\%26");
			articleTitle = articleTitle.replace("\+", "\%2B");

			// Push article title to articles array:
			if(articleTitle != ""){
				articles.push(articleTitle);
			}
		}
   	}

	//////// GRAB DATES ////////
	var dateSelected = document.getElementById("date");
	var date = dateSelected.value;
	var articleJSONs = [];

	//////// GRAB JSON OBJECTS ////////
	if (articles.length >= 1) {
		var article1Obj = $.ajax({url: 'grabJSON.php?date=' + date + '&article=' + articles[0], async: false});
		articleJSONs.push(article1Obj.responseText);
	}
	if (articles.length >= 2) {
		var article2Obj = $.ajax({url: 'grabJSON.php?date=' + date + '&article=' + articles[1], async: false});
		articleJSONs.push(article2Obj.responseText);
	}
	if (articles.length >= 3) {
		var article3Obj = $.ajax({url: 'grabJSON.php?date=' + date + '&article=' + articles[2], async: false});
		articleJSONs.push(article3Obj.responseText);
	}
	if (articles.length >= 4) {
		var article4Obj = $.ajax({url: 'grabJSON.php?date=' + date + '&article=' + articles[3], async: false});
		articleJSONs.push(article4Obj.responseText);
	}
	if (articles.length == 5) {
		var article5Obj = $.ajax({url: 'grabJSON.php?date=' + date + '&article=' + articles[4], async: false});
		articleJSONs.push(article5Obj.responseText);
	}

	//////// PARSE THROUGH JSON OBJECTS ////////
	var views = extractViews(articleJSONs);

	//////// GRAB PAGEVIEWS FROM JSON AND PUSH ARTICLE TITLES TO KEY ////////
	var dates = [];
	if (articles.length != 0) {
		document.getElementById("keyTitle").style.display="inline";

		for (var i = 0; i < articles.length; i++) {
			articles[i] = articles[i].replace("%26", "&");
			articles[i] = articles[i].replace("%2B", "+");
			articles[i] = articles[i].replace("\"", "&quot;");
			articles[i] = articles[i].replace("_", "&nbsp;");
		}
		
		if (articles.length == 1) {
			var pageViews = [];
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a>");
		} else if (articles.length == 2) {
			var pageViews = [];
			var pageViews2 = [];
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a>");
		} else if (articles.length == 3) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a>");
		} else if (articles.length == 4) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var pageViews4 = [];
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
			}
			var obj4 = views[3];
			for (var key in obj4) {
				pageViews4.push(obj4[key]);
			}
			
			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a>");
			$('#keyFour').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[3] + "\">" + articles[3] + "</a>");
		} else if (articles.length == 5) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var pageViews4 = [];
			var pageViews5 = [];
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
			}
			var obj4 = views[3];
			for (var key in obj4) {
				pageViews4.push(obj4[key]);
			}
			var obj5 = views[4];
			for (var key in obj5) {
				pageViews5.push(obj5[key]);
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a>");
			$('#keyFour').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[3] + "\">" + articles[3] + "</a>");
			$('#keyFive').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[4] + "\">" + articles[4] + "</a>");
		}
		
		//////// TRUNCATE DATES ////////
		for (var i = 0; i < dates.length; i++) {
			dates[i] = dates[i].substring(dates[i].length - 2, dates[i].length);
		}
		
		//////// GENERATE GRAPH DATASETS ////////
		if (articles.length == 1) {
			var dataLine = {
			labels: dates,
    			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,0.0)",
            			strokeColor: "rgba(86,134,191,1)",
				pointColor: "rgba(86,134,191,1)",
            			data: pageViews
        			}]
			};

			var dataBar = {
			labels: dates,
			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,1)",
            			strokeColor: "rgba(86,134,191,1)",
            			data: pageViews
        			}]
			};
		} else if(articles.length == 2) {
			var dataLine = {
			labels: dates,
    			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,0.0)",
            			strokeColor: "rgba(86,134,191,1)",
				pointColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,0.0)",
            			strokeColor: "rgba(160,191,98,1)",
				pointColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			}]
			};

			var dataBar = {
			labels: dates,
			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,1)",
            			strokeColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,1)",
            			strokeColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			}]
			};
		} else if(articles.length == 3) {
			var dataLine = {
			labels: dates,
    			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,0.0)",
            			strokeColor: "rgba(86,134,191,1)",
				pointColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,0.0)",
            			strokeColor: "rgba(160,191,98,1)",
				pointColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,0.0)",
            			strokeColor: "rgba(247,155,79,1)",
				pointColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			}]
			};

			var dataBar = {
			labels: dates,
			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,1)",
            			strokeColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,1)",
            			strokeColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,1)",
            			strokeColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			}]
			};
		} else if(articles.length == 4) {
			var dataLine = {
			labels: dates,
    			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,0.0)",
            			strokeColor: "rgba(86,134,191,1)",
				pointColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,0.0)",
            			strokeColor: "rgba(160,191,98,1)",
				pointColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,0.0)",
            			strokeColor: "rgba(247,155,79,1)",
				pointColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			},
				{
            			label: "Pageviews4",
            			fillColor: "rgba(194,87,84,0.0)",
            			strokeColor: "rgba(194,87,84,1)",
				pointColor: "rgba(194,87,84,1)",
            			data: pageViews4
        			}]
			};

			var dataBar = {
			labels: dates,
			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,1)",
            			strokeColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,1)",
            			strokeColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,1)",
            			strokeColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			},
				{
            			label: "Pageviews4",
            			fillColor: "rgba(194,87,84,1)",
            			strokeColor: "rgba(194,87,84,1)",
            			data: pageViews4
        			}]
			};
		} else if(articles.length == 5) {
			var dataLine = {
			labels: dates,
    			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,0.0)",
            			strokeColor: "rgba(86,134,191,1)",
				pointColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,0.0)",
            			strokeColor: "rgba(160,191,98,1)",
				pointColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,0.0)",
            			strokeColor: "rgba(247,155,79,1)",
				pointColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			},
				{
            			label: "Pageviews4",
            			fillColor: "rgba(194,87,84,0.0)",
            			strokeColor: "rgba(194,87,84,1)",
				pointColor: "rgba(194,87,84,1)",
            			data: pageViews4
        			},
				{
            			label: "Pageviews5",
            			fillColor: "rgba(131,104,164,0.0)",
            			strokeColor: "rgba(131,104,164,1)",
				pointColor: "rgba(131,104,164,1)",
            			data: pageViews5
        			}]
			};

			var dataBar = {
			labels: dates,
			datasets: [{
            			label: "Pageviews",
            			fillColor: "rgba(86,134,191,1)",
            			strokeColor: "rgba(86,134,191,1)",
            			data: pageViews
        			},
				{
            			label: "Pageviews2",
            			fillColor: "rgba(160,191,98,1)",
            			strokeColor: "rgba(160,191,98,1)",
            			data: pageViews2
        			},
				{
            			label: "Pageviews3",
            			fillColor: "rgba(247,155,79,1)",
            			strokeColor: "rgba(247,155,79,1)",
            			data: pageViews3
        			},
				{
            			label: "Pageviews4",
            			fillColor: "rgba(194,87,84,1)",
            			strokeColor: "rgba(194,87,84,1)",
            			data: pageViews4
        			},
				{
            			label: "Pageviews5",
            			fillColor: "rgba(131,104,164,1)",
            			strokeColor: "rgba(131,104,164,1)",
            			data: pageViews5
        			}]
			};
		}

		//////// OUTPUT CHARTS ////////
		if ((document.getElementById("showLineGraph").checked) && (document.getElementById("showBarGraph").checked)) {
			$('#chartContainer').append('<canvas id="topChart" width="800" height="500" style="vertical-align: bottom;"></canvas>');
			$('#chartContainer').append('<canvas id="bottomChart" width="800" height="500" style="vertical-align: bottom;"></canvas>');
			var ctx1 = document.getElementById("topChart").getContext("2d");
			var ctx2 = document.getElementById("bottomChart").getContext("2d");
			lineChart = new Chart(ctx1).Line(dataLine, {responsive: true});
			barChart = new Chart(ctx2).Bar(dataBar, {responsive: true});
		} else if (document.getElementById("showLineGraph").checked) {
			$('#chartContainer').append('<canvas id="topChart" width="800" height="500" style="vertical-align: bottom;"></canvas>');
			var ctx1 = document.getElementById("topChart").getContext("2d");
			lineChart = new Chart(ctx1).Line(dataLine, {responsive: true});
		} else if (document.getElementById("showBarGraph").checked) {
			$('#chartContainer').append('<canvas id="topChart" width="800" height="500" style="vertical-align: bottom;"></canvas>');
			var ctx1 = document.getElementById("topChart").getContext("2d");
			barChart = new Chart(ctx1).Bar(dataBar, {responsive: true});
		}

	} else {
		// If at least one article has not been entered, alert user:
		alert("Please enter at least one article to analyze.");
	}

	// Get rid of loading overlay:
	document.getElementById("loader").style.display="none";
}

function sortArrayByKeys(inputArray) {
	//////// SORT DATES ////////
	var arrayKeys=[];

	for (var key in inputArray) {
		arrayKeys.push(key);
	}

	arrayKeys.sort();

	var outputArray=[];

	for (var i = 0; i < arrayKeys.length; i++) {
		outputArray[arrayKeys[i]] = inputArray[arrayKeys[i]];
	}

	return outputArray;
}

function extractViews(articleJSONs) {
	//////// EXTRACT VIEWS FROM JSON OBJECT ////////
	var views = [];
	var dailyViewsObject = new Object;

	for (var i = 0; i < articleJSONs.length; i++) {
		var jsonObject = JSON.parse(articleJSONs[i]);	
		for (var key in jsonObject) {
			if (jsonObject.hasOwnProperty(key)) {
				key.toString();
				if (key == "daily_views") {
					dailyViewsObject = jsonObject[key];
				}
			}
		}
		dailyViewsObject = sortArrayByKeys(dailyViewsObject);
		views.push(dailyViewsObject);
	}

	return views;
}
</script>

<script src="js/Chart.js"></script>

</body>
</html>




