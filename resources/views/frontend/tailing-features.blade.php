@extends('frontend.layouts.app')

@section('content')

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-5 pt-md-14 text-center">
        <div class="row">
          <div class="col-xl-5 mx-auto mb-6">
            <h1 class="display-1 mb-3">Trailing Orders</h1>
            <p></p><br>
            <p class="display-6 mb-3"><b>Better buys & sells,<br>the easy way</b></p>
            <p>Sell or buy based on price direction. Sell a profiting position automatically when the price goes down, let your buy order track the price, and initiate the buy when the price goes up again.</p>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-gray">
      <div class="container py-14">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
          <div class="col-lg-6">
            <figure><img class="w-auto" src="img/photos/main/trailing-orders.jpeg" srcset="img/photos/main/trailing-orders.jpeg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Trading Signals</h3>
              <p>Itrust investment Platform offers everything for beginners and experienced crypto traders. For beginners, it is a great gateway to automated trading as there are plenty of experience traders selling trading signals, templates, and strategies. An explanation is given for all of these services so you know what trading styles you can buy. </p>

            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Protect yourself for further losses</h3>
              <p>Sell a position automatically and let the price go down. Your Bot will automatically buy the position back once the price goes up again, protecting you from further losses.</p>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>

    @include('frontend.layouts.bots')
    <!-- /section -->

@endsection