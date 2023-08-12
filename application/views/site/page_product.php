<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>volfglass</title>
	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/common.css">
  <link rel="stylesheet" type="text/css" href="/css/main_css.css">
  <link href="/fotorama/fotorama.css" rel="stylesheet">
	<link href="/easyzoom/css/easyzoom.css" rel="stylesheet">
	<script src="/js/jquery-3.6.3.min.js"></script>
  <script src="/fotorama/fotorama.js"></script>
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<script src="/js/common.js"></script>

	<script src="/easyzoom/dist/easyzoom.js"></script>
</head>
<body background="linear-gradient(90deg, #131113, #302E30)">
  <div id="product">
    <div class="container">
			<div class="block_link"><button id="go-back"><img class="img_arrow" src="/img/close.svg"></button></div>
      <div class="row">
        <div class="col-lg-6 col-sm-12" id="pictures">
          <!--div class="fotorama" data-max-width="100%" data-nav="thumbs"-->
					<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails is-ready">
						<a href="/gl-img/<?=$img_prod[0]['name']?>">
							<img src="/gl-img/<?=$img_prod[0]['name']?>" alt="" class="small_img_size"  />
						</a>
					</div>
					<?if(count($img_prod)>1){?>
						<ul class="thumbnails">
							<?foreach($img_prod as $key => $img){
								?>
								<li><a href="/gl-img/<?=$img['name']?>" data-standard="/gl-img/<?=$img['name']?>"><img src="/gl-img/<?=$img['name']?>" style="width:100px; height: 100px;"></a></li>
							<?}?>
						</ul>
					<?}?>
          <!--/div-->
        </div>
        <div class="col-lg-6 col-sm-12" id="product_descr">
          <h2><?=$prod['name']?></h2>
          <h3><?=$prod['price']?></h3>
          <div class="description"><?=$prod['full_text']?></div>
        </div>
      </div>
    </div>
  </div>
	<script src="/js/my_js.js"></script>
<script>

		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');


</script>
</body>
</html>
