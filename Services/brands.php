<div class="container carousel1">
  <div class="row">
    <div class="col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="carousel123">
        <div class="carousel-inner carousel2">
          <?php $getBrands = getAllDataWithStatus('services_brand_logos','0'); ?>
          <?php while($getAllBrands = $getBrands->fetch_assoc()) { ?> 
            <div class="item <?php if($getAllBrands['id']==4) { echo "active"; } ?>">
              <div class="col-xs-12 col-sm-2 col-md-2"><img src="<?php echo $base_url . 'uploads/services_brand_logos/'.$getAllBrands['brand_logo'] ?>" class="img-responsive" alt="<?php echo $getAllBrands['title']; ?>" style="width:150px; height:150px;"></div>
            </div>
           <?php } ?> 
        </div>
        <a class="left carousel-control" href="#carousel123" data-slide="prev"><i class="icon-angle-circled-left" style="color:#fe6003"></i></a>
        <a class="right carousel-control" href="#carousel123" data-slide="next"><i class="icon-angle-circled-right"style="color:#fe6003;margin-left:20px"></i></a>
      </div>
    </div>
  </div> 
</div>


