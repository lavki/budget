<div class="button-group">
    <div class="btn-group">
        <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-custom-toggle="tooltip" title="Views" data-placement="top">
            <i class="fa fa-video-camera"></i> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="<?= base_url('/'); ?>">By category</a>
            </li>
            <li>
                <a href="<?= base_url('/monthsInformation'); ?>">By months</a>
            </li>
            <li>
                <a href="<?= base_url('/detailsInformation'); ?>">By details</a>
            </li>
        </ul>
    </div><!-- btn-group -->
    <a href="<?= base_url('/category'); ?>" class="btn btn-xs btn-default" title="Category list" data-toggle="tooltip" data-placement="top">
        <i class="fa fa-book"></i>
    </a>
    <a href="<?= base_url('/type'); ?>" class="btn btn-xs btn-default" title="Type list" data-toggle="tooltip" data-placement="top">
        <i class="fa fa-flag"></i>
    </a>
    <a href="<?= base_url('/currency'); ?>" class="btn btn-xs btn-default" title="Currency list" data-toggle="tooltip" data-placement="top">
        <i class="fa fa-bank"></i>
    </a>
    <div class="btn-group">
        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-custom-toggle="tooltip" title="Budget" data-placement="top" >
            <i class="fa fa-money"></i> <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="<?= base_url('/addMoney'); ?>">Add profit</a>
            </li>
            <li>
                <a href="<?= base_url('/addSpent'); ?>">Add expenses</a>
            </li>
        </ul>
    </div><!-- btn-group -->
</div><!-- /.button-group -->