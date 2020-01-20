/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


//引用lazyload
require('lazyload');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Back_to_home = function () {
  var b = setTimeout("window.location='/';", 800)
}
//刪除商品
delete_Merchandise = function (id) {
  let result = confirm('確定要刪除嗎???');
  if (result) {
    let actionUrl = '/merchandise/' + id;
    $("#delete-form").attr('action', actionUrl).submit();
  }
}
//搜尋方塊展開
$(document).ready(function () {
  $("#search")
    .click(function () {
      $("#search_input").attr("class", "open_find_btn");
    })
    .on("mouseleave", function () {
      $("#search_input").attr("class", "close_find_btn");
    })
});

//facebook SDK start
window.fbAsyncInit = function () {
  FB.init({
    appId: 'your-app-id',
    autoLogAppEvents: true,
    xfbml: true,
    version: 'v2.11'
  });
};
(function (d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) { return; }
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//facebook SDK end

//輪播圖
$('.carousel').carousel({
  interval: 2000
})

//延遲載圖片
let images = document.querySelectorAll(".lazy");
lazyload(images);

//首頁價格按鈕 轉地址
$("#pricebtn").click(function () {
  let url = location.pathname;
  if (location.pathname == "/") {
    window.location.href = "/price_down";
  }
  else if(location.pathname == "/price_down"){
    location.pathname = "/price_up"
  }
  else if(location.pathname == "/price_up"){
    location.pathname = "/"
  }
});
//搜尋價格按鈕 轉地址
$("#pricebtn_search").click(function () {
  let url = location.pathname;
  if (location.pathname == "/search") {
    window.location.href = "/search/price_down";
  }
  else if(location.pathname == "/search/price_down"){
    location.pathname = "/search/price_up"
  }
  else if(location.pathname == "/search/price_up"){
    location.pathname = "/search/"
  }
});
//價格按鈕圖案
if(window.location.pathname.slice(-11) == "/price_down"){
  $("#pricebtn,#pricebtn_search").text("trending_down 價格");
}
else if(window.location.pathname.slice(-9) == "/price_up"){
  $("#pricebtn,#pricebtn_search").text("trending_up 價格");
};

$('#destroy').click(function () {
  alert('click');
});

//ajax crsf
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
