        <div class="col-md-8 col-md-offset-2">
            <div id="chartCategory"></div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/highcharts.js'); ?>"></script>

<script>

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
    function drawCategoryVisualization() {

        $.ajaxSetup({async: false});

        var info = [];
        var spent = 0;

        $.post('/categoryInfo', function (data) {
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

