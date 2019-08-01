        <div class="col-md-8 col-md-offset-2">

            <div id="action-message"></div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-condensed" id="categoriesList">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Type</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if( $categories ): ?>
                        <?php foreach( $categories as $category ): ?>
                            <tr data-category-id="<?= $category->id; ?>">
                                <td><?= $category->category; ?></td>
                                <td><?= $category->status; ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url("/category/update/{$category->id}"); ?>" class="btn btn-xs btn-default" title="Update an category" data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-xs btn-default" title="Delete an category" data-toggle="tooltip" data-placement="top" data-action="delete" data-id="<?= $category->id; ?>">
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
            "lengthMenu": [ 50, 100, 500 ],
            "columnDefs": [
                { "orderable": false, "targets": [2] }
            ]
        });

        // delete category
        $('body').on('click', '[data-action="delete"]', function () {

            var id = $(this).data('id');

            if( confirm('Delete category?') ) {

                $.post('/category/delete/' + id, function (data) {
                    if( data ) {
                        $('tr[data-category-id="'+id+'"]').remove();
                        doAction('alert alert-success', 'Success! Category was deleted.');
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

