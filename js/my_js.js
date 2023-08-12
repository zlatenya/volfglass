const imgLinks = [
  '/gl-img/6.webp',
  '/gl-img/7.webp',
  '/gl-img/4.webp'
];

let selected_id;//id выбранного раздела в нав пилс
let selected_aria;// переменная для атрибута ареа
// получение id выбранного раздела в нав пилс
$('.nav-pills button').click(function(event){
       selected_id = event.target.id;
       selected_aria = event.target.getAttribute('aria-controls');
       document.cookie = cookie_set('selected_id', selected_id, 1);
       document.cookie = cookie_set('selected_aria', selected_aria, 1);
       //console.log(selected_id);
       console.log('selected_aria', selected_aria);
   });

let cookie_id = getCookie("selected_id");
let cookie_aria = getCookie("selected_aria");

//обработка кнопки закрытия страницы товара
$('#go-back').click(function (e) {
    history.back();
});

$('#close_message').click(function (e) {
  //document.getElementById('blackout').classList.remove('active');
  document.getElementById('blackout').classList.remove('active');
});
//функция чтобы когда выходишь из товара, возвращало не в первую категорию а в ту из которой был открыт товар

  $(document).ready(function(){
    if (cookie_id){
      document.getElementById('large-dishes-tab').classList.remove('active');
      document.getElementById('large-dishes-tab').ariaSelected = "false";
      document.getElementById('large-dishes').classList.remove('active');
      document.getElementById(cookie_id).classList.add('active');
      document.getElementById(cookie_id).ariaSelected = "true";
      document.getElementById(cookie_aria).classList.add('active');
      if($(document).width() < 990){
        const scrollTarget = document.getElementById(cookie_id);
        const elementPosition = scrollTarget.getBoundingClientRect().left;
        const offsetPosition = elementPosition - (90);
        $(document.getElementById('pills-tab')).scrollLeft(offsetPosition);
      }
    }else{
      document.getElementById('large-dishes-tab').classList.add('active');
      document.getElementById('large-dishes-tab').ariaSelected = "true";
      document.getElementById('large-dishes').classList.add('active');
    }
  });


function cookie_set(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

//скрипт для смен фотографий в галерее
const delay = 5000;
let currentIndex = 0;

setInterval(function() {
    document.getElementById('image').src = imgLinks[currentIndex];
    document.getElementById('link').href = imgLinks[currentIndex];
    currentIndex++;
    if(currentIndex >= imgLinks.length) {
        currentIndex = 0;
    }
}, delay);



//функция для скролла к основному контекту
function scrollTo(element) {
  const header = document.querySelector( '#nav_menu' );
  const len = element.offsetTop - header.offsetHeight + (40);
  window.scroll({
    behavior: 'smooth',
    left: 0,
    top: len,
  });
}


//скролл к основному контенту
//$(document).ready(function() {
  const sectionText = document.querySelector("#gallery");
  const btnArrow = document.querySelector(".arrow");
  btnArrow.addEventListener('click', () => {
    scrollTo(sectionText);
  });
//});

//анимация для бургера
//$(document).ready(function() {
  document.querySelector('.third-button').addEventListener('click', function () {
    document.querySelector('.animated-icon3').classList.toggle('open');
  });
  document.querySelector('.navbar-nav').addEventListener('click', function () {
    document.querySelector('.animated-icon3').classList.toggle('open');
  });
//});

//смена цвета меню
$(document).scroll(function(e) {
  $(window).scrollTop() > 100 ? $('.navbar').addClass('nav_color') : $('.navbar').removeClass('nav_color');
});

//тут мы получаем из урла наш якорь #...
let hash = $(location).attr('hash');
$(document).ready(function(){
//тут мы создаем из него кук под название hash
document.cookie = cookie_set('hash', hash, 4);
});

$(document).ready(function(){
  //далее мы смотрим, был ли у нас якорь, для этого мы берем переменную которую мы получали в начале и смотрим сколько в ней символов
if(hash.length > 0){
  //если якорь был, то делаем редирект на главную, чтобы убрать якорь из пути
  document.location.href="/";
}});

//после редиректа мы достаем нашу куку, точнее её значение
let hash_cook = getCookie("hash");
$(document).ready(function(){
  //тут мы удаляем первый символ из строчки # потому что он нам не нужен
  let id_hash = hash_cook.slice(1);
  //здесь мы проверяем, если был редирект на попап, то добавляем к попапу класс display: block
  if(id_hash == 'blackout'){
    document.getElementById('blackout').classList.add('active');
  }
  //далее мы получаем расстояние от начала сайта до нашего блока, минус 40 я вычла чтобы еще меню не закрывало контент
  const elementPosition = document.getElementById(id_hash).getBoundingClientRect().top - (40);
  //а тут уже собственно сам скролл до нужного нам блока
    window.scrollBy({
        top: elementPosition,
        behavior: 'smooth'
    });
});
//если есть hash в адрсной   и есть елемент с таким ID
//перемещение и отступы для меню чтобы при скроле не закрывало основной контент
//$(document).ready(function() {
  const menuLinks = document.querySelectorAll( '.nav-link' );
  const header = document.querySelector( '#nav_menu' );
  const navbar =  document.querySelector( '.navbar-nav' );
  for ( let i = 0; i < menuLinks.length; i++ ) {
    menuLinks[i].addEventListener( 'click', function ( event ) {
      event.preventDefault();
      let href = this.getAttribute('href').substring(1);
      const scrollTarget = document.getElementById(href);
      const topOffset = header.offsetHeight;
      const navbarOffset = navbar.offsetHeight;
      const elementPosition = scrollTarget.getBoundingClientRect().top;
      if($(document).width() > 990){
        const offsetPosition = elementPosition - topOffset + (40);
        window.scrollBy({
            top: offsetPosition,
            behavior: 'smooth'
        });
      }else{
        const offsetPosition = elementPosition - topOffset + navbarOffset + (40);
        window.scrollBy({
            top: offsetPosition,
            behavior: 'smooth'
        });
      }
    });
  }
//});

//чтобы меню сворачивалось после клика на ссылки

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
      $('.navbar-collapse a').click(function (e) {
       $('.navbar-collapse').collapse('toggle');
     });
};
