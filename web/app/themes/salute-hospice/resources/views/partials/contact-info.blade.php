<div class="contact-info container mt-5">
  <div style="margin: 0 -15px">
    <div class="row mb-4">
      <div class="col-12">
        <div>
          <span class="contact-info__title">Address:</span><br>
          {!! do_shortcode('[icon value="location"]') !!}
          {{get_field('company_address', 'options')}}
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-6">
        <div>
          <span class="contact-info__title">Phone:</span><br>
          @if (get_field('company_phone', 'options'))
            @while (have_rows('company_phone', 'options')) @php the_row() @endphp
              @if (get_sub_field('use') != 'fax')
                <div>
                  {!! do_shortcode('[icon value="phone"]') !!}
                  <a href="tel:{{get_sub_field('number')}}">{{get_sub_field('number')}}</a>
                </div>
              @endif
            @endwhile
          @endif
        </div>
      </div>
      <div class="col-md-6">
        <div>
          <span class="contact-info__title">Fax:</span><br>
          @if (get_field('company_phone', 'options'))
            @while (have_rows('company_phone', 'options')) @php the_row() @endphp
              @if (get_sub_field('use') == 'fax')
                <div>
                  {!! do_shortcode('[icon value="fax"]') !!}
                  <a href="tel:{{get_sub_field('number')}}">{{get_sub_field('number')}}</a>
                </div>
              @endif
            @endwhile
          @endif
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <div>
          <span class="contact-info__title">Email:</span><br>
          {!! do_shortcode('[icon value="email"]') !!}
          <a href="mailto:{{get_field('company_email', 'options')}}">{{get_field('company_email', 'options')}}</a>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <div>
          <span class="contact-info__title">Office Hours:</span><br>
          @if (get_field('office_hours', 'options'))
            @while (have_rows('office_hours', 'options')) @php the_row() @endphp
              <div>
                {!! do_shortcode('[icon value="clock"]') !!}
                {{get_sub_field('dates')}} - <b>{{get_sub_field('times')}}</b>
              </div>
            @endwhile
          @endif
        </div>
      </div>
    </div>
  </div>
</div>