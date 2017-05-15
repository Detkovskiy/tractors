$(document).ready(function(){
  $("#menu").on("click","a", function (event) {
    //отменяем стандартную обработку нажатия по ссылке
    event.preventDefault();

    //забираем идентификатор бока с атрибута href
    var id  = $(this).attr('href'),

      //узнаем высоту от начала страницы до блока на который ссылается якорь
      top = $(id).offset().top;

    //анимируем переход на расстояние - top за 1500 мс
    $('body,html').animate({scrollTop: (top - 110)}, 900);
  });
});

var h_hght = 91; // высота шапки
var h_mrg = 0;    // отступ когда шапка уже не видна

if (document.documentElement.clientWidth > 375) {
  h_hght = 110;
}

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

var h_nav = 0; // высота шапки
var h_mrgNav = 0;    // отступ когда шапка уже не видна
$(function(){

  var elem = $('#top_nav');
  var top = $(this).scrollTop();

  if(top > h_nav){
    elem.css('top', h_mrgNav);
  }

  $(window).scroll(function(){
    top = $(this).scrollTop();

    if (top+h_mrg < h_nav) {
      elem.css('top', (h_nav-top));
    } else {
      elem.css('top', h_mrgNav);
    }
  });

});


ymaps.ready(init);

function init(){

  var myMap;

  myMap = new ymaps.Map("map", {
    center: [59.7782, 30.1479],
    zoom: 15,
    controls: []
  });

  myMap.behaviors.disable('scrollZoom');

  var myPlacemark = new ymaps.Placemark([59.7770, 30.1450] , {},
    { iconLayout: 'default#image',
      iconImageHref: 'img/icon-map-pin.svg',
      iconImageSize: [230, 146],
      iconImageOffset: [-45, -147] });

  myMap.geoObjects.add(myPlacemark);

}

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


    } else {
      modalCallback.classList.add('hidden');
    }
  });
})();






/* при загрузке */
function qwe() {
  var list = document.querySelector('.tooltip--rachistka');
  var clientWidth = document.documentElement.clientWidth;

  if (clientWidth > 1200) {
    list.style.top= 315 + "px";
    list.style.left= 265 + "px";
  } else {
    list.style.top= Math.ceil((295 * clientWidth)/1200) + "px";
    list.style.left= Math.ceil((265 * (Math.ceil(650/(1200/clientWidth))))/650) + "px";
  }
}

document.addEventListener("DOMContentLoaded", qwe);

var cordTooltip = function (size, item) {
  item.style.top= Math.ceil((291 * size)/1200) + "px";
  var height = Math.ceil(650/(1200/size));
  item.style.left= Math.ceil((265 * height)/650) + "px";
};

var myFunction = function () {
  var clientWidth = document.documentElement.clientWidth;
  var item = document.querySelector('.tooltip--rachistka');

  if (clientWidth < 1300) {
    cordTooltip(clientWidth, item);
  } else {
    item.style.top= 315 + "px";
    item.style.left= 265 + "px";
  }
};








jQuery(function($){
  $("#client-phone").mask("+7 (999) 999-9999");
});
