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
			getRequest("api/feedbackCounts", function(data) {
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
	    $('#feedBacksCount').highcharts({
	    	chart: {
	            type: 'pie',
	            options3d: {
	                enabled: true,
	                alpha: 45,
	                beta: 0
	            }
	        },
	    	title: {
	            text: 'Pourcentage des notes des discussions',
	            x: -20 //center
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                depth: 35,
	                dataLabels: {
	                    enabled: true,
	                    format: '{point.name} étoiles'
	                }
	            }
	        },


		    series: [{
		    	type: 'pie',
           		name: 'Pourcentage', 
		        data: data
		    }]

	 	});
	}

});