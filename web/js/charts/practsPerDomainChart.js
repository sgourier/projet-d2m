$(function () {

	$.ajaxSetup({ cache: false });
	
	function getRequest(url, callback) {
		var dfd = jQuery.Deferred();

		$.get(url, function(data) {
			dfd.resolve(callback(data));
		});

		return dfd.promise();
	}

	function getQuestionsStats() {
		var dfd = jQuery.Deferred();

		$.when(
			getRequest("api/practiciensPerDomain", function(data) {
				return data;
			})
		).then(function(value) {
			dfd.resolve(value);
		});

		return dfd.promise();
	}

	getQuestionsStats()
		.then(generateQuestionsChart);	

	function generateQuestionsChart(data) {
	 	$('#practsPerDomainChart').highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false,
	            type: 'pie'
	        },
	        title: {
	            text: 'Nombre de practiciens par domaine'
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.y}</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: {point.y}',
	                    style: {
	                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                    }
	                }
	            }
	        },
	        series: [{
	            name: 'Practiciens',
	            colorByPoint: true,
	            data: data
	        }]
	    });
	}

});