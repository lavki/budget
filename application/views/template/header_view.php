<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?? 'Default budget'; ?></title>
        <link rel="shortcut icon" href="<?= base_url('/public/img/favicon.ico'); ?>" type="image/vnd.microsoft.icon">
        <link rel="stylesheet" href="<?= base_url('/public/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('/public/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('/public/css/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('/public/css/base-style.css'); ?>">

        <script src="<?= base_url('/public/js/jquery-3.4.1.min.js'); ?>"></script>
        <script src="<?= base_url('/public/js/bootstrap.min.js'); ?>"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="page-loader">
            <div class="loader">Download...</div>
        </div><!-- /.page-loader -->

        <header>
            <div class="container">
                <div class="row">
                    <a href="<?= base_url('/'); ?>" data-toggle="tooltip" data-placement="bottom" title="Go home">
                        <h1 class="text-center text-uppercase"><i class="fa fa-bookmark-o"></i></h1>
                    </a>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </header>

        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="button-group">
                                    <?= $title; ?>
                                </div><!-- /.button-group -->
                            </div><!-- /.col -->
                            <div class="col-md-6 text-right">
                                <div class="button-group">
                                    <a href="<?= base_url('/databaseShema'); ?>" class="btn btn-xs btn-default" title="Database shema" data-toggle="tooltip" data-placement="top">
                                        <i class="fa fa-database"></i>
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-custom-toggle="tooltip" title="Views" data-placement="top">
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
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-custom-toggle="tooltip" title="Create" data-placement="top">
                                            <i class="fa fa-plus"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?= base_url('/category/create'); ?>">Create category</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('/type/create'); ?>">Create type</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('/currency/create'); ?>">Create currency</a>
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
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.well -->
                </div><!-- /.col -->

