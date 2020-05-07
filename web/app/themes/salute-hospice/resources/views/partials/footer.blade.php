<footer class="content-info primary-footer">

  @if (!empty(get_field('footer_content')))
  <div class="primary-footer__extended" style="background-image: url('{{ get_field('footer_background_image')['url'] }}')">
    <div class="is-background"></div>
    <div class="content">
      {!! get_field('footer_content') !!}
    </div>
  </div>
  @endif
  
  <div class="primary-footer__upper position-relative">
    <img src="@asset('images/heart_group_2.png')" alt="">
    <div class="primary-footer__upper-content">
      <p class="extra-content">{!! App\cleanse(the_field('footer_content', 'options')) !!}</p>
        <p>
          {!! do_shortcode('[icon value="phone"]') !!}
          {!! do_shortcode('[company_phone use="primary_1,primary_2"]') !!}
        </p>
        <p>
          {!! do_shortcode('[icon value="email"]') !!}
          {!! do_shortcode('[company_email]') !!}
        </p>
    </div>
    <img src="@asset('images/heart_group_1.png')" alt="">
  </div>

  <nav class="primary-footer__lower">

      <div><?= date('Y'); ?> Salute Hospice</div>
      <div>
        <a href="https://techyscouts.com/" class="techyscouts-credit-link">
          {!! do_shortcode('[icon value="techyscouts"]') !!}
        </a>
      </div>
      <div class="footer-socials-wrapper d-flex">
        @if (have_rows('socials', 'options')) 
          @while (have_rows('socials', 'options')) @php the_row() @endphp
          @php $link = get_sub_field('social_profile_link') @endphp
          <a href="{{$link['url']}}" target="{{$link['target']}}">
            {!! do_shortcode('[icon value="' . get_sub_field('social_icon_name') . '"]') !!}
          </a>
          @endwhile
        @endif
      </div>
    
  </nav>
   
</footer>

