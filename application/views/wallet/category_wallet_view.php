        <div class="col-md-2 col-md-offset-2">
            <input type="text" id="datepicker" class="form-control input-sm">
        </div><!-- /.col -->

        <div class="col-md-8 col-md-offset-2">
            <div id="chartCategory"></div>
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

        // Build the chart by category
        Highcharts.chart('chartCategory', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}% ({point.sum} {point.currency})</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} % ({point.sum} {point.currency})',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Spent',
                data: drawCategoryVisualization(date)
            }]
        });
    });

    // Build the chart by category
    Highcharts.chart('chartCategory', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}% ({point.sum} {point.currency})</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} % ({point.sum} {point.currency})',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Spent',
            data: drawCategoryVisualization()
        }]
    });

    // Draw Category Visualization Pie
    function drawCategoryVisualization(date) {

        if( date == undefined || date.length == 0 ) {
            var date = {
                from: '<?= date('Y-m-01'); ?>',
                to: '<?= date('Y-m-d'); ?>'
            };
        }

        $.ajaxSetup({async: false});

        var info = [];
        var spent = 0;

        $.post('/categoryInfo', date, function (data) {
            if( data.length > 0 ) {
                var data = JSON.parse(data);
                var currency = '';

                for( var key = 0; key < data.length; key++ ) {
                    if (key == 0) {
                        profit = parseFloat(data[key].sum);
                    } else {
                        currency = data[key].currency;
                        spent += parseFloat(data[key].sum);
                        info.push({
                            name:     data[key].types,
                            y:        parseFloat((data[key].sum/profit) *100),
                            sum:      parseFloat((data[key].sum)),
                            currency: data[key].currency
                        });
                    }
                }

                info.push({
                    name:    'Remainder',
                    y:        parseFloat(((profit - spent)/profit) *100),
                    sum:      profit - spent,
                    currency: currency
                });
            }
        });

        $.ajaxSetup({async: true});

        return info;
    }
</script>

