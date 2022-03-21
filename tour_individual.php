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
        <div class="container border border-light">
          <h5 class="oh-desktop"><span class="d-inline-block wow slideInDown">Description</span></h5>
          <p>Aliquam malesuada bibendum arcu vitae elementum curabitur. A erat nam at lectus urna duis convallis convallis tellus. Sit amet consectetur adipiscing elit pellentesque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo sapiente voluptate repellat cum nisi recusandae molestias asperiores. Accusamus provident quae repellendus natus minima nam et iste vel? Animi, deleniti labore. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, sed eligendi beatae nam voluptatem perspiciatis sit pariatur ad quod, exercitationem fuga dignissimos dolores, earum nulla velit rem voluptates blanditiis reprehenderit. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat optio facere magni possimus libero sapiente quae quaerat similique dolorem delectus reprehenderit nisi deserunt voluptates suscipit odio, reiciendis esse, sit odit! Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero sit possimus perferendis. Natus pariatur id sed nemo deleniti fugit, libero corporis voluptates provident nesciunt quaerat tempore quae officiis nam soluta.</p>
        </div>
</section>

<!--Booking Function-->
<section class="section section-sm bg-default">
  <div class="container pt-3 border border-light">
    <div class="pt-3"><h6>Check in: </h6><input type="date"></div>
    <div class="pt-3"><h6>Adults: </h6><input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;"></div>
    <div class="pt-3"><h6>Children: </h6><input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;"></div>
  </div>
  <div class="container pt-4"><button type="button" class="btn btn-primary">Book Now</button></div>
</section>

<!--More Tours-->
<section class="section section-sm bg-default">
        <div class="container">
          <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">More Tours</span></h3>
          <h6 class="pt-2">Check out the other tours!</h6>
          <div class="row row-sm row-40 row-md-50">
            <div class="col-sm-6 col-md-12 wow fadeInRight">
              <!-- Product Big-->
              <article class="product-big">
                <div class="unit flex-column flex-md-row align-items-md-stretch">
                  <div class="unit-left"><a class="product-big-figure" href="#"><img src="images/Melaka-index.jpeg" alt="" width="600" height="366"/></a></div>
                  <div class="unit-body">
                    <div class="product-big-body">
                      <h5 class="product-big-title"><a href="#">Malacca</a></h5>
                      <div class="group-sm group-middle justify-content-start">
                        <div class="product-big-rating"><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star_half"></span></div><a class="product-big-reviews" href="#">4.7/5 (235 customer reviews)</a>
                      </div>
                      <p class="product-big-text">Malacca is one of the most popular tourist destinations within Malaysia. Enjoy an exciting experience at A 'Famosa Malacca when you visit the famous theme...</p><a class="button button-black-outline button-ujarak" href="#">Buy This Tour</a>
                      <div class="product-big-price-wrap"><span class="product-big-price">RM500</span></div>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-md-12 wow fadeInLeft">
              <!-- Product Big-->
              <article class="product-big">
                <div class="unit flex-column flex-md-row align-items-md-stretch">
                  <div class="unit-left"><a class="product-big-figure" href="#"><img src="images/Sarawak-index.jpeg" alt="" width="600" height="366"/></a></div>
                  <div class="unit-body">
                    <div class="product-big-body">
                      <h5 class="product-big-title"><a href="#">Sarawak</a></h5>
                      <div class="group-sm group-middle justify-content-start">
                        <div class="product-big-rating"><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star"></span><span class="icon material-icons-star_half"></span></div><a class="product-big-reviews" href="#">4.8/5 (375 customer reviews)</a>
                      </div>
                      <p class="product-big-text">The State of Sarawak is divided into 3 geographic areas - coastal lowlands comprising peat swamp as well as narrow deltaic and alluvial plains. A large area of...</p><a class="button button-black-outline button-ujarak" href="#">Buy This Tour</a>
                      <div class="product-big-price-wrap"><span class="product-big-price">RM800</span></div>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
</section>

<section class="section section-sm">
        <div class="container">
          <h3>Reviews</h3>
          <h6 class="pt-2">Here's what our customers have to say about their experience!</h6>
          <div class="row row-30">
            <div class="col-sm-6 col-lg-4">
              <article class="box-icon-classic">
                <div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-classic-icon fl-bigmug-line-equalization3"></div>
                  </div>
                  <div class="unit-body">
                    <h5 class="box-icon-classic-title">AshChar02</h5>
                    <p class="box-icon-classic-text">Great place to visit. Love the historical landmarks there!</p>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="box-icon-classic">
                <div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-classic-icon fl-bigmug-line-circular220"></div>
                  </div>
                  <div class="unit-body">
                    <h5 class="box-icon-classic-title">JohnSmith_TourLover</h5>
                    <p class="box-icon-classic-text">Absolutely banging experience. My family and I had tons of fun on our tour.</p>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="box-icon-classic">
                <div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-classic-icon fl-bigmug-line-favourites5"></div>
                  </div>
                  <div class="unit-body">
                    <h5 class="box-icon-classic-title">Mano</h5>
                    <p class="box-icon-classic-text">I'd 100% recommend this tour to my family and friends!</p>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>


<?php require_once "./components/footer.php"; ?>