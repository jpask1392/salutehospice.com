@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')

    @while (have_rows('page_content')) @php the_row() @endphp
    @php $index = get_row_index() - 1 @endphp
      @include('sections.' . get_row_layout(), ['section_index' => $index])
    @endwhile
  @endwhile
@endsection