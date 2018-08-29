"use strict";
jQuery(document).ready(function() {
  jQuery(window).bind("load", function() {
    //Пример исключения ссылки:
    //jQuery('a[href*="#"]:not([href="#"],[href="#spu-209"],[href="#spu-211"],[href="#spu-212"],[href="#spu-213"],[href="#spu-214"],[href="#spu-215"],[href="#spu-217"])').click(function() {
    jQuery('a:not(.spu-clickable)[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') ||
        location.hostname == this.hostname) {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          jQuery("html, body").animate({
            // $('html, body').animate({
            scrollTop: target.offset().top - 37
          }, 1000);
          return false;
        }
      }
    });
  });
});
jQuery(window).load(function() {
  function goToByScroll(id) {
    jQuery("html, body").animate({
      scrollTop: jQuery("#" + id).offset().top - 38
    }, 1000);
  }
  if (window.location.hash != '') {
    goToByScroll(window.location.hash.substr(1));
  }
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

var modalCallback = document.querySelector('.modal-callback');
var toggleCallback = document.querySelector('.call-me__callback-toggle');
var toggleCallbackClose = modalCallback.querySelector('.modal-content-close');

var modalOrder = document.querySelector('.modal-order');
var toggleOrderClose = modalOrder.querySelector('.modal-order-close');

var modalServices = document.querySelector('.modal-services');
var toggleServicesClose = modalServices.querySelector('.modal-services-close');

var sizeTopMenu = function (position) {
  var cordY = (position == 0) ? position + 80 : position - 30;
  return cordY;
};

var sizeCallBack = function (position) {
  var cordY = (position == 0) ? position + 200 : position + 124;
  return cordY;
};

var openCallBack = (function () {
  toggleCallback.addEventListener('click', function () {
    if (modalCallback.classList.contains('hidden')) {
      modalCallback.classList.remove('hidden');
      modalCallback.setAttribute('style', 'top:' + sizeCallBack($(window).scrollTop()) + 'px;');
      document.addEventListener('keydown', function (evt) {
        if (evt.keyCode === 27) {
          modalCallback.classList.add('hidden');
        }
      });
      toggleCallbackClose.addEventListener('click', function () {
        modalCallback.classList.add('hidden');
      });

    } else {
      modalCallback.classList.add('hidden');
    }
  });
})();


var openServices = (function () {
  var toggleServices = document.querySelectorAll('.button--services');

  for (var i = 0; i < toggleServices.length; i++) {
    toggleServices[i].addEventListener('click', function () {
      if (modalServices.classList.contains('hidden')) {
        modalServices.classList.remove('hidden');
        modalServices.setAttribute('style', 'top:' + sizeCallBack($(window).scrollTop()) + 'px;');
        document.addEventListener('keydown', function (evt) {
          if (evt.keyCode === 27) {
            modalServices.classList.add('hidden');
          }
        });
        toggleServicesClose.addEventListener('click', function () {
          modalServices.classList.add('hidden');
        });

      } else {
        modalServices.classList.add('hidden');
      }
    });
  }

})();

var openModalOrder = (function () {
  var toggleOrder = document.querySelectorAll('.open-modal__order');
  var carList = document.querySelector('#order-value');

  for (var i = 0; i < toggleOrder.length; i++) {
    toggleOrder[i].addEventListener('click', function (evt) {
      event.stopPropagation();
      carList.value = evt.currentTarget.getAttribute('data-target');

      if (modalOrder.classList.contains('hidden')) {
        modalOrder.classList.remove('hidden');
        modalOrder.setAttribute('style', 'top:' + sizeCallBack($(window).scrollTop()) + 'px;');
        document.addEventListener('keydown', function (evt) {

          if (evt.keyCode === 27) {
            modalOrder.classList.add('hidden');
          }
        });
        toggleOrderClose.addEventListener('click', function () {
          modalOrder.classList.add('hidden');
        });

      } else {
        modalOrder.classList.add('hidden');
      }
    })
  }
})();

var arrcordTooltips = [
  {
    name: 'rachistka',
    top: 315,
    left: 265
  },
  {
    name: 'byrenie',
    top: 445,
    left: 355
  },
  {
    name: 'viravnivanie',
    top: 475,
    left: 465
  },
  {
    name: 'drenaj',
    top: 535,
    left: 80
  },
  {
    name: 'mojenie',
    top: 535,
    left: 900
  },
  {
    name: 'fundament',
    top: 440,
    left: 580
  },
  {
    name: 'crane',
    top: 160,
    left: 720
  }
];

/* при загрузке */
function qwe() {
  var clientWidth = document.documentElement.clientWidth;
  var toolList = document.querySelectorAll('.tooltip');

  for (var i = 0; i < toolList.length; i++ ) {
    if (clientWidth > 1200) {
      toolList[i].style.top = arrcordTooltips[i].top + "px";
      toolList[i].style.left = arrcordTooltips[i].left + "px";
    } else {
      toolList[i].style.top = Math.ceil(((arrcordTooltips[i].top - 45) * clientWidth)/1200) + "px";
      toolList[i].style.left = Math.ceil(((arrcordTooltips[i].left - 40) * (Math.ceil(650/(1200/clientWidth))))/650) + "px";
    }
  }
}

document.addEventListener("DOMContentLoaded", qwe);

var cordTooltip = function (size, item, i) {
  item.style.top= Math.ceil(((arrcordTooltips[i].top - 45) * size)/1200) + "px";
  var height = Math.ceil(650/(1200/size));
  item.style.left= Math.ceil(((arrcordTooltips[i].left - 40) * height)/650) + "px";
};

var tooltips = function () {
  var clientWidth = document.documentElement.clientWidth;
  var toolList = document.querySelectorAll('.tooltip');

  for (var i = 0; i < toolList.length; i++ ) {
    if (clientWidth < 1300) {
      cordTooltip(clientWidth, toolList[i], i);
    } else {
      toolList[i].style.top= arrcordTooltips[i].top + "px";
      toolList[i].style.left= arrcordTooltips[i].left + "px";
    }
  }
};

jQuery(function($){
  $("#client-phone").mask("+7 (999) 999-9999");
  $("#order-client-phone").mask("+7 (999) 999-9999");
  $("#services-client-phone").mask("+7 (999) 999-9999");
});

