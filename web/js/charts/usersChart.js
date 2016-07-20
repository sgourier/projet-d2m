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
			getRequest("api/usersCount", function(data) {
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
	    $('#usersChart').highcharts({

	    	title: {
	            text: 'Nombre d\'utilisateurs par rôle',
	            x: -20 //center
	        },
	        tooltip: {
	            formatter: function() {
			        return this.y + ' ' + this.x + '(s)';
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