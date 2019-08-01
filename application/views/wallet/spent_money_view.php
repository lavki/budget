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

            <form action="<?= base_url('/addSpent'); ?>" method="post" class="row" autocomplete="off">
                <div class="form-group col-md-4 col-md-offset-2 <?= empty(form_error('sum' )) ? '' : ' has-error'; ?>">
                    <label for="sum" class="control-label">Sum: </label>
                    <input type="number" min="0" step="any" name="sum" id="sum" value="<?= set_value('sum', $money ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                    <?= form_error('sum' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 <?= empty(form_error('currency' )) ? '' : ' has-error'; ?>">
                    <label for="currency" class="control-label">Currency:</label>
                    <select name="currency" id="currency" value="<?= set_value('currency', $currency ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                        <option value="">Currency...</option>
                        <?php foreach( $currencies as $currency ): ?>
                            <option value="<?= $currency->id; ?>"><?= $currency->currency; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('currency' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 col-md-offset-2 <?= empty(form_error('category' )) ? '' : ' has-error'; ?>">
                    <label for="category" class="control-label">Category:</label>
                    <select name="category" id="category" class="form-control input-sm" required aria-describedby="helpBlock">
                        <option value="">Spent category...</option>
                        <?php foreach( $categories as $category ): ?>
                            <option value="<?= set_value('category', $category->id); ?>"><?= $category->category; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('category' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 <?= empty(form_error('type' )) ? '' : ' has-error'; ?>">
                    <label for="type" class="control-label">Type:</label>
                    <select name="type" id="type" value="<?= set_value('type', $type ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                        <option value="">Spent type...</option>
                    </select>
                    <?= form_error('type' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 col-md-offset-6 text-right">
                    <button type="submit" class="btn btn-sm btn-default">
                        <i class="fa fa-save"></i> Add expenses
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

            $.post('/type/readTypes/' + category, function (data) {
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

