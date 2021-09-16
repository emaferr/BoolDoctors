/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

const { default: Axios } = require('axios');

window.Vue = require('vue');

import { times } from 'lodash';
import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('index-component', require('./components/IndexComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  methods: {
    historyBack(spec) {
      window.location.href = '/doctors?specialization=' + spec;
    },
  }
});


// Automatic slider
setInterval(function () {
  $('#click').trigger('click');
}, 6000);

// Navbar color
$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll > 300) {
    $('.navbar').addClass('bg-scrolling');
  }

  else {
    $('.navbar').removeClass('bg-scrolling');
  }
})

// Card carousel
function cardCarousel3d(carousels) {
  var rotateHandler = function (evt) {
    var carousel = this.parentElement;
    if (carousel.classList.contains('card-carousel') === false) {
      var carousel = carousel.parentElement;
    }
    var rotate_int = parseInt(carousel.dataset.rotateInt || 0);
    if (this.classList.contains('counterclockwise')) {
      rotate_int += 1;
    } else if (this.classList.contains('clockwise')) {
      rotate_int -= 1;
    }
    carousel.dataset.rotateInt = rotate_int;
    animate_slider(carousel);
  }
  for (var i = 0; i < carousels.length; i++) {
    var carousel = carousels[i];
    var inner = carousel.querySelector('.inner-carousel');
    var cards = carousel.querySelectorAll('.inner-carousel > div');
    var size = cards.length;
    var panelSize = inner.clientWidth;
    var translateZ = Math.round((panelSize / 2) / Math.tan(Math.PI / size)) * 1.7;
    inner.style.transform = "rotateY(0deg) translateZ(-" + translateZ + "px)";
    var btnLeft = carousel.querySelector('.button-spin.counterclockwise');
    if (btnLeft !== null) {
      btnLeft.addEventListener("click", rotateHandler, false);
    }
    var btnRight = carousel.querySelector('.button-spin.clockwise');
    if (btnRight !== null) {
      btnRight.addEventListener("click", rotateHandler, false);
    }
    animate_slider(carousel);
  }

  function animate_slider(carousel) {
    var rotate_int = parseInt(carousel.dataset.rotateInt || 0);
    var inner = carousel.querySelector('.inner-carousel');
    var cards = carousel.querySelectorAll('.inner-carousel > div');
    var size = cards.length;
    var panelSize = inner.clientWidth;
    var translateZ = Math.round((panelSize / 2) / Math.tan(Math.PI / size)) * 1.7;
    var rotateY = 0;
    var ry = 360 / size;
    rotateY = ry * rotate_int;

    for (var i = 0; i < size; i++) {
      var z = (rotate_int * ry) + (i * ry);
      var child = cards[i];
      child.style.transform = "rotateY(" + z + "deg) translateZ(" + translateZ + "px) rotateY(" + (-z).toString() + "deg)";
      child.classList.remove('clockwise');
      child.classList.remove('front');
      child.classList.remove('counterclockwise');
      child.removeEventListener("click", rotateHandler, false);
      var zz = z % 360;
      if (zz === 0) {
        child.classList.add('front');
      } else if (zz === ry || zz === -360 + ry) {
        child.classList.add('clockwise');
        child.addEventListener("click", rotateHandler, false);
      } else if (zz === 360 - ry || zz === 0 - ry) {
        child.classList.add('counterclockwise');
        child.addEventListener("click", rotateHandler, false);
      }
    }
  }
}

cardCarousel3d(document.querySelectorAll('.card-carousel'));


// number count for stats, using jQuery animate
$(".counting").each(function () {
  var $this = $(this),
    countTo = $this.attr("data-count");

  $({ countNum: $this.text() }).animate(
    {
      countNum: countTo
    },

    {
      duration: 3000,
      easing: "linear",
      step: function () {
        $this.text(Math.floor(this.countNum));
      },
      complete: function () {
        $this.text(this.countNum);
        //alert('finished');
      }
    }
  );
});

// Parallax Footer
var body = document.getElementsByTagName('body')[0];

initializeParallaxFooter(
  // main can be whatever element you want
  document.getElementsByTagName('main')[0],
  // footer can be whatever element you want
  document.getElementsByTagName('footer')[0]
);

function initializeParallaxFooter(mainElement, footerElement) {
  footerElement.style.left = '0';
  footerElement.style.right = '0';
  footerElement.style.zIndex = '-1';
  updateParallaxFooter(mainElement, footerElement);
  window.addEventListener('resize', function () {
    updateParallaxFooter(mainElement, footerElement);
  });
  window.addEventListener('scroll', function () {
    updateParallaxFooter(mainElement, footerElement);
  });
}

function updateParallaxFooter(mainElement, footerElement) {

  if (isViewportSmallerThanFooter(footerElement)) {
    // Reset bottom style in case user resized window
    footerElement.style.bottom = '';
    footerElement.style.top = '0';
  } else {
    // Reset top style in case user resized window
    footerElement.style.top = '';
    footerElement.style.bottom = '0';
  }
  if (window.scrollY > getBottomY(mainElement)) {
    footerElement.style.position = 'static';
    // Margin is only used to add
    body.style.marginBottom = '0px';
  } else {
    body.style.marginBottom = footerElement.offsetHeight + 'px';
    footerElement.style.position = 'fixed';
  }

}

function isViewportSmallerThanFooter(footerElement) {
  return window.innerHeight < footerElement.offsetHeight;
}

function getBottomY(element) {
  return element.offsetTop + element.offsetHeight;
}

$('#test-hover').hover(
  function () { $(this).addClass('test-hv') },
  function () { $(this).removeClass('test-hv') }
)

$('#test-hover-2').hover(
  function () { $(this).addClass('test-hv-2') },
  function () { $(this).removeClass('test-hv-2') }
)






