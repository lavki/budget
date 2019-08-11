        <div class="col-md-2 col-md-offset-2">
            <input type="text" id="datepicker" class="form-control input-sm">
        </div><!-- /.col -->

        <div class="col-md-8 col-md-offset-2">
            <div id="chartMonths"></div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/highcharts.js'); ?>"></script>
<script src="<?= base_url('/public/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/daterangepicker.js'); ?>"></script>

<script>
    $('#datepicker').daterangepicker({
        "minYear": 2019,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "linkedCalendars": false,
        "showCustomRangeLabel": false,
        "alwaysShowCalendars": true,
        "startDate": "07/29/2019",
        "endDate": "08/04/2019",
        "minDate": "01/28/01",
        "cancelClass": "btn-danger"
    }, function(start, end, label) {
        var date = {
            from: start.format('YYYY-MM-DD'),
            to:   end.format('YYYY-MM-DD')
        };

        // months Cart
        Highcharts.chart('chartMonths', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: drawMonthsVisualization('months', date)
            },
            credits: {
                enabled: false
            },
            series: drawMonthsVisualization('info', date)
        });
    });

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

    // Build the chart by months
    function drawMonthsVisualization(typeInfo, date) {
        $.ajaxSetup({async: false});
        var months = [];
        var info = [
            {name: 'Profit',      data: []},
            {name: 'Spent',       data: []},
            {name: 'Remainder',   data: []},
            {name: 'Saved',       data: []}
        ];

        $.post('/readWalletInfo', {date: date}, function (data) {
            if( data.length > 0 ) {
                var data = JSON.parse(data);

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
            return months;
        } else if(info.length > 0 ) {
            return info;
        }
    }
</script>

