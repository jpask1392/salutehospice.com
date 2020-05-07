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
          'walker'        => new \App\Primary_Nav_Walker()
        )) !!}
          
        </div>
        
      </div>
      <div class="modal-footer">
        <div class="call-us-wrapper">
          {!! do_shortcode('[icon value="phone"]') !!}
          {!! do_shortcode('[company_phone use="primary_1,primary_2"]') !!}
        </div>
        <a href="/contact" class="ml-4 btn btn--primary">Schedule an assesment</a>
      </div>
    </div>
  </div>
</div>