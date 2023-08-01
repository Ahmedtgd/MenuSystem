require('./bootstrap');
require('admin-lte');

$(document).ready(function() {
    $('.nav-link').on('mouseover', function() {
      $(this).css('cursor', 'url(path/to/custom-cursor.png), auto');
    }).on('mouseout', function() {
      $(this).css('cursor', 'default');
    });
  });
