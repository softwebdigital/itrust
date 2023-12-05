@extends('frontend.layouts.app')

@section('content')

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-20 pt-md-14 pb-md-23 text-center">
        <div class="row">
          <div class="col-xl-5 mx-auto mb-6">
            <h1 class="display-1 mb-3">Trading Bots</h1>
            <p></p><br>
            <p class="display-6 mb-3"><b>Trading Options</b></p>
            <p>Don’t let the fear of a market shift keep you up at night. With our A.I., your bot can automatically recognize trends and switch to a better strategy.</p>
            <p>
              <span data-cues="slideInDown" data-group="page-title-buttons" data-delay="900"><a class="btn btn-primary btn-icon btn-icon-start rounded me-2"> Get Started <i class="uil uil-arrow-right"></i></a></span>
            </p>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container pb-14 pb-md-16">
        <div class="row text-center mb-12 mb-md-15">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mt-n18 mt-md-n22">
            <figure><img class="w-auto" src="img/photos/main/trading-bots-1.png" srcset="img/photos/main/trading-bots-1.png 2x" alt="" /></figure>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <section class="wrapper bg-light">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
              <h3 class="display-6 mb-10">Apps are third-party applications that you can use in combination with Itrust. These apps increase the functionality of Itrust.</h3>
            </div>
          <!-- /column -->
        </div>
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <!-- /section -->
    <section class="wrapper bg-white">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
          <div class="col-lg-6">
            <figure><img class="w-auto" src="img/photos/main/trading-bots-2.jpeg" srcset="img/photos/main/trading-bots-2.jpeg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Portfolio Management</h3>
              <p>Manage your complete portfolio with Cryptohopper, all from one place. Did you know that the basic functionality of our platform is free? Our Full package offers free manual trading. Connect all your Exchanges by creating Bots and linking them to your exchange accounts.</p>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-lg-6 order-lg-2">
            <figure><img class="w-auto" src="img/photos/main/trading-bots-3.jpg" srcset="img/photos/main/trading-bots-3.jpg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">First-Principles Thinking</h2> -->
            <h3 class="display-5 mb-7">Automatic Trading</h3>
              <p>Automatic trading is the holy grail of trading and probably the reason why you're here in the first place. Automatic trading is a revolutionary way of trading and hasn't been available to retail traders for a while. The reason: it can be pretty complicated. Luckily, making automatic trading easy is our core business...</p>
            <p>
              <span data-cues="slideInDown" data-group="page-title-buttons" data-delay="900"><a class="btn btn-primary btn-icon btn-icon-start rounded me-2"> Get Started <i class="uil uil-arrow-right"></i></a></span>
            </p>
            </div>
            <!--/.accordion -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    @include('frontend.layouts.bots')

@endsection