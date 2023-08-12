<section id="call_back">
  <div class="mask"></div>
  <div class="container form-cb">
    <h2>ОСТАЛИСЬ ВОПРОСЫ?</h2>
    <div class="mb-4">
      <span style="font-size: 25px;">Напишите нам</span>
    </div>
    <?php $array = $this->session->all_userdata();
    //print_r($array);?>
    <?php echo form_open('',array('id' => 'myform'));
    ?>
      <div class="mb-4">
        <div class="form-outline">
          <input type="text" name="name" id="name" placeholder="Имя" class="form-control <?=isset($array['error_name']) ? $array['error_name'] : ''?> input-style" value="<?php echo isset($array['name']) ? $array['name'] : '' ?>" />
        </div>
        <span style="text-align:left;"><?=isset($array['error_mes_name']) ? $array['error_mes_name'] : ''?></span>
      </div>
      <!--div class="mb-4">
        <div class="form-outline">
          <input type="tel" name="tel" id="tel" placeholder="Телефон" class="form-control <?=isset($array['error_tel']) ? $array['error_tel'] : ''?> input-style" value="<?php echo isset($array['tel']) ? $array['tel'] : '' ; ?>" />
        </div>
        <span style="text-align:left;"><?=isset($array['error_mes_tel']) ? $array['error_mes_tel'] : ''?></span>
      </div-->
      <div class="mb-4">
        <div class="form-outline">
          <input type="email" name="email" id="email" placeholder="Email" class="form-control <?=isset($array['error_email']) ? $array['error_email'] : ''?> input-style" value="<?php echo isset($array['email']) ? $array['email'] : '' ; ?>"/>
        </div>
        <span style="text-align:left;"><?=isset($array['error_mes_email']) ? $array['error_mes_email'] : ''?></span>
      </div>
      <div class="mb-4">
        <div class="form-outline mes">
          <textarea rows="5" name="message" id="message" placeholder="Сообщение" class="form-control <?=isset($array['error_message']) ? $array['error_message'] : ''?> input-style"><?php echo isset($array['message']) ? $array['message'] : '' ; ?></textarea>
        </div>
        <span style="text-align:left; margin-bottom: 20px;"><?=isset($array['error_mes_message']) ? $array['error_mes_message'] : ''?></span>
      </div>
      <button class="send" type="submit" class="mb-4">Отправить</button>
      <?=$this->session->flashdata('msg');?>
    </form>
    <div class="mt15">
      <div class="dib align-middle">
        <span class="font-icon-size">Заказ можно сделать через социальные сети</span>
      </div>
      <div class="dib icon_margin">
        <!--div class="dib align-middle">
          <a href="https://t.me/VolkGlass" target="_blank"><img class="icon-animation" src="/img/tg_logo_1.svg"></a>
        </div-->
        <div class="dib align-middle ml10">
          <a href="https://wa.me/79122455380" target="_blank"><img class="icon-animation" src="/img/wa_logo.svg"></a>
        </div>
        <!--div class="dib align-middle ml10">
          <a href="https://vk.com/id23757617" target="_blank"><img class="icon-animation" src="/img/vk_logo.svg"></a>
        </div-->
      </div>
    </div>

    <div id="blackout">
        <div id="letterSend">
          <div class="block_link"><button id="close_message"><img class="img_arrow" src="/img/close.svg"></button></div>
          Ваше письмо успешно отправлено!
        </div>
      </div>
  </div>
</section>



<footer id="contact">
  <div class="container">
    <a href="/"><img src="img/logo.png" class="logo_foot"></a>
    <div class="mt10">
    <a href="https://t.me/VolkGlass" target="_blank" class="footer_btn mr10"><article><img src="img/tg_logo_1.svg" height="30"></article></a>
    <a href="https://wa.me/79122455380" target="_blank" class="footer_btn mr10"><article><img src="img/wa_logo.svg" height="30"></article></a>
    <a href="https://vk.com/id23757617" target="_blank" class="footer_btn"><article><img src="img/vk_logo.svg" height="30"></article></a>
    </div>
  </div>
</footer>


<script src="/js/my_js.js"></script>
<script type="module">
  import PhotoSwipeLightbox from '/photoswipe/dist/photoswipe-lightbox.esm.js';
  import PhotoSwipe from '/photoswipe/dist/photoswipe.esm.js';
  const lightbox = new PhotoSwipeLightbox({
    gallery: '#my-gallery',
    children: 'a',
    pswpModule: PhotoSwipe
  });
  lightbox.init();
  </script>
    <script>
    /*const btnArrow = document.querySelector(".arrow");
const sectionText = document.querySelector("#gallery");



function scrollTo(element) {
  const header = document.querySelector( '#nav_menu' );
  const len = element.offsetTop - header.offsetHeight + (40);
  window.scroll({
    behavior: 'smooth',
    left: 0,
    top: len,
  });
}

btnArrow.addEventListener('click', () => {
  scrollTo(sectionText);
});

    document.querySelector('.third-button').addEventListener('click', function () {
    document.querySelector('.animated-icon3').classList.toggle('open');
    });
    document.querySelector('.navbar-nav').addEventListener('click', function () {
    document.querySelector('.animated-icon3').classList.toggle('open');
    });
    $(document).scroll(function(e) {
      $(window).scrollTop() > 100 ? $('.navbar').addClass('nav_color') : $('.navbar').removeClass('nav_color');
  });


  //если есть hash в адрсной   и есть елемент с таким ID
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
        // const topOffset = 0; // если не нужен отступ сверху
        const elementPosition = scrollTarget.getBoundingClientRect().top;
        if($(document).width() > 990){
        const offsetPosition = elementPosition - topOffset + (40);

        window.scrollBy({
            top: offsetPosition,
            behavior: 'smooth'
        });}else{
          const offsetPosition = elementPosition - topOffset + navbarOffset + (40);

          window.scrollBy({
              top: offsetPosition,
              behavior: 'smooth'
          });
        }
        } );
    }

    $('.navbar-collapse a').click(function (e) {
      $('.navbar-collapse').collapse('toggle');
    });*/
  </script>



</body>
</html>
