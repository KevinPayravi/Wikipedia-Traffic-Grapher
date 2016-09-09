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
	<div class="warning">This tool only works through 2015. Our data source (stats.grok.se) has been deprecated. Check out the latest pageview tool, <a href="https://tools.wmflabs.org/pageviews/">Pageviews Analysis</a>.</div>
	<br><br>
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
				<script type="text/javascript">
				var d = new Date();
				var currentYear = d.getFullYear();
				var currentMonth = d.getMonth();
				var d = new Date();
				var currentYear = d.getFullYear();
				var currentMonth = d.getMonth();
				var month = new Array();
				month[0] = "January";
				month[1] = "February";
				month[2] = "March";
				month[3] = "April";
				month[4] = "May";
				month[5] = "June";
				month[6] = "July";
				month[7] = "August";
				month[8] = "September";
				month[9] = "October";
				month[10] = "November";
				month[11] = "December";
				
				// The following code generates dropdown months for the current year, up to the previous month.
				// Currently disabled since stats.grok.se hasn't been updating since 2016-01.
				/*
				for(m = currentMonth - 1; m >= 0; m--) {
					var dateSelection = document.createElement("OPTION");
					dateSelection.text = month[m] + " " + String(currentYear);
					if(m < 10) {
						dateSelection.value = String(currentYear) + "0" + String(m + 1);
					} else {
						dateSelection.value = String(currentYear) + String(m + 1);
					}
					document.getElementById('date').options.add(dateSelection);
				}
				*/
				
				for(y = 2015; y >= 2008; y--) {
					for(m = 11; m >= 0; m--) {
						var dateSelection = document.createElement("OPTION");
						dateSelection.text = month[m] + " " + String(y);
						if(m < 9) {
							dateSelection.value = String(y) + "0" + String(m + 1);
						} else {
							dateSelection.value = String(y) + String(m + 1);
						}
						document.getElementById('date').options.add(dateSelection);
					}
				}
				</script>
			</select>
			<br><br>
			<input class="button-primary" type="submit" onclick="loadStart()" value="Submit" />
			<br><br><br><br><br>
		</div>

		<div id="keyContainer" class="nine columns" style="text-align:center;">
			<div id="keyTitle" align="center" class="three columns" style="text-align:center; text-align:center; display:none;">Key: </div>
			<div id="keyOne" align="center" class="three columns" style="text-align:center; text-align:center; background:#5686BF; border-radius:5px; color:white;"></div>
			<div id="keyTwo" align="center" class="three columns" style="text-align:center; text-align:center; background:#A0BF62; border-radius:5px; color:white;"></div>
			<div id="keyThree" align="center" class="three columns" style="text-align:center; text-align:center; background:#F79B4F; border-radius:5px; color:white;"></div>
		</div>
		<br><br>
		<div id="keyContainerTwo" class="nine columns" style="text-align:center;">
			<div id="spacerOne" align="center" class="three columns" style="text-align:center; text-align:center; background:#FFFFFF; border-radius:5px;">&nbsp;</div>
			<div id="keyFour" align="center" class="three columns" style="text-align:center; text-align:center; background:#C25754; border-radius:5px; color:white;"></div>
			<div id="keyFive" align="center" class="three columns" style="text-align:center; text-align:center; background:#8368A4; border-radius:5px; color:white;"></div>
			<div id="spacerTwo" align="center" class="three columns" style="text-align:center; text-align:center; background:#FFFFFF; border-radius:5px;">&nbsp;</div>
		</div>

		<br><br>

		<div id="chartContainer" class="nine columns" style="text-align:center;"></div>

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

		// Replace special characters:
		for (var i = 0; i < articles.length; i++) {
			articles[i] = articles[i].replace("%26", "&");
			articles[i] = articles[i].replace("%2B", "+");
			articles[i] = articles[i].replace("\"", "&quot;");
			articles[i] = articles[i].replace("_", "&nbsp;");
		}
		
		if (articles.length == 1) {
			var pageViews = [];
			var totalViews = 0;
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
				totalViews += obj1[key];
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a><br><h6>Total Views: " + totalViews + "</h6>");
		} else if (articles.length == 2) {
			var pageViews = [];
			var pageViews2 = [];
			var totalViews = 0;
			var totalViews2 = 0;
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
				totalViews += obj1[key];
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
				totalViews2 += obj2[key];
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a><br><h6>Total Views: " + totalViews + "</h6>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a><br><h6>Total Views: " + totalViews2 + "</h6>");
		} else if (articles.length == 3) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var totalViews = 0;
			var totalViews2 = 0;
			var totalViews3 = 0;
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
				totalViews += obj1[key];
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
				totalViews2 += obj2[key];
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
				totalViews3 += obj3[key];
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a><br><h6>Total Views: " + totalViews + "</h6>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a><br><h6>Total Views: " + totalViews2 + "</h6>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a><br><h6>Total Views: " + totalViews3 + "</h6>");
		} else if (articles.length == 4) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var pageViews4 = [];
			var totalViews = 0;
			var totalViews2 = 0;
			var totalViews3 = 0;
			var totalViews4 = 0;
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
				totalViews += obj1[key];
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
				totalViews2 += obj2[key];
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
				totalViews3 += obj3[key];
			}
			var obj4 = views[3];
			for (var key in obj4) {
				pageViews4.push(obj4[key]);
				totalViews4 += obj4[key];
			}
			
			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a><br><h6>Total Views: " + totalViews + "</h6>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a><br><h6>Total Views: " + totalViews2 + "</h6>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a><br><h6>Total Views: " + totalViews3 + "</h6>");
			$('#keyFour').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[3] + "\">" + articles[3] + "</a><br><h6>Total Views: " + totalViews4 + "</h6>");
		} else if (articles.length == 5) {
			var pageViews = [];
			var pageViews2 = [];
			var pageViews3 = [];
			var pageViews4 = [];
			var pageViews5 = [];
			var totalViews = 0;
			var totalViews2 = 0;
			var totalViews3 = 0;
			var totalViews4 = 0;
			var totalViews5 = 0;
			var obj1 = views[0];
			for (var key in obj1) {
				dates.push(key);
				pageViews.push(obj1[key]);
				totalViews += obj1[key];
			}
			var obj2 = views[1];
			for (var key in obj2) {
				pageViews2.push(obj2[key]);
				totalViews2 += obj2[key];
			}
			var obj3 = views[2];
			for (var key in obj3) {
				pageViews3.push(obj3[key]);
				totalViews3 += obj3[key];
			}
			var obj4 = views[3];
			for (var key in obj4) {
				pageViews4.push(obj4[key]);
				totalViews4 += obj4[key];
			}
			var obj5 = views[4];
			for (var key in obj5) {
				pageViews5.push(obj5[key]);
				totalViews5 += obj5[key];
			}

			$('#keyOne').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[0] + "\">" + articles[0] + "</a><br><h6>Total Views: " + totalViews + "</h6>");
			$('#keyTwo').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[1] + "\">" + articles[1] + "</a><br><h6>Total Views: " + totalViews2 + "</h6>");
			$('#keyThree').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[2] + "\">" + articles[2] + "</a><br><h6>Total Views: " + totalViews3 + "</h6>");
			$('#keyFour').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[3] + "\">" + articles[3] + "</a><br><h6>Total Views: " + totalViews4 + "</h6>");
			$('#keyFive').append("<a class=\"key\" href=\"http://en.wikipedia.org/wiki/" + articles[4] + "\">" + articles[4] + "</a><br><h6>Total Views: " + totalViews5 + "</h6>");
		}

		//////// TRUNCATE DATES ////////
		for (var i = 0; i < dates.length; i++) {
			var length = dates[i].length;
			dates[i] = dates[i].substring(length - 2, length);
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
