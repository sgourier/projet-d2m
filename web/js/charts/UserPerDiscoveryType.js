/**
 * Created by jordan on 21/07/2016.
 */


$(function () {

    function getRequest(url, callback) {
        var dfd = jQuery.Deferred();

        $.get(url, function(data) {
            dfd.resolve(callback(data));
        });

        return dfd.promise();
    }

    function getUsersStats() {
        var dfd = jQuery.Deferred();

        $.when(
            getRequest("api/UsersPerDiscoveryType", function(data) {
                return data;
            })
        ).then(function(value) {
            dfd.resolve(value);
        });

        return dfd.promise();
    }

    getUsersStats()
        .then(generateUserPerDiscoveryTypeChart);

    function generateUserPerDiscoveryTypeChart(data) {
        $('#UserPerDiscoveryTypeChart').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Utilisateurs par type de découverte'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Type de découverte',
                data: data
            }]
        });
    }
});