@extends('frontend.layouts.app')

@section('content')

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-20 pt-md-14 pb-md-23 text-center">
        <div class="row">
          <div class="col-xl-5 mx-auto mb-6">
            <h1 class="display-1 mb-3">Copy Trading</h1>
            <p></p><br>
            <!-- <p class="display-6 mb-3"><b>Let your bot learn and decide by itself</b></p> -->
            <p>Don’t let the fear of a market shift keep you up at night. With our A.I., your bot can automatically recognize trends and switch to a better strategy.</p>
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
            <figure><img class="w-auto" src="img/photos/main/copy-trading-1.png" srcset="img/photos/main/copy-trading-1.png 2x" alt="" /></figure>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-6 mb-10 align-items-center">
          <div class="col-lg-6 order-lg-2">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Participation is Power</h2> -->
            <h3 class="display-5 mb-5">Allow all coins for signals </h3>
            <p>Allow all coins to receive signals for all coins that are available with your selected quote currency on your exchange. This is a Hero Bot feature. </p>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Safety First</h2> -->
            <h3 class="display-5 mb-5">Copy trading </h3>
            <p>Officially called “Mirror Trading,” copy trading is when you follow experts on our platform and have them decide when to buy or sell. There are several ways for you to copy traders on our platform; follow Signalers or use other traders’ strategies and Hopper templates.</p>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-gray">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
          <div class="col-lg-6">
            <figure><img class="w-auto" src="img/photos/main/copy-trading-2.jpeg" srcset="img/photos/main/copy-trading-2.jpeg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Trading Signals</h3>
              <p>Itrust investment Platform offers everything for beginners and experienced crypto traders. For beginners, it is a great gateway to automated trading as there are plenty of experience traders selling trading signals, templates, and strategies. An explanation is given for all of these services so you know what trading styles you can buy. </p>
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