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
			getRequest("api/waitingQuestions", function(data) {
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
	    $('#questionsChart').highcharts({

	    	title: {
	            text: 'Nombre de questions en attente de traitement',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'par type d\'utilisateur',
	            x: -20
	        },
	        tooltip: {
	            formatter: function() {
			        return this.y + ' question(s) en attente de traitement par un ' + this.x;
			    }
	        },

	        yAxis: {
	            title: {
	                text: ''
	            }
	        },

		    xAxis: {
		        categories: data.categories
		    },

		    series: [{
		    	showInLegend: false,  
		        data: data.data,
		        type: 'column'
		    }]

	 	});
	}

});