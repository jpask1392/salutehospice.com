@php 
/**
 * Content
 */ 
$limit = get_sub_field('limit') == 0 ? -1 : get_sub_field('limit');
$inc_pre_content_block = get_sub_field("inc_pre_content_block");
$link = get_sub_field('link');
$loop = new WP_Query(array( 
    'post_type'       => 'testimonials',
    'posts_per_page'  => $limit
));

// Localize our main script with data from ACF
// for initializing Slick.js
wp_localize_script('sage/main.js', 'ACF', array(
  'slides_to_show'  => get_sub_field('reviews_per_slide'),
  'rows'            => get_sub_field('rows'),
));

/**
 * Layout 
 */ 
$padding = get_sub_field('section_padding');
$content_width = get_sub_field("content_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$tile_style = get_sub_field('tile_style');

/**
 * Colors 
 */ 
$body_text_color = get_sub_field('body_text_color');
$header_text_color = get_sub_field('header_text_color');

/**
 * Background
 */ 
$bkg_image = get_sub_field('background_image');
$bkg_color = get_sub_field('background_color');
$bkg_overlay_opacity = get_sub_field('background_color_opacity');
$is_gradient = get_sub_field('gradient');
$has_background = ($bkg_image['url'] || $bkg_color && $bkg_color != "none" ) ? ' has-background' : '';
@endphp

<section id="section-{{ $section_index }}" {{ App\get_section_classes('testimonials-section'. $has_background) }}>
  <!-- Section specific styles -->
  <style>
    #section-{{ $section_index }} {
      padding: {{$padding['padding_top']}}px {{$padding['padding_right']}}px {{$padding['padding_bottom']}}px {{$padding['padding_left']}}px;
      <?php if ($bkg_image['url']): ?>background-image: url('{{ $bkg_image['url'] }}');<?php endif; ?>
      color: {{ $body_text_color }};
      justify-content: {{ $justify_content }};
      align-items: center;
      background-position: center;
      background-size: cover;
    }

    #section-{{ $section_index }} h2,
    #section-{{ $section_index }} h3,
    #section-{{ $section_index }} h4,
    #section-{{ $section_index }} h5,
    #section-{{ $section_index }} h6 {
      color: {{ $header_text_color }};
    }

    #section-{{ $section_index }} .is-background {
      <?php if ($is_gradient): ?>
      background: linear-gradient(to right, {{$bkg_color}} 40%, rgba({{App\hex2RGB($bkg_color, true)}}, 0) 100%);
      <?php else : ?>
      background: {{ $bkg_color }};
      <?php endif; ?>
      opacity: {{ $bkg_overlay_opacity }};
    }
  </style>
  <!-- Section specific styles END -->
  
  @if ($has_background) <div class="is-background"></div> @endif
  <div class="{{ $content_width }} content align-items-{{ $vertical_content_align }}">
    @if ($inc_pre_content_block)
    <div class="row">
      <div class="pre-content mb-5 col"> 
        {!! get_sub_field('pre_content_block') !!}
      </div>
    </div>
    @endif
    @if ($loop->have_posts()) 
      <div class="slick row">
      @while ($loop->have_posts()) @php $loop->the_post() @endphp
        <div class="col">
          <div class="review-card review-card--{{$tile_style}}">
            @if ($tile_style == 'style-1')
              <div class="review-meta">
                <h3 class="review-user-title">{{ the_field('client_name') }}</h3>
                <time>Reviewed {{ the_field('review_date') }}</time>
                <div class="review-{{ get_the_id() }}">
                  <div class="star-rating d-inline">
                    @for ( $i=0; $i<5; $i++ )
                      @if($i >= get_field('star_rating'))
                      <i class="fas fa-star"></i>
                      @else 
                      <i class="far fa-star"></i>
                      @endif
                    @endfor
                  </div>
                </div>
                <strong>{{ the_field('title') }}</strong>
              </div>
            @elseif ($tile_style == 'style-2')
              <img class="quote-marks" src="@asset('images/quote-marks.png')" alt="">
            @endif
            {{the_field('content')}}
            @if ($tile_style == 'style-1')
              <a class="d-block mt-3" href="">Read More</a>
            @elseif ($tile_style == 'style-2')
              <div class="review-meta">- {{ the_field('client_name') }}, {{ the_field('review_date') }}</div>
            @endif
          </div>
        </div>
      @endwhile 
      {{ wp_reset_query() }}
      </div>
    @endif

    @if (!empty($link))
    <div class="row">
      <div class="post-content mt-5 col text-center"> 
        <a class="btn btn--primary" href="{{ $link['url'] }}" target="{{ $link['target'] }}">{{ $link['title'] }}</a>
      </div>
    </div>
    @endif  
  </div>
 
</section>