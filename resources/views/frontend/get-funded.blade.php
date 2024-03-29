@extends('frontend.layouts.app')

@section('content')

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-20 pt-md-14 pb-md-23 text-center">
        <div class="row">
          <div class="col-xl-5 mx-auto mb-6">
            <h1 class="display-1 mb-3">Our Fund, Your Profit</h1>
            <p></p><br>
            <p class="display-6 mb-3"><b>Funding Promising Traders Worldwide</b></p>
            <p>Maximize Your Trading Success with Itrust Investment: Trade up to $1,000,000 on a Itrust Account and earn up to 90% of the profits.</p>
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
            <h3 class="display-5 mb-7 pe-xxl-5">15% Profit Sharing from Challenge Phase</h3>
              <p>Itrust is the only prop firm to offer a 15% profit sharing from the profit you make during the challenge phases. This is to incentivize our top traders and to deliver on our promise of the world’s best payout bonuses.</p>
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
            <h3 class="display-5 mb-7">No Time Limit on Challenge Phase</h3>
              <p>Itrust offers no time limits in its funding challenges. This means that you can trade with complete peace of mind. No more anxiety to reach the profit target within a deadline.</p>
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

    <section class="wrapper bg-white">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
          <div class="col-lg-6">
            <figure><img class="w-auto" src="img/photos/main/trading-bots-2.jpeg" srcset="img/photos/main/trading-bots-2.jpeg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Balance Based Drawdown</h3>
              <p>Max daily drawdown is calculated based on your balance. If you have trades running when a new trading day starts, the ‘balance’ at that time will be considered for Daily drawdown calculation, not the ‘equity’. This is to deliver on our promise of the world's most reliable prop firm.</p>
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
            <h3 class="display-5 mb-7">Raw Spreads & Lowest Commissions</h3>
              <p>Itrust ensures raw spread, including in Swap Free accounts to deliver on its promise of the world’s best prop trading conditions. Itrust also offers the lowest commissions for traders with 3$/round lot on Stock & Commodities and 0$/round lot on Cryptocurrency.</p>
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

    @include('frontend.layouts.bots')

@endsection