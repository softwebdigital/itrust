@extends('frontend.layouts.app')

@section('content')


<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h1 class="display-1 mb-3">Stocks and Funds</h1>
          <!--             <nav class="d-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Blocks</a></li>
              <li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
  <section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
            <h3 class="display-6 mb-10">What is the Stock Market?</h3>
            <p class="mb-3">We’re redefining what it means to learn about finance—and that means education resources
              that are built for today.</p>
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
  <section class="wrapper bg-white">
    <div class="container py-14 py-md-5">
      <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
        <div class="col-lg-6">
          <figure><img class="w-auto" src="img/concept/concept3.png" srcset="img/concept/concept3@2x.png 2x" alt="" />
          </figure>
        </div>
        <!--/column -->
        <div class="col-lg-6">
          <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
          <h3 class="display-5 mb-5 pe-xxl-5">Understanding the stock market</h3>
          <p>Stocks are bought and sold on stock markets, which bring together buyers and sellers of shares in
            publicly traded companies. Stock markets operate kind of like auctions, with potential buyers naming the
            highest price they’re willing to pay (“the bid”) and potential sellers naming the lowest price they’re
            willing to accept (“the ask”). The actual execution of a trade price will be somewhere at or between the
            bid and the ask. Trades can be placed by stockbrokers, usually on behalf of portfolio managers or
            individual investors like you. In the US, the stock market is made up of 13 exchanges—the best known are
            the New York Stock Exchange and the Nasdaq.</p>
          <h3 class="display-5 mb-5 pe-xxl-5">Takeaway</h3>
          <p>Stock markets are complex, but they’re all based upon one simple concept... From New York to Hong Kong,
            every stock market helps connect buyers and sellers, who trade under an agreed upon set of rules.</p>
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>


@endsection
