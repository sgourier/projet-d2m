$(function () {

    $.ajaxSetup({ cache: false });

    function getRequest(url, callback) {
        var dfd = jQuery.Deferred();

        $.get(url, function(data) {
            dfd.resolve(callback(data));
        });

        return dfd.promise();
    }

    function getDepartementsMembresStats() {
        var dfd = jQuery.Deferred();

        $.when(
            getRequest("api/departementsMembres", function(data) {
                return data;
            })
        ).then(function(value) {
            dfd.resolve(value);
        });

        return dfd.promise();
    }

    getDepartementsMembresStats()
        .then(generateQuestionsChart);

    function generateQuestionsChart(data) {
        $('#departementsMembresChart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Praticiens : Repartition par département'
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