<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action( 'login_enqueue_scripts', function () {
  wp_enqueue_style( 'sage/login.css', asset_path('styles/login.css'), false, null );
});

add_action( 'admin_enqueue_scripts', function ( ) {
  wp_enqueue_style( 'sage/admin.css', asset_path('styles/admin.css'), false, null );
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('font-families', 'https://use.typekit.net/gvc8aqh.css', false, null);
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.2.0/css/all.css');
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_script('scrollreveal', 'https://unpkg.com/scrollreveal');
    wp_enqueue_script('googleapi', 'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"');

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    add_theme_support( 'custom-logo' );
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array (
        'page_title' 	=> 'App Settings',
        'menu_title'	=> 'TechyScouts',
        'menu_slug' 	=> 'theme-general-settings'
    ));
	
}

class Primary_Nav_Walker extends \Walker_Nav_Menu {
  private $current_item;

  function start_lvl(&$output, $depth=0, $args=array()) {
      $output .= '
        <div 
          class="navbar-toggle touch-dropdown collapsed" 
          type="button" data-toggle="collapse" 
          data-target="#menu-item-' . $this->current_item->ID . '-dd" 
          aria-expanded="false">
            <span></span>
        </div>
      </div>';
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul id=\"menu-item-" . $this->current_item->ID . "-dd\" class=\"sub-menu dropdown-menu collapse py-3 my-0";
      $output .= "\">\n";
  }

  function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
      $this->current_item = $item;
      parent::start_el( $output, $item, $depth, $args);
  } 
};

add_filter('acf/fields/google_map/api', function ( $api ){
  $api['key'] = 'AIzaSyD7nWsK_addQubCH9h5vQAhCMQTKFq4ceI';
  return $api;
});

function my_acf_input_admin_footer() {
  ?>
<script type="text/javascript">
(function($) {

  // Default scheme on color picker
  acf.add_filter('color_picker_args', function( args, $field ){
    args.palettes = ['#7FC8FE', '#E7FAFF', '#FFFFFF', '#006BBB', '#E84A56', '#EDE7DC', '#444444'];

    return args;
  });
})(jQuery);

</script>
  <?php
}
add_action('acf/input/admin_footer', __NAMESPACE__ . '\\my_acf_input_admin_footer');
