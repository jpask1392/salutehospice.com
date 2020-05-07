<!-- Modal -->
<div class="modal fade" id="navigationModal" tabindex="-1" role="dialog" aria-labelledby="navigationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php the_custom_logo() ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="primary-menu">
        {!! wp_nav_menu(array(
          'container'     => false,
          'menu_class'    => 'nav-type-4 navbar-nav',
          'theme_location'=> 'primary_navigation',
          'before'        => '<div class="nav-arrow-container">',
          'walker'        => new Primary_Nav_Walker()
        )) !!}
          
        </div>
        <div class="sub-menus">
          {{ wp_nav_menu(['theme_location' => 'partner']) }}
          {{ wp_nav_menu(['theme_location' => 'policies']) }}
          </div>
        
      </div>
      <div class="modal-footer">
        <a href="/contact"><button>Book Now</button></a>
        <div class="call-us-wrapper">
          <i class="fas fa-phone"></i><a href="tel:{!!do_shortcode('[company_phone]')!!}">{!!do_shortcode('[company_phone]')!!}</a>
        </div>
      </div>
    </div>
  </div>
</div>