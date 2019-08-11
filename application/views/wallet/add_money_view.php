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

            <form action="<?= base_url('/addMoney'); ?>" method="post" class="row" autocomplete="off">
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
                        <option value="">Profit category...</option>
                        <?php foreach( $categories as $category ): ?>
                            <option value="<?= set_value('category', $category->id ); ?>"><?= $category->category; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('category' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 <?= empty(form_error('type' )) ? '' : ' has-error'; ?>">
                    <label for="type" class="control-label">Type:</label>
                    <select name="type" id="type" value="<?= set_value('type', $type ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                        <option value="">Profit spent...</option>
                    </select>
                    <?= form_error('type' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4 col-md-offset-2 <?= empty(form_error('date' )) ? '' : ' has-error'; ?>">
                    <label for="date" class="control-label">Date:</label>
                    <input type="text" name="date" id="date" class="form-control input-sm" required aria-describedby="helpBlock">
                    <?= form_error('date' ); ?>
                </div><!-- /.form-group -->

                <div class="form-group col-md-4">
                    <label for="submit" class="control-label" style="opacity: 0;">Add spent:</label>
                    <button type="submit" class="form-control input-sm">
                        <i class="fa fa-save"></i> Add spent
                    </button>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script src="<?= base_url('/public/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('/public/js/daterangepicker.js'); ?>"></script>

<script>
    $(document).ready(function () {

        // datarange picker
        $('#date').daterangepicker({
            "minYear": 2019,
            "singleDatePicker": true,
            "autoApply": true,
            "autoUpdateInput": true,
            "drops":     "up",
            "locale": {
                "format": "YYYY-MM-DD",
                "firstDay": 1
            }
        });

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

