var wind = $(window);

// page loader
wind.on('load', function () {
    $('.page-loader').delay(500).fadeOut('slow');
});

$('[data-toggle="tooltip"]').tooltip();
$('[data-custom-toggle="tooltip"]').tooltip();