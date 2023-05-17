var currentColor = true;
$(document).ready(function() {
  $('#oc-button').click(function() {
    var navbar = $('.navbar');
    if (currentColor) {
      navbar.css('background-color', '#ffcc00');
      currentColor = false;
    } else {
      navbar.css('background-color', 'transparent');
      currentColor = true;
    }
  });
});
