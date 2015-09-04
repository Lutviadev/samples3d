var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.less([
        'bootstrap.less',
        'datatables.less',
        'datatables-responsive.less',
        'app.less',
        'multi-select.less',
        'flash-messages.less',
        'collector.less',
        'bootstrap-tagsinput.less',
        'minicolors.less'
    ]);
    
    mix.scripts([
    	'alert.js',
    	'affix.js',
    	'button.js',
    	'carousel.js',
    	'collapse.js',
    	'dropdown.js',
    	'modal.js',
    	'tooltip.js',
        'popover.js',
        'scrollspy.js',
        'tab.js',
    	'transition.js',
        'jquery.mobile.events.min.js',
        'devices.min.js',
        'jquery.slimscroll.min.js',
        'jquery.cookie.js',
        'sidebar.class.js',
        'jquery.bootbox.js',
        'jquery.multi-select.js',
        'jquery.collector.js',
        'jquery.imagemanager.js',
        'jquery.dataTables.js',
        'jquery.dataTables.responsive.js',
        'jquery.minicolors.js',
        'bootstrap-tagsinput.js',
        'bootstrap3-typeahead.js',      
        'portfolio.renders.js',      
        'portfolio.tours.js',      
        'portfolio.animations.js',      
    	'master.js'
    ]);

});