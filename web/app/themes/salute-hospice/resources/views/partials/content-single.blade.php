<article @php post_class('my-5') @endphp>
  <header class="mb-4">
    <h2 class="entry-title no-hearts">{!! get_the_title() !!}</h2>
    <div class="d-flex justify-content-center">
      @include('partials/entry-meta')
    </div>
  </header>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  <footer>
    <nav class="post-pagination container-fluid mt-5" role="navigation">
      @php 
      $prev = get_permalink(get_adjacent_post(false, '', true));
      $next = get_permalink(get_adjacent_post(false, '', false));
      $blog_home = get_permalink( get_option( 'page_for_posts' ) );
      @endphp 
      <a href="{!! $prev !!}" class="btn btn--primary btn-prev {{ !get_previous_post_link() ? "disabled" : "" }}">Previous <span class="sr-only">Page</span></a>
      <a href="{!! $blog_home !!}" class="btn btn--primary">Blog Home <span class="sr-only">Page</span></a>
      <a href="{!! $next !!}" class="btn btn--primary btn-next {{ !get_next_post_link() ? "disabled" : "" }}">Next <span class="sr-only">Page</span></a>
    </nav>
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
