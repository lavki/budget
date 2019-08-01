        <div class="col-md-8 col-md-offset-2">

            <div id="action-message"></div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed" id="categoriesList">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Category</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if( $types ): ?>
                        <?php foreach( $types as $type ): ?>
                            <tr data-type-id="<?= $type->id; ?>">
                                <td><?= $type->type; ?></td>
                                <td><?= $type->category; ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url("/type/update/{$type->id}"); ?>" class="btn btn-xs btn-default" title="Update category" data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-xs btn-default" title="Delete category" data-toggle="tooltip" data-placement="top" data-action="delete" data-id="<?= $type->id; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">
                                <i class="fa fa-exclamation-triangle"></i>
                                Table is empty.
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
        $('#categoriesList').DataTable({
            "lengthMenu": [ 25, 50, 100 ],
            "columnDefs": [
                { "orderable": false, "targets": [2] }
            ]
        });

        // delete type
        $('body').on('click', '[data-action="delete"]', function () {

            var id = $(this).data('id');

            if( confirm('Delete a category?') ) {

                $.post('/type/delete/' + id, function (data) {
                    if( data ) {
                        $('tr[data-type-id="'+id+'"]').remove();
                        doAction('alert alert-success', 'Success! Type was deleted.');
                    } else {
                        doAction('alert alert-danger', 'Something wrong...');
                    }
                });
            }
        });

        // show and hide alert block with message
        function doAction(cls, mes) {
            $('#action-message').removeClass().addClass(cls).html(mes).show('slow').delay(2000).hide('slow');
        }
    });
</script>

