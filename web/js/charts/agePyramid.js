/**
 * Created by Sylvain Gourier on 21/07/2016.
 */

$(function () {

    $.ajaxSetup({ cache: false });

    function getRequest(url, callback) {
        var dfd = jQuery.Deferred();

        $.get(url, function(data) {
            dfd.resolve(callback(data));
        });

        return dfd.promise();
    }

    function getPyramidStats() {
        var dfd = jQuery.Deferred();

        $.when(
            getRequest("api/agePyramid", function(data) {
                return data;
            })
        ).then(function(value) {
            dfd.resolve(value);
        });

        return dfd.promise();
    }

    getPyramidStats()
        .then(generatePyramidChart);

    function generatePyramidChart(data) {
        var categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 + '];
        $(document).ready(function () {
            $('#agePyramid').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Pyramide des ages par sexe'
                },
                xAxis: [{
                    categories: categories,
                    reversed: false,
                    labels: {
                        step: 1
                    }
                }, { // mirror axis on right side
                    opposite: true,
                    reversed: false,
                    categories: categories,
                    linkedTo: 0,
                    labels: {
                        step: 1
                    }
                }],
                yAxis: {
                    title: {
                        text: null
                    },
                    labels: {
                        formatter: function () {
                            return '';
                        }
                    }
                },

                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },

                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                            'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                    }
                },

                series: data
            });
        });
    }

});
