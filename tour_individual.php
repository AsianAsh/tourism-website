<?php session_start(); 
require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 
?>



<!--Tour Display and Gallery-->
<section class="section section-sm section-fluid bg-default">
        <div class="container">
          <h3>/Tour Name/</h3>
        </div>
        <!-- Owl Carousel-->
        <div class="owl-carousel owl-classic owl-timeline" data-items="1" data-md-items="2" data-lg-items="3" data-xl-items="4" data-margin="30" data-autoplay="false" data-nav="true" data-dots="true">
          <div class="owl-item">
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/france.jpg" alt="" width="420" height="308"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-11-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-11-420x308.jpg" alt="" width="420" height="308"/></a>
              </div>
            </article>
          </div>
          <div class="owl-item">
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/pulau2.jpg" alt="" width="420" height="308"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-12-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-12-420x308.jpg" alt="" width="420" height="308"/></a>
              </div>
            </article>
          </div>
          <div class="owl-item">
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/pulau3.jpg" alt="" width="420" height="308"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-13-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-13-420x308.jpg" alt="" width="420" height="308"/></a>
              </div>
            </article>
          </div>
          <div class="owl-item">
            <!-- Thumbnail Classic-->
            <article class="thumbnail thumbnail-mary">
              <div class="thumbnail-mary-figure"><img src="images/Stadthuys.jpeg" alt="" width="420" height="308"/>
              </div>
              <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-14-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-14-420x308.jpg" alt="" width="420" height="308"/></a>
              </div>
            </article>
          </div>
        </div>
      </section>
<!--Navbar for Tour Info, Description and Reviews-->
<!-- echo nl2br(str_replace('[NEWLINE]', "\n", $tour['description'])); -->
 <section class="container mt-5">
        <nav class="specific-tabs-section">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class=" nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Info</button>
                <button class=" nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Description</button>
                <button class=" nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Review</button>
                <button class=" nav-link" id="nav-booknow-tab" data-bs-toggle="tab" data-bs-target="#nav-booknow" type="button" role="tab" aria-controls="nav-booknow" aria-selected="false">Book Now</button>
            </div>
        </nav>
        <div class="tab-content mt-3" id="nav-tabContent">
            <!-- Info Tab Content-->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="specific-item-info">
                <div>
                  <p class="specific-item-property fw-bold">Tour Details</p>
                  <p></p>
                </div>
              </div>
            </div>
            <!-- End of Info Tab Content -->

            <!-- Description Tab Content -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet ipsa fugit dignissimos rerum maiores, quia ut aliquid, minus ex eius facilis illum itaque assumenda vel, nemo eos? Enim, quos facere.</p>
            </div>
            <!-- End of Description Tab Content -->
            
            <!-- Review Tab Content-->
                <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                    <div class="">
                        <div class="review-inner-section">
                            <div class="review-header-section">
                                <div class="ratings align-self-start">
                                    <h3>Ratings</h3>
                                    <!-- 5 Star Icons & Total 5 Star Ratings-->
                                    <div class="mb-2">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <span class="ms-2">(0)</span>
                                    </div>
                                    <!-- End of 5 Star Icons & Total 5 Star Ratings-->
                                    
                                    <!-- 4 Star Icons & Total 4 Star Ratings-->
                                    <div class="mb-2">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <span class="ms-2">(0)</span>
                                    </div>
                                    <!-- End of 4 Star Icons & Total 4 Star Ratings-->

                                    <!-- 3 Star Icons & Total 3 Star Ratings-->
                                    <div class="mb-2">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <span class="ms-2">(0)</span>
                                    </div>
                                    <!-- End of 3 Star Icons & Total 3 Star Ratings-->

                                    <!-- 2 Star Icons & Total 2 Star Ratings-->
                                    <div class="mb-2">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <span class="ms-2">(0)</span>
                                    </div>
                                    <!-- End of 2 Star Icons & Total 2 Star Ratings-->

                                    <!-- 1 Star Icons & Total 1 Star Ratings-->
                                    <div class="mb-2">
                                        <img src="./svg/star-fill.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <img src="./svg/star-fill-white.svg" alt="">
                                        <span class="ms-2">(0)</span>
                                    </div>
                                    <!-- End of 1 Star Icons & Total 1 Star Ratings-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                            
            <!-- End of Review Tab Content-->

            <!--Book Now Tab Content-->
            <div class="tab-pane fade" id="nav-booknow" role="tabpanel" aria-labelledby="nav-booknow-tab">
              <div class="pt-3">
                <h6>Check in: </h6><input type="date">
              </div>
              <div class="pt-3">
                <h6>Adults: </h6><input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;">
              </div>
              <div class="pt-3">
                <h6>Children: </h6><input type="number" name="Quantity" id="Quantity" value="1" min="1" max="99" style="height: 30px;">
              </div>
              <div class="container pt-4">
                <button type="button" class="btn btn-primary">Book Now</button></div>
              </div>
            </div>

    <!-- End of Nav and Tab for Info, Description, Review -->
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
                      <p class="product-big-text">Malacca is one of the most popular tourist destinations within Malaysia. Enjoy an exciting experience at A 'Famosa Malacca when you visit the famous theme...</p><a class="button button-black-outline button-ujarak" href="payment.php">Buy This Tour</a>
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




<?php require_once "./components/footer.php"; ?>