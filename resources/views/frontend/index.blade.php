@extends('frontend.layouts.app')

@section('styles')
    <style>
        .mockup { width: 60%; margin-bottom: 15px }

        @media (max-width: 992px) {
            .mockup { width: 100% }
        }
    </style>
@endsection

@section('content')


<section class="wrapper bg-soft-primary">
      <div class="container pt-5 pb-15 py-lg-17 py-xl-19 pb-xl-20 position-relative">
        <img class="position-lg-absolute" src="img/photos/Mockup-1.png" srcset="img/photos/Mockup-1.png 2x" data-cue="fadeIn" alt="" style="top: 10%; left: -10%;" />
        <div class="row gx-0 align-items-center">
          <div class="col-md-10 offset-md-1 col-lg-5 offset-lg-7 offset-xxl-6 ps-xxl-12 mt-md-n9 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
            <h1 class="display-3 mb-4 mx-sm-n2 mx-md-0">World class automated stocks and crypto trading bot</h1>
            <p class="lead fs-lg mb-7 px-md-10 px-lg-0">Become a better trader. Powerful, AI-powered stocks and crypto trading bot to help you save time, trade 24/7, and automate your trading.   </p>
            <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
              <span><a href="{{ route('register') }}" class="btn btn-primary btn-icon btn-icon-start rounded me-2"><i class="uil uil-user"></i> Sign Up</a></span>
              <!-- <span><a class="btn btn-green btn-icon btn-icon-start rounded"><i class="uil uil-google-play"></i> Google Play</a></span> -->
            </div>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light" style="top: 50%; left: -23%;">
      <div class="container py-20 py-md-17">
        <div class="row text-center mt-xl-12">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <h2 class="fs-15 text-uppercase text-muted mb-3">Itrust Investment</h2>
            <h3 class="display-4 mb-9 px-xxl-11">Get the best out of our Platform.</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row text-center gy-6 mt-6">
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <!-- <i class="display-1 uil uil-chart"></i> -->
                <p></p>
                <h4>Manage Your Portfolio</h4>
                <p class="mb-2">Keep your portfolio in your pocket. Everything you need to manage your assets is available in a single app. </p>
                <a href="#" class="more hover link-violet">Learn More</a>
                <p></p>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="card bg-pale-aqua">
              <div class="card-body">
                <i class="display-1 uil uil-chart-2"></i>
                <p></p>
                <h4>Learn as You Grow</h4>
                <p class="mb-2">Our goal is to make investing in financial markets more affordable, more intuitive, and more fun, no matter how much experience you have (or don’t have).</p>
                <a href="#" class="more hover link-aqua">Learn More</a>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="card bg-pale-red">
              <div class="card-body">
                <p></p>
                <h4>Keep Tabs on Your Money</h4>
                <p class="mb-2">Set up customized news and notifications to stay on top of your assets as casually or as relentlessly as you like. Controlling the flow of info is up to you.</p>
                <a href="#" class="more hover link-red">Learn More</a>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.card -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-soft-primary">
      <div class="container pt-15 pb-20 pt-md-20 pb-md-19 ">
        <div class="row text-center">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <h2 class="fs-16 text-uppercase text-muted mb-3">Our Features</h2>
            <h3 class="display-4 mb-10 px-xl-10">Automated Your Trading</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative">
          <div class="shape rounded-circle bg-soft-blue rellax w-16 h-16" data-rellax-speed="1" style="bottom: -0.5rem; right: -2.2rem; z-index: 0;"></div>
          <div class="shape bg-dot primary rellax w-16 h-17" data-rellax-speed="1" style="top: -0.5rem; left: -2.5rem; z-index: 0;"></div>
          <div class="row gx-md-5 gy-5 text-center">
            <div class="col-md-6 col-xl-4">
              <div class="card shadow-lg">
                <div class="card-body">
                  <!-- <img src="img/icons/search-1.svg" class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" /> -->
                  <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-robot"></i> </div>
                  <h4>Trading Bots</h4>
                  <p class="mb-2">Copy other traders easily, or trade automatically with our unique trading A.I.</p>
                  <a href="/trading-bots" class="more hover link-yellow">Learn More</a>
                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-4">
              <div class="card shadow-lg">
                <div class="card-body">
                  <!-- <img src="img/icons/chat-2.svg" class="svg-inject icon-svg icon-svg-md text-green mb-3" alt="" /> -->
                  <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-chart-line"></i> </div>
                  <h4>Pro Tools</h4>
                  <p class="mb-2">Use tools like DCA, Market-Making, Arbitrage or our own free of charge charting software.</p>
                  <a href="/pro-tools" class="more hover link-green">Learn More</a>
                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
            <div class="col-md-6 col-xl-4">
              <div class="card shadow-lg">
                <div class="card-body">
                  <!-- <img src="img/icons/megaphone.svg" class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="" /> -->
                  <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-external-link-alt"></i> </div>
                  <h4>Trailing Features</h4>
                  <p class="mb-2">Follow the price movement and sell/buy automatically when the price goes in another direction.</p>
                  <a href="/trailing-feature" class="more hover link-blue">Learn More</a>
                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.position-relative -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-light">
      <div class="container pt-10 pt-md-17 pb-16 pb-md-10">
        <div class="row">
          <div class="col-lg-8 col-xl-7 col-xxl-6">
            <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Easy. Effective. World Class</h2>
            <h3 class="display-4 mb-9">Use expert tools without coding skills</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-md-8 gy-8 mb-14 mb-md-18">
          <div class="col-md-6 col-lg-4">
            <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-copy"></i> </div>
            <h4>Copy Trading</h4>
            <p class="mb-3">Start copy trading for free!</p>
            <p class="mb-3">Don’t let the fear of a market shift keep you up at night. With our A.I., your bot can automatically recognize trends and switch to a better strategy.</p>
            <a href="copy-trading.html" class="more hover link-primary">Learn More</a>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-robot"></i> </div>
            <h4>Automatic Trading</h4>
            <p class="mb-3">Bots don't need sleep.</p>
            <p class="mb-3">Bots don't need sleep. Cryptotrading is 24/7. So is your bot. Give yourself an edge, and while everyone else sleeps, you’ll never miss a beat.</p>
            <a href="automated-trading.html" class="more hover link-primary">Learn More</a>
          </div>
          <!--/column -->
          <div class="col-md-6 col-lg-4">
            <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-android-alt"></i> </div>
            <h4>AI Trading</h4>
            <p class="mb-3">Let your bot learn and decide by itself</p>
            <p class="mb-3">A break-through innovation in trading - this is what the hedge-funds don’t want you to know. AI analyses all the strategies you feed it, and can decide on its own which one it should use.</p>
            <a href="ai-trading.html" class="more hover link-primary">Learn More</a>
          </div>
          <!--/column -->
          
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-soft-primary" style="top: 50%; left: -23%;">
      <div class="container py-14 py-md-17">
        <div class="row gx-lg-8 gx-xl-10 mb-lg-19 mb-xl-1 align-items-center">
          <div class="col-lg-5">
            <figure><img src="img/photos/Mockup-2.png" srcset="img/photos/Mockup-2.png 2x" data-cue="fadeIn" alt="" /></figure>
          </div>
          <!-- /column -->
          <div class="col-lg-7">
            <h2 class="fs-15 text-uppercase text-muted mb-3">How It Works</h2>
            <h3 class="display-4 mb-5">Introducing Fractional Shares</h3>
            <p class="mb-8">Invest in thousands of stocks and cryptos with as little as $1.</p>
          <div class="row gy-6 gx-xxl-8 process-wrapper" data-cues="slideInUp" data-group="process">
              <div class="col-md-6 col-lg-4"> <span class="icon btn btn-circle btn-lg btn-soft-purple disabled mb-4"><span class="number">01</span></span>
                <h4 class="mb-1">Invest Any Amount</h4>
                <p>Choose how much you want  to invest, and we’ll convert from dollars to parts of a whole share.</p>
              </div>
              <!--/column -->
              <div class="col-md-6 col-lg-4"> <span class="icon btn btn-circle btn-lg btn-purple disabled mb-4"><span class="number">02</span></span>
                <h4 class="mb-1">Build a Balanced Portfolio</h4>
                <p>Customize your portfolio with pieces of different stocks, cryptocurrencies and products to help reduce risk.</p>
              </div>
              <!--/column -->
              <div class="col-md-6 col-lg-4"> <span class="icon btn btn-circle btn-lg btn-soft-purple disabled mb-4"><span class="number">03</span></span>
                <h4 class="mb-1">Trade in Real Time</h4>
                <p>Trades placed during market hours are executed at that  time, so you’ll always know the share price.</p>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
            <!--/.row -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

    <section class="wrapper bg-light">
      <br><br><br>
      <div class="container py-14 pt-md-16 pt-lg-15 pb-md-16">
        <div class="row">
            <div class="row align-items-center">
              <div class="col-lg-10">
                <h2 class="display-5 mb-7">Our Products</h2>
                <ul class="nav nav-tabs nav-pills">
                  <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab1-1"><i class="uil uil-bitcoin pe-1"></i><span>Crypto</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab1-2"><i class="uil uil-usd-circle pe-1"></i><span>Cash Management</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab1-3"><i class="uil uil-chart-line pe-1"></i><span>Stocks & Funds</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab1-4"><i class="uil uil-plus-circle pe-1"></i><span>Options</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab1-5"><i class="uil uil-gold pe-1"></i><span>Gold</span></a> </li>
                </ul>
                <!-- /.nav-tabs -->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tab1-1">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                      <div class="col-lg-4">
                        <figure><img class="w-auto" src="img/photos/main/crypto.jpeg" srcset="img/photos/main/crypto.jpeg 3x" alt="" /></figure>
                      </div>
                      <!--/column -->
                      <div class="col-lg-6">
                        <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
                        <h3 class="display-5 mb-7 pe-xxl-5">Crypto</h3>
                          <p>Tap into the cryptocurrency market to buy, HODL, and sell Bitcoin, Ethereum, Dogecoin, and more, 24/7 with Itrust Crypto.</p>
                      </div>
                      <!--/column -->
                    </div>
                  </div>
                  <!--/.tab-pane -->
                  <div class="tab-pane fade" id="tab1-2">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                      <div class="col-lg-4">
                        <figure><img class="w-auto" src="img/photos/main/cash-management.jpeg" srcset="img/photos/main/cash-management.jpeg 3x" alt="" /></figure>
                      </div>
                      <!--/column -->
                      <div class="col-lg-6">
                        <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
                        <h3 class="display-5 mb-7 pe-xxl-5">Cash Management</h3>
                          <p>Earn 13.30% APY* on your uninvested cash and get more flexibility with your brokerage account.</p>
                      </div>
                      <!--/column -->
                    </div>
                  </div>
                  <!--/.tab-pane -->
                  <div class="tab-pane fade" id="tab1-3">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                      <div class="col-lg-4">
                        <figure><img class="w-auto" src="img/photos/main/stocks-funds.jpeg" srcset="img/photos/main/stocks-funds.jpeg 3x" alt="" /></figure>
                      </div>
                      <!--/column -->
                      <div class="col-lg-6">
                        <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
                        <h3 class="display-5 mb-7 pe-xxl-5">Stocks & Funds</h3>
                          <p>Get mobile access to the markets. Invest commission-free in individual companies or bundles of investments (ETFs).</p>
                      </div>
                      <!--/column -->
                    </div>
                  </div>
                  <!--/.tab-pane -->
                   <div class="tab-pane fade" id="tab1-4">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                      <div class="col-lg-4">
                        <figure><img class="w-auto" src="img/photos/main/options.jpeg" srcset="img/photos/main/options.jpeg 3x" alt="" /></figure>
                      </div>
                      <!--/column -->
                      <div class="col-lg-6">
                        <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
                        <h3 class="display-5 mb-7 pe-xxl-5">Options</h3>
                          <p>Be bullish on stocks you believe in and bearish on the ones you don’t. It’s your call.</p>
                      </div>
                      <!--/column -->
                    </div>
                  </div>
                  <!--/.tab-pane -->
                   <div class="tab-pane fade" id="tab1-5">
                    <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-16 align-items-center">
                      <div class="col-lg-4">
                        <figure><img class="w-auto" src="img/photos/main/gold.png" srcset="img/photos/main/gold.png 2x" alt="" /></figure>
                      </div>
                      <!--/column -->
                      <div class="col-lg-6">
                        <!-- <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Radical Customer Focus</h2> -->
                        <h3 class="display-5 mb-7 pe-xxl-5">Gold</h3>
                          <p>Access research reports, trade on margin at a 12.5% annual rate, and make bigger deposits with quicker access to funds—all starting $50 per month.</p>
                      </div>
                      <!--/column -->
                    </div>
                  </div>
                  <!--/.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section --> 


    <section class="wrapper bg-soft-primary">
      <div class="container py-14 py-md-16">
        <div class="row">
          <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 mx-auto text-center">
            <h2 class="fs-15 text-uppercase text-muted mb-3">Happy Customers</h2>
            <h3 class="display-4 mb-6 px-xl-10 px-xxl-15">Don't take our word for it. See what customers are saying about us.</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div data-cue="fadeIn">
          <div class="carousel owl-carousel gap-small" data-margin="0" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“They are great and fast. I highly recommend this broker. You are welcome to check it out. They have training and good information for new clients. Excellent client relationship. Comparing to other brokers, this is the best. ”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te7.jpg" srcset="img/avatars/te7@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Elisha</h5>
                          <p class="mb-0">Allen, Texas </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“Itrust Investment has a good easy to use format. It has research tools as well as videos on how to use the site. They have helped online and also personal help by phone. Good service and low-cost commissions. ”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te8.jpg" srcset="img/avatars/te8@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">William</h5>
                          <p class="mb-0">Leavenworth, KS </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“I got switched over to Itrust since my other company closed down. I was happy to see that Itrust is easy to work online and easy to understand, I am not that computer savvy, so it is very user friendly.”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te9.jpg" srcset="img/avatars/te9@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Mary</h5>
                          <p class="mb-0">Larkspur, CA </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“I am new at online trading. So after researching and asking around. I decided to online apply.. I have received superior service via mail and email, with an option to contact a specific person should the time come. ”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te10.jpg" srcset="img/avatars/te10@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Andy </h5>
                          <p class="mb-0">Salisbury, MD </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“Some personal service is available, but mostly the customer has to find his own answer and the TD Ameritrade website is quite excellent. If you can navigate a website you will be able to find out all the information that you may need. ”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te11.jpg" srcset="img/avatars/te11@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Anna</h5>
                          <p class="mb-0">Charleston, SC</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“They are always accessible, always right. Trades are done quickly and with good prices. I would highly recommend them. They have waived fees for some reorganizations but not all. A broker is available by phone if you have questions.”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te12.jpg" srcset="img/avatars/te12@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Jim</h5>
                          <p class="mb-0">Menifee, CA </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“Ready with help when I call. Webpages easy to understand and navigate. In addition, Itrust has a help desk one can access from the web. Overall, best I have used so far. One can easily print out statements or other information from this site.”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te10.jpg" srcset="img/avatars/te10@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Samuel </h5>
                          <p class="mb-0">Rancho Mirage, CA </p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“Excellent choices with a great service. Value for the price is also very good. Some of the lowest fees for brokerage. Really flexible choices from a vast portfolio. We have had the account with them for a while and never complained. Solid background with solid choices.”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te10.jpg" srcset="img/avatars/te10@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">Catalin </h5>
                          <p class="mb-0">Fort Thomas, KY</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
            <div class="item">
              <div class="item-inner">
                <div class="card">
                  <div class="card-body">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="icon mb-0">
                      <p>“Always easy to contact, polite and no hidden fees, help is great. Documents are very easy to understand and access. Great experience. Their website is one of the best laid out and easy to navigate. I have ever used and I very highly recommend this company.”</p>
                      <div class="blockquote-details">
                        <!-- <img class="rounded-circle w-12" src="img/avatars/te10.jpg" srcset="img/avatars/te10@2x.jpg 2x" alt="" /> -->
                        <div class="info">
                          <h5 class="mb-0">S. H. </h5>
                          <p class="mb-0">Soddy Daisy, TN</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.item-inner -->
            </div>
            <!-- /.item -->
          </div>
          <!-- /.owl-carousel -->
        </div>
        <!-- /div -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->


@endsection
