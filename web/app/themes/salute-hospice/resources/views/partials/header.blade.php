@php 
$header_link = get_field('header_link', 'options');
$args = array(
    'container'     => false,
    'menu_class'    => 'nav-type-4 navbar-nav m-auto',
    'theme_location'=> 'primary_navigation',
    'before'        => '<div class="nav-arrow-container">',
    'walker'        => new \App\Primary_Nav_Walker()
);
@endphp

<div class="site-notice-wrapper bg-primary px-4 py-1 d-flex">
  <p class="site-notice-text p-0">{{ get_field('site_notice', 'options') }}</p>
  <div class="call-us-wrapper">
    <i class="fas fa-phone"></i>
    {!! do_shortcode('[company_phone use="primary_1,primary_2"]') !!}
  </div>
</div>
@include('modals.navigation-modal')
<header class="banner">
  <div class="">
    <nav id="primary-top-nav" class="navbar navbar-expand-xl navbar-dark p-3 px-md-5 py-lg-0 nav--dropdown">
      <?php the_custom_logo() ?>
      <a class="navbar-toggler" type="button" data-toggle="modal" data-target="#navigationModal" aria-label="Toggle navigation">
        <div id="burger-icon" class="animated-icon"><span></span><span></span><span></span></div>
      </a>
    
      <div class="collapse navbar-collapse" id="nav-type-4">
        {!! wp_nav_menu($args) !!} 
        <a 
          class="ml-4 btn btn--primary" 
          href="{{ $header_link['url'] }}" 
          target={{ $header_link['target'] }}>
            {{ $header_link['title'] }}
        </a>
      </div>

    </nav>
    
  </div>
</header>
