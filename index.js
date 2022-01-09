'use strict'

//ハンバーガーメニュー
$(function() {
    $('.menu_btn').click(function() {
        $(this).toggleClass('active');

        if ($(this).hasClass('active')) {
            $('.main_nav').addClass('active');
        } else {
            $('.main_nav').removeClass('active');
        }
    });

    $('.nav_item').on('click', function(event) {
        $('.main_nav').removeClass('active');
        $('.menu_btn').removeClass('active');
    });
});

//ボーダーライン
window.onload=function(){
    var scroll = document.querySelectorAll('.border_line');
    var right = document.getElementsByClassName('right')[0];
    var left = document.getElementsByClassName('left')[0];
    var element = document.getElementById('border');
     
    var Animation = function() {
      for(var i = 0; i < scroll.length; i++) {
      var triggerMargin = 80;
      if (window.innerHeight > scroll[i].getBoundingClientRect().top + triggerMargin ) {
      scroll[i].classList.add('down');
      right.classList.add('show');
      left.classList.add('show');
      } else if (element.classList.contains('down') && window.innerHeight < scroll[i].getBoundingClientRect().top + triggerMargin){           
        element.classList.remove('down')
        right.classList.remove('show');
      left.classList.remove('show');
      }
      }
  
  
      }
      window.addEventListener('scroll', Animation);
    
  }    