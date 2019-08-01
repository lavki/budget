        <div class="col-md-8 col-md-offset-2">
            <div id="chartMonths"></div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/highcharts.js'); ?>"></script>

<script>

    // months Cart
    Highcharts.chart('chartMonths', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: drawMonthsVisualization('months')
        },
        credits: {
            enabled: false
        },
        series: drawMonthsVisualization('info')
    });

    // month Chart
/*    Highcharts.chart('chartMonths', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: drawMonthsVisualization('months'),
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sum'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}.</b></td></tr>',
            footerFormat: '</table>',
            shared: false,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: drawMonthsVisualization('info')
    });*/

    // Build the chart by months
    function drawMonthsVisualization(typeInfo) {
        $.ajaxSetup({async: false});
        var months = [];
        var info = [
            {name: 'Profit',      data: []},
            {name: 'Spent',       data: []},
            {name: 'Remainder',   data: []},
            {name: 'Saved',       data: []}
        ];

        $.post('/readWalletInfo', function (data) {
            if( data.length > 0 ) {
                var data = JSON.parse(data);

                console.log(data);

                if( typeInfo == 'months' ) {
                    for( var key = 0; key < data.length; key++ ) {
                        months.push(data[key].date);
                    }
                } else if( typeInfo == 'info' ) {
                    for( var key = 0; key < data.length; key++ ) {
                        info[0].data.push(parseFloat(data[key].profit));
                        info[1].data.push(parseFloat(data[key].spent));
                        info[2].data.push(parseFloat(data[key].rest));
                        info[3].data.push(parseFloat(data[key].saved));
                    }
                }
            }
        });

        $.ajaxSetup({async: true});

        if(months.length > 0 ) {
            console.log(months);
            return months;
        }
        else if(info.length > 0 ) {
            /*return [{
                name: 'John',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'Jane',
                data: [2, -2, -3, 2, 1]
            }, {
                name: 'Joe',
                data: [3, 4, 4, -2, 5]
            }];*/
            console.log(info);
            return info;
        }
    }
</script>

