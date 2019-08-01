        <div class="col-md-8 col-md-offset-2">
            <?php if( isset($error) ): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle"></i> <?= $error; ?>
                        </div><!-- /.alert -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            <?php endif; ?>

            <form action="<?= base_url("/type/update/{$this->uri->segment(3)}"); ?>" method="post" class="row" autocomplete="off">
                <div class="form-group col-md-4 col-md-offset-2 <?= empty(form_error('type' )) ? '' : ' has-error'; ?>">
                    <label for="type" class="control-label">Type name:</label>
                    <input type="hidden" name="id" value="<?= $this->uri->segment(3); ?>" required>
                    <input type="text" name="type" id="type" minlength="3" maxlength="50" value="<?= set_value('type', $type->type ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                    <?= form_error('type' ); ?>
                </div><!-- /.form-group -->
                <div class="form-group col-md-4 <?= empty(form_error('category' )) ? '' : ' has-error'; ?>">
                    <label for="category" class="control-label">Category of type:</label>
                    <select name="category" id="category" class="form-control input-sm" required aria-describedby="helpBlock">
                        <?php foreach( $categories as $category ): ?>
                            <option value="<?= $category->id; ?>" <?= $type->category_id == $category->id ? 'selected' : null; ?>><?= $category->category; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('category' ); ?>
                </div><!-- /.form-group -->
                <div class="form-group col-md-8 col-md-offset-2 text-right">
                    <button type="submit" class="btn btn-sm btn-default">
                        <i class="fa fa-save"></i> Update category
                    </button>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script>
    $(document).ready(function () {

        // Read types by selected category
        $('body').on('change', 'select[name="category"]', function () {
            var category = $(this).val();

            $.post('/readTypes/' + category, function (data) {
                $('select[name="type"]').html(buildOptions(data));
            });
        });
    });

    function buildOptions( data ) {
        var data = JSON.parse(data);
        var options = '<option value="">Spent type...</option>'

        for( var key = 0; key < data.length; key++ ) {
            options += '<option value="'+data[key].id+'">'+data[key].type+'</option>';
        }

        return options;
    }
</script>

