$(function () {

    $.ajaxSetup({ cache: false });

    function getRequest(url, callback) {
        var dfd = jQuery.Deferred();

        $.get(url, function(data) {
            dfd.resolve(callback(data));
        });

        return dfd.promise();
    }

    function getDepartementsPractStats() {
        var dfd = jQuery.Deferred();

        $.when(
            getRequest("api/departementsPraticien", function(data) {
                return data;
            })
        ).then(function(value) {
            dfd.resolve(value);
        });

        return dfd.promise();
    }

    getDepartementsPractStats()
        .then(generateQuestionsChart);

    function generateQuestionsChart(data) {
        $('#departementsPractChart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Membres : Repartition par département'
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
                name: 'Membres',
                colorByPoint: true,
                data: data
            }]
        });
    }

});