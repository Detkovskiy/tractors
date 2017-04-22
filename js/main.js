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



var h_hght = 0; // высота шапки
var h_mrg = 0;    // отступ когда шапка уже не видна

$(function(){

  var elem = $('#top_nav');
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
var mainMenu = topMenu.querySelector('.main-menu');



var openMenu = function () {
  if (mainMenu.classList.contains('hidden')) {
    mainMenu.classList.remove('hidden');
  } else {
    mainMenu.classList.add('hidden');
  }
};

toggleMenu.addEventListener('click', openMenu);



jQuery(function($){
  $("#client-phone").mask("+7 (999) 999-9999");
});
