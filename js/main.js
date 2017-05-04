$(document).ready(function(){
  $("#menu").on("click","a", function (event) {
    //отменяем стандартную обработку нажатия по ссылке
    event.preventDefault();

    //забираем идентификатор бока с атрибута href
    var id  = $(this).attr('href'),

      //узнаем высоту от начала страницы до блока на который ссылается якорь
      top = $(id).offset().top;

    //анимируем переход на расстояние - top за 1500 мс
    $('body,html').animate({scrollTop: (top - 150)}, 900);
  });
});



var h_hght = 91; // высота шапки
var h_mrg = 0;    // отступ когда шапка уже не видна

$(function(){

  var elem = $('#sub-menu');
  var top = $(this).scrollTop();

  if(top > h_hght){
    elem.css('top', h_mrg);
  }

  $(window).scroll(function(){
    top = $(this).scrollTop();

    if (top+h_mrg < h_hght) {
      elem.css('top', (h_hght-top));
    } else {
      elem.css('top', h_mrg);
    }
  });

});

/*// Map
	ymaps.ready(function(){

		// coords
		var coords = [59.77691726, 30.14760450];

		// map
		var yaMap = new ymaps.Map('map', {
			center: coords,
			zoom: 16,
			controls: ['geolocationControl', 'typeSelector', 'fullscreenControl', 'zoomControl']
		});
		yaMap.behaviors.disable(['scrollZoom']);

		// placemark
		var yaPlacemark = new ymaps.Placemark(
			coords, {
				iconContent: 'Заречная улица, 2'
			},
			{
				preset: 'islands#blueStretchyIcon'
			}
		);
		yaMap.geoObjects.add(yaPlacemark);

  });*/


/*
 $(document).ready(function(){
 // = Вешаем событие прокрутки к нужному месту
 //	 на все ссылки якорь которых начинается на #
 $('a[href^="#"]').bind('click.smoothscroll',function (e) {
 e.preventDefault();

 var target = this.hash,
 $target = $(target);

 $('html, body').stop().animate({
 'scrollTop': $target.offset().top - 150
 }, 900, 'swing', function () {
 window.location.hash = target;
 });
 });

 });*/


var topMenu = document.querySelector('#menu');
var toggleMenu = document.querySelector('.menu-toggle');
var mainMenu = document.querySelector('.main-menu');
var modalCallback = document.querySelector('.modal-callback');
var toggleCallback = document.querySelector('.call-me__callback-toggle');
/*

var objectClick = [
  {
    nameToggle: toggleMenu,
    openBlock: mainMenu
  },
  {
    nameToggle: toggleCallback,
    openBlock: modalCallback
  }
];
*/

var sizeTopMenu = function (position) {
  var cordY = (position == 0) ? position + 80 : position - 30;
  return cordY;
};

var sizeCallBack = function (position) {
  var cordY = (position == 0) ? position + 200 : position + 124;
  return cordY;
};

var openMainMenu = (function () {
  toggleMenu.addEventListener('click', function () {
    if (mainMenu.classList.contains('hidden')) {
      mainMenu.classList.remove('hidden');
      mainMenu.setAttribute('style', 'top:' + sizeTopMenu($(window).scrollTop()) + 'px;');
      console.log($(window).scrollTop());
      document.addEventListener('keydown', function (evt) {
        if (evt.keyCode === 27) {
          mainMenu.classList.add('hidden');
        }
      });
      if (window.innerWidth < 1000) {
        console.log(window.innerWidth);
        mainMenu.addEventListener('click', function () {
          mainMenu.classList.add('hidden');
        });
      }


      /*document.addEventListener('click', function () {

          mainMenu.classList.add('hidden');

      });*/
    } else {
      mainMenu.classList.add('hidden');
    }
  });
})();

var openCallBack = (function () {
  toggleCallback.addEventListener('click', function () {
    if (modalCallback.classList.contains('hidden')) {
      modalCallback.classList.remove('hidden');
      modalCallback.setAttribute('style', 'top:' + sizeCallBack($(window).scrollTop()) + 'px;');
      console.log($(window).scrollTop());
      document.addEventListener('keydown', function (evt) {
        if (evt.keyCode === 27) {
          modalCallback.classList.add('hidden');
        }
      });

      /*document.addEventListener('click', function () {

       mainMenu.classList.add('hidden');

       });*/
    } else {
      modalCallback.classList.add('hidden');
    }
  });
})();

/*



var openCallBack = (function () {
  toggleMenu.addEventListener('click', function () {
    if (mainMenu.classList.contains('hidden')) {
      mainMenu.classList.remove('hidden');
      mainMenu.setAttribute('style', 'top:' + sizeTopMenu($(window).scrollTop()) + 'px;');
      console.log($(window).scrollTop());
      document.addEventListener('keydown', function (evt) {
        if (evt.keyCode === 27) {
          mainMenu.classList.add('hidden');
        }
      });
      /!*document.addEventListener('click', function () {

       mainMenu.classList.add('hidden');

       });*!/
    } else {
      mainMenu.classList.add('hidden');
    }
  });
})();
*/


/*

var openAnyBlock = (function () {
  for (var i = 0; i < objectClick.length; i++) {
    objectClick[i].nameToggle.addEventListener('click', function (evt) {
      var indexPin = evt.currentTarget.getAttribute('data-index');
      if (objectClick[indexPin].openBlock.classList.contains('hidden')) {
        objectClick[indexPin].openBlock.classList.remove('hidden');
        objectClick[indexPin].openBlock.setAttribute('style', 'top:' + sizeTopMenu($(window).scrollTop()) + 'px;');
        console.log($(window).scrollTop());
        document.addEventListener('keydown', function (evt) {
          if (evt.keyCode === 27) {
            objectClick[indexPin].openBlock.classList.add('hidden');
          }
        })
      } else {
        objectClick[indexPin].openBlock.classList.add('hidden');
      }
    });
  }
})();

*/


jQuery(function($){
  $("#client-phone").mask("+7 (999) 999-9999");
});
