/*
* Top Navigation Functionality
* 
*/ 
// Create navbar object;
export const NavBar = {};

NavBar.alignHeader = function () {
  const banner_height = $('header.banner').innerHeight();
  const doc_wrapper = $('.wrap[role="document"]');
  doc_wrapper.css('margin-top', -Math.abs(banner_height))
}

NavBar.onscroll = function () {
  var el = $('.site-notice-wrapper')
  var bottom_of_el = el.position().top + el.outerHeight(true)
  var nav = $('header.banner')
  
  if (window.scrollY >= bottom_of_el && !nav.hasClass('has-scrolled')) {
    nav.addClass('has-scrolled')
  } else if (window.scrollY <= bottom_of_el && nav.hasClass('has-scrolled')) {
    nav.removeClass('has-scrolled')
  }
}
