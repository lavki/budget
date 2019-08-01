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

            <form action="<?= base_url('/type/create'); ?>" method="post" class="row" autocomplete="off">
                <div class="form-group col-md-4 col-md-offset-2 <?= empty(form_error('type' )) ? '' : ' has-error'; ?>">
                    <label for="type" class="control-label">Type name:</label>
                    <input type="text" name="type" id="type" minlength="3" maxlength="50" value="<?= set_value('type', $type ?? null ); ?>" class="form-control input-sm" required aria-describedby="helpBlock">
                    <?= form_error('type' ); ?>
                </div><!-- /.form-group -->
                <div class="form-group col-md-4 <?= empty(form_error('category' )) ? '' : ' has-error'; ?>">
                    <label for="category" class="control-label">Category:</label>
                    <select name="category" id="category" class="form-control input-sm" required aria-describedby="helpBlock">
                        <option value="">Category...</option>
                        <?php foreach( $categories as $category ): ?>
                            <option value="<?= $category->id; ?>" <?= (set_value('category') == $category->id) ? 'selected' : null; ?>><?= $category->category; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('category' ); ?>
                </div><!-- /.form-group -->
                <div class="form-group col-md-8 col-md-offset-2 text-right">
                    <button type="submit" class="btn btn-sm btn-default">
                        <i class="fa fa-save"></i> Create type
                    </button>
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->


