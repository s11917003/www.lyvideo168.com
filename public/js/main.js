"use strict";

(function ($) {
  var $body = $('html,body');
  var $win = $(window);
  var $main = $('main');
  var $gotop = $('#gotop'); // themes

  var setTheme = function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    $body.removeAttr('class').addClass(themeName);
  };

  $('#switch').on('change', function () {
    if (localStorage.getItem('theme') === 'is-dark') {
      setTheme('');
    } else {
      setTheme('is-dark');
    }
  });

  if (localStorage.getItem('theme') === 'is-dark') {
    $('#switch-slider').prop('checked', true);
    setTheme('is-dark');
  } else {
    $('#switch-slider').prop('checked', false);
    setTheme('');
  } // gotop


  $win.on('scroll', function () {
    var $this = $(this);
    var scrollTop = $this.scrollTop();
    var fixedHeight = $('header').outerHeight(true);

    if (scrollTop >= fixedHeight) {
      $gotop.css({
        opacity: 1
      });
    } else {
      $gotop.css({
        opacity: 0
      });
    }
  }).scroll();
  $gotop.on('click', function () {
    $body.stop().animate({
      scrollTop: 0
    }, 500, 'swing');
  }); // toggle hamburger in mobile

  $('.hamburger').on('click', function () {
    $('html,body,.hamburger, nav').toggleClass('active');

    if ($('.setting, .search').hasClass('active')) {
      $('.setting, .search').removeClass('active');
    }
  }); // toggle setting in mobile

  $('#setting').on('click', function () {
    $('.setting').toggleClass('active');
    $('.search').removeClass('active');
  }); // toggle search in mobile

  $('#search').on('click', function () {
    $('.search').toggleClass('active');
    $('.setting').removeClass('active');
  });
})(jQuery);