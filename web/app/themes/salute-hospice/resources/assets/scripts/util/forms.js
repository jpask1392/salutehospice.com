/*
* Top Navigation Functionality
* 
*/ 
// Create navbar object;
export const themeForms = {};

themeForms.inputFile = function () {
  var fileName = ''; 
  fileName = $(this).val(); 
  $('.selected-file').html(fileName);
}
