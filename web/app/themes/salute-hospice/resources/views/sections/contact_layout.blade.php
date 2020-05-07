@php 
$key = get_sub_field('map_key');
$location = get_sub_field('location_map');
$content = get_sub_field('location_content');
@endphp

<section class="section-map">
  <div class="">
    <div class="row">
      <div class="col-md-6 p-0 m-0 order-2 order-md-1" style="min-height: 400px">
        <div class="acf-map h-100" data-zoom="16">
          <div class="marker" data-lat="{{ $location['lat'] }}" data-lng="{{ $location['lng'] }}"></div>
        </div>
      </div>

      <div class="col-md-6 p-5 order-1">
        <div class="content">
          {!! $content !!}
        </div>
      </div>
    </div>
  </div>
</section>
