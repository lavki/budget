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
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/dataTables.bootstrap.min.js'); ?>"></script>
<script>
    $(document).ready(function () {

        // dataTable Wallet Details Info
        $('#datailsInfo').DataTable({
            "lengthMenu": [ 50, 100, 500 ]
        });

    });
</script>