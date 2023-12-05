@extends('frontend.layouts.app')

@section('content')

<section class="wrapper bg-soft-primary">
      <div class="container pt-10 pb-20 pt-md-14 pb-md-23 text-center">
        <div class="row">
          <div class="col-xl-5 mx-auto mb-6">
            <h1 class="display-1 mb-3">AI TRADING(Algorithm Intelligence) </h1>
            <p></p><br>
            <p class="display-6 mb-3"><b>Let your bot learn and decide by itself</b></p>
            <p>A break-through innovation in trading - this is what the hedge-funds don’t want you to know. AI analyses all the strategies you feed it, and can decide on its own which one it should use. </p>
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
            <figure><img class="w-auto" src="img/photos/main/ai-trading-1.png" srcset="img/photos/main/ai-trading-1.png 2x" alt="" /></figure>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-lg-8 gx-xl-12 gy-6 mb-10 align-items-center">
          <div class="col-lg-6 order-lg-2">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Participation is Power</h2> -->
            <h3 class="display-5 mb-5">Once you’ve fed your AI, <br>It’s time to train. Train AI</h3>
            <p> When you’ve imported all your strategies, it’s time to train your AI. Rate and rank all your strategies at once, for every market you’re active on. Your AI will rate and rank all strategies for you, and pick the best for the current market. </p>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Safety First</h2> -->
            <h3 class="display-5 mb-5">Adapt to changing markets <br>Your pocket hedge-fund </h3>
            <p>Hedge-funds don’t have one strategy to rule them all. They have hundreds of strategies and constantly switch between them to optimize trading. Now you can do the same thing. Your AI will scan for changing trends and adapt accordingly for every trading pair. </p>
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
            <figure><img class="w-auto" src="img/photos/main/ai-trading-2.jpg" srcset="img/photos/main/ai-trading-2.jpg 2x" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
            <h3 class="display-5 mb-7 pe-xxl-5">Automatically backtest all your strategies. Simultaneously. </h3>
              <p>Imagine having hundreds of strategies, using signals and even TradingView? Combine all of these and import them all into your AI. </p>
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