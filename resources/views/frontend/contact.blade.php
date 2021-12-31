@extends('frontend.layouts.app')

@section('content')



<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h1 class="display-1 mb-3">Contact Us</h1>
          <!--             <nav class="d-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Blocks</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
          </nav> -->
          <!-- /nav -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->

  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row">
        <div class="col-xl-5 mx-auto">
          <div class="card">
            <div class="row gx-0">
              <!-- <div class="col-lg-6 align-self-stretch"> -->
              <!--                   <div class="map map-full rounded-top rounded-lg-start">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12689.82598376783!2d-122.02156526949733!3d37.3317!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x63bb79532baa6af4!2sApple%20Campus!5e0!3m2!1sen!2str!4v1583842280816!5m2!1sen!2str" style="width:100%; height: 100%; border:0" allowfullscreen></iframe>
                </div> -->
              <!-- /.map -->
              <!-- </div> -->
              <!--/column -->
              <div class="col-lg-12">
                <div class="p-10 p-md-11 p-lg-14">
                  <div class="d-flex flex-row">
                    <div>
                      <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                    </div>
                    <div class="align-self-start justify-content-start">
                      <h5 class="mb-1">Address</h5>
                      <address>57 Stamford St London <br>London, London, SE1 9LX <br>United Kingdom</address>
                    </div>
                  </div>
                  <!--/div -->
                  <div class="d-flex flex-row">
                    <div>
                      <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                    </div>
                    <div>
                      <h5 class="mb-1">Phone</h5>
                      <p><a href="tel:+447418442063"> +44 7418-4420630</a></p>
                    </div>
                  </div>
                  <!--/div -->
                  <div class="d-flex flex-row">
                    <div>
                      <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                    </div>
                    <div>
                      <h5 class="mb-1">E-mail</h5>
                      <p class="mb-0"><a href="mailto:info@itrustinvestment.com"
                          class="link-body">info@itrustinvestment.com</a></p>
                    </div>
                  </div>
                  <br>
                  <p class="mb-0">Want to create an account? <a href="https://app.itrustinvestment.com/register"
                      class="link-body">Click Here.</a></p>
                  <!--/div -->
                </div>
                <!--/div -->
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16 text-center">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
          <img src="img/icons/puzzle-2.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
          <h2 class="display-4 mb-3">Join Our Community</h2>
          <p class="lead fs-lg mb-6 px-xl-10 px-xxl-15">We are trusted by over 5000+ clients. Join them by using our
            services and grow your business.</p>
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-4 mx-auto">
          <div class="newsletter-wrapper">
            <!-- Begin Mailchimp Signup Form -->
            <div id="mc_embed_signup2">
              <form
                action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a"
                method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate"
                target="_blank" novalidate>
                <div id="mc_embed_signup_scroll2">
                  <div class="mc-field-group input-group form-label-group">
                    <input type="email" value="" name="EMAIL" class="required email form-control"
                      placeholder="Email Address" id="mce-EMAIL2">
                    <label for="mce-EMAIL2">Email Address</label>
                    <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2"
                      class="btn btn-primary">
                  </div>
                  <div id="mce-responses2" class="clear">
                    <div class="response" id="mce-error-response2" style="display:none"></div>
                    <div class="response" id="mce-success-response2" style="display:none"></div>
                  </div>
                  <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                  <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                      name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1" value=""></div>
                  <div class="clear"></div>
                </div>
              </form>
            </div>
            <!--End mc_embed_signup-->
          </div>
          <!-- /.newsletter-wrapper -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->



@endsection
