        <div class="col-md-2 col-md-offset-2">
            <input type="text" id="datepicker" class="form-control input-sm">
        </div><!-- /.col-md-8 -->

        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed" id="datailsInfo">
                    <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Sum</th>
                        <th>Currency</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if( isset($datails) && !empty($datails) ): ?>
                        <?php foreach( $datails as $datail): ?>
                            <tr>
                                <td><?= $datail->day; ?></td>
                                <td><?= $datail->time; ?></td>
                                <td><?= $datail->status; ?></td>
                                <td><?= $datail->category; ?></td>
                                <td><?= $datail->type; ?></td>
                                <td><?= $datail->spent; ?></td>
                                <td><?= $datail->currency; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <i class="fa fa-exclamation-triangle"></i> Table is empty.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Sum</th>
                        <th>Currency</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/daterangepicker.js'); ?>"></script>
<script>
    $(document).ready(function () {

        // dataTable Wallet Details Info
        $('#datailsInfo').DataTable({
            "lengthMenu": [ 50, 100, 500 ],
        });

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
        }, function(start, end) {
            var date = {from: start.format('YYYY-MM-DD'), to: end.format('YYYY-MM-DD')};

            // dataTable Wallet Details Info
            /*$('#datailsInfo').DataTable({
                retrieve: true,
                paging: false,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/detailsJsonInfo",
                    "type": "POST"
                },
            });*/
        });

    });
</script>