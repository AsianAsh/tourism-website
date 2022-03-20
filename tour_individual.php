<?php session_start(); 
require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 
?>



<section class="section section-sm bg-default">
        <div class="container">
          <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">Tour Name</span></h3>
          <div class="row row-sm row-40 row-md-50">
            <div class="col-sm-6 col-md-12 wow fadeInRight">
            <!--Owl Carousel-->
            <div class="owl-carousel owl-classic owl-dots-secondary" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-xl-items="5" data-xxl-items="6" data-stage-padding="15" data-xxl-stage-padding="0" data-margin="30" data-autoplay="true" data-nav="true" data-dots="true">
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-1-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-1-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-1-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-2-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-2-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-2-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-3-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-3-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-3-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-4-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-4-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-4-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-5-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-5-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-5-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-6-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-6-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-6-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/gallery-image-7-270x195.jpg" alt="" width="270" height="195"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-7-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-7-270x195.jpg" alt="" width="270" height="195"/></a>
              </div>
            </article>  
          </div>
            </div>
          </div>
        </div>
      </section>
<!--Description-->
<section class="section section-sm bg-default">
        <div class="container">
          <h5 class="oh-desktop"><span class="d-inline-block wow slideInDown">Description</span></h5>
          <p>Aliquam malesuada bibendum arcu vitae elementum curabitur. A erat nam at lectus urna duis convallis convallis tellus. Sit amet consectetur adipiscing elit pellentesque.</p>
          <div class="pt-3">
            <div class="d-inline">Check in: <input type="date"></div>
            <div class="d-inline">Adults: <input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;"></div>
            <div class="d-inline">Children: <input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;"></div>
          </div>
          <div class="pt-4"><button type="button" class="btn btn-primary">Book Now</button></div>
        </div>

      </section>
<?php require_once "./components/footer.php"; ?>