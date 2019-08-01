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

            <form action="<?= base_url("/currency/update/{$this->uri->segment(3)}"); ?>" method="post" class="row" autocomplete="off">
                <div class="form-group col-md-4 col-md-offset-4 <?= empty(form_error('currency' )) ? '' : ' has-error'; ?>">
                    <label for="currency" class="control-label">Currency:</label>
                    <input type="hidden" name="id" value="<?= $this->uri->segment(3); ?>" required>
                    <input type="text" name="currency" id="currency" minlength="3" maxlength="50" value="<?= set_value('currency', $currency->currency ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                    <?= form_error('currency' ); ?>
                </div><!-- /.form-group -->
                <div class="form-group col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-default btn-block">
                        <i class="fa fa-save"></i> Update currency
                    </button>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->

<script>
    $(document).ready(function () {

        // Read types by selected currency
        $('body').on('change', 'select[name="currency"]', function () {
            var currency = $(this).val();

            $.post('/readTypes/' + currency, function (data) {
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

