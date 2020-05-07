@php 
$bkg_overlay = '0, 0, 0'; // as rgb value
$overlay = $bkg_overlay ? "linear-gradient(rgba(" . $bkg_overlay . ", 0.6), rgba(" . $bkg_overlay . ", 0.6)), " : "";
$options = get_sub_field('slideshow_options');
$show_controls = (in_array('show_controls', $options) ? true : false);
$show_navigation = (in_array('show_navigation', $options) ? true : false);
$duplicate_text = (in_array('duplicate_text', $options) ? true : false);

@endphp

<div class="hero-slideshow">

  <div id="carousel-hero" 
    class="carousel slide {{ get_sub_field('slide_animation') == 'fade' ? "carousel-fade" : "" }}" 
    data-ride="carousel" 
    data-interval="{{ get_sub_field('slideshow_speed') }}"
    data-pause="false">

    <div class="carousel-inner">

      @if ($duplicate_text)
        @php 
          $rows = get_sub_field('hero_slides');
          $first_row = $rows[0];
          $first_content = $first_row['slide_content'];
        @endphp

        <!-- Caption same on every slide -->
        <div class="carousel-caption px-5">
          {!! $first_content !!}
        </div>
      @endif
      
      @if (have_rows('hero_slides'))
        @while (have_rows('hero_slides')) @php the_row() @endphp
        
        @php
        $slide_options = get_sub_field('slide_options');
        $slide_content = get_sub_field('slide_content');
        $align_image = $slide_options['align_image'];
        $align_content = $slide_options['align_content'];
        $bkg_color = $slide_options['background_color'];
        $is_gradient = $slide_options['gradient'];
        $slide_header = $slide_content['header'];
        $slide_subheader = $slide_content['subheader'];
        $link = $slide_content['link'];
        $has_background = $bkg_color ? ' has-background' : '';
        @endphp

        <!-- Carousel item -->
        <div  
          class="carousel-item {{ get_row_index() == 1 ? " active": ""}}">
          <img src="{{ $slide_content['slide_image']['url'] }}" alt="">
          @if ($has_background) 
            <div 
              class="is-background" 
              style="
                @if ($is_gradient)
                background: linear-gradient(
                  to right, 
                  rgba({{App\hex2RGB($bkg_color, true)}}, 0.8) 0%, 
                  rgba({{App\hex2RGB($bkg_color, true)}}, 0) 100%
                );
                @else
                background: {{ $bkg_color }};
                opacity: 0.8;
                @endif
              ">
            </div> 
          @endif

          <div class="carousel-caption d-md-block {{$align_content == 'right' ? 'align-right' : ''}}">
            @if (!$duplicate_text)
              <h1 class="hero-slideshow__page-header icon--lg">{!! App\cleanse($slide_header) !!}</h1>
              <h3 class="hero-slideshow__page-subheader">{!! App\cleanse($slide_subheader) !!}</h3>
              @if (!empty($link))
                <a class="btn btn--primary mt-4" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
              @endif
            @endif
          </div>
        </div>
        <!-- Carousel item END -->

        @endwhile
      @endif
    </div>

    <!-- Carousel controls -->
    <div class="carousel-controls">
      @if ($show_navigation)
      <ol class="carousel-indicators">
        @while (have_rows('hero_slides')) @php the_row() @endphp
          <li data-target="#carousel-hero" data-slide-to="{{ get_row_index() - 1 }}" class={{ get_row_index() == 1 ? "active": ""}}></li>    
        @endwhile
      </ol>
      @endif

      @if ($show_controls)
      <div class="control-buttons">
        <a class="carousel-control-prev" href="#carousel-hero" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-hero" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      @endif
    </div>
    <!-- Carousel controls END -->
  </div>

</div>  