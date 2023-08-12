
<section id="catalog">
  <div class="container">
          <h2>КАТАЛОГ</h2>
          <div class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
            <?foreach($category as $key=>$cat){
              if($cat['id']==1){?>
            <button class="nav-link link-pill active" id="<?=$cat['url_category']?>-tab" data-bs-toggle="pill" data-bs-target="#<?=$cat['url_category']?>" type="button" role="tab" aria-controls="<?=$cat['url_category']?>" aria-selected="true"><?=$cat['category']?></button>
            <?} else {?>
            <button class="nav-link link-pill" id="<?=$cat['url_category']?>-tab" data-bs-toggle="pill" data-bs-target="#<?=$cat['url_category']?>" type="button" role="tab" aria-controls="<?=$cat['url_category']?>" aria-selected="false"><?=$cat['category']?></button>
            <?}?>
            <?}?>
          </div>
        </nav>
<?//print_r($products)?>
    <div class="tab-content" id="nav-tabContent">
      <?foreach($category as $key=>$cat){?>
      <div class="tab-pane fade show" id="<?=$cat['url_category']?>" role="tabpanel" aria-labelledby="<?=$cat['url_category']?>-tab">
        <div class="container">
          <div class="row">
            <?foreach ($category_products as $key=>$cp){//перебираем категории товаров, чтобы собрать удобный массив
              $categ[]=$cp['category'];}
              if(in_array($cat['id'],$categ)){//если данная категория найдена в массиве, значит товар с такой категорией существует
                foreach($products as $key=>$product){//вывод товаров
                  if($cat['id']==$product['category']){?>
                    <div class="col-xl-4 col-md-6 col-6 d-flex">
                      <div class="card">
                        <div class="img-card"><a href="/catalog/<?=$product['page_url']?>"><img src="upload/<?=$product['img']?>" alt="..."></a></div>
                        <div class="card-body">
                          <a href="/catalog/<?=$product['page_url']?>" class="card-name"><?=$product['name']?></a>
                          <p class="card-price"><?=$product['price']?></p>
                        </div>
                      </div>
                    </div>
                  <?}?>
                <?}?>
              <?}else{?>
                <span style="font-size: 20px;">В данной категории временно отсутствуют товары</span>
                <?}?>
          </div>
        </div>
      </div>
      <?}?>
      </div>
  </div>
</section>
