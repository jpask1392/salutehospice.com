import { NavBar } from '../util/header';
// import { themeForms } from '../util/forms';

export default {
  init() {
    NavBar.alignHeader();
    $(window).on('scroll', () => NavBar.onscroll());
    $(window).on('resize', () => NavBar.alignHeader());

    // handles file upload when file selected
    $('#file').bind('change', function() { 
      var fileName = ''; 
      fileName = $(this).prop('files');
      console.log(fileName);
      $('.selected-file').html(fileName[0].name);
    });

    if( $('body').hasClass('home') || $('body').hasClass('reviews') ) {
      // Collect localized data
      const ACF = window.ACF;
      let slides_to_show = parseInt(ACF.slides_to_show);
      let rows = parseInt(ACF.rows);

      var arrowPrev = '<a class="control-prev"><i class="fas fa-chevron-left"></i><span class="sr-only">Previous</span></a>';
      var arrowNext = '<a class="control-next"><i class="fas fa-chevron-right"></i><span class="sr-only">Next</span></a>';

      $('.slick').slick({
        rows: rows,
        slidesPerRow: slides_to_show / rows,
        prevArrow: arrowPrev,
        nextArrow: arrowNext,
        autoplay: true,
        autoplaySpeed: 4000,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              rows: rows,
              slidesPerRow: slides_to_show / rows,
              infinite: true,
              dots: true,
              arrows: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              rows: 1,
              slidesPerRow: 1,
              dots: true,
              arrows: false,
            },
          },
        ],
      });
  } 
  }, // init close
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    
  },
};
