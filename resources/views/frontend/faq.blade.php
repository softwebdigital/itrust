@extends('frontend.layouts.app')

@section('content')


<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h1 class="display-1 mb-3">Frequently Asked Questions</h1>
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
  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10">
        <div class="col-lg-3 mb-0">
          <h2 class="fs-15 text-uppercase text-primary mb-3">FAQ</h2>
          <h3 class="display-5 mb-4">General</h3>
        </div>
        <!--/column -->
        <div class="col-lg-9">
          <div id="accordion-3" class="accordion-wrapper">
            <div class="card">
              <div class="card-header" id="accordion-heading-2-1">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-1"
                  aria-expanded="false" aria-controls="accordion-collapse-3-1">How do I contact customer
                  support?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-3-1" class="collapse" aria-labelledby="accordion-heading-3-1"
                data-bs-target="#accordion-3">
                <div class="card-body">
                  <p>You can contact our support team from the app or website. We’re available 24/7 by email for all
                    inquiries.</p>
                  <p>For timely concerns, including account security, bank transfer issues, equities trading,
                    restrictions, and options, you can also request phone support in the app from 8 AM to 8 PM ET,
                    Monday through Friday. We offer 24-hour coverage on trading days for options.</p>
                  <p>Please note that we’re unable to service customers at our office locations and we don’t have an
                    inbound number for phone support.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-3-2">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-2"
                  aria-expanded="false" aria-controls="accordion-collapse-3-2">Where can I learn more about
                  investing?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-3-2" class="collapse" aria-labelledby="accordion-heading-3-2"
                data-bs-target="#accordion-3">
                <div class="card-body">
                  <p>Education is essential to financial empowerment. Itrust offers hundreds of digestible articles on
                    the basics of investing, investing lingo, and market trends. </p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-3-3">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-3"
                  aria-expanded="false" aria-controls="accordion-collapse-3-3">What’s a trading halt?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-3-3" class="collapse" aria-labelledby="accordion-heading-3-3"
                data-bs-target="#accordion-3">
                <div class="card-body">
                  <p>A trading halt is like a timeout for trading. During a halt, investors can’t buy or sell affected
                    stocks or options temporarily, giving everybody a chance to catch their breath from erratic market
                    movements. Halts are issued by stock exchanges like the NYSE and the Nasdaq, not by Itrust.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.accordion-wrapper -->
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10">
        <div class="col-lg-3 mb-0">
          <h2 class="fs-15 text-uppercase text-primary mb-3">FAQ</h2>
          <h3 class="display-5 mb-4">Account</h3>
        </div>
        <!--/column -->
        <div class="col-lg-9">
          <div id="accordion-4" class="accordion-wrapper">
            <div class="card">
              <div class="card-header" id="accordion-heading-4-1">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-1"
                  aria-expanded="false" aria-controls="accordion-collapse-4-1">How do I contact customer
                  support?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-1" class="collapse" aria-labelledby="accordion-heading-4-1"
                data-bs-target="#accordion-3">
                <div class="card-body">
                  <p>To get started, submit an application online. Read more about the requirements.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-2">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-2"
                  aria-expanded="false" aria-controls="accordion-collapse-4-2">Can I have more than one Itrust
                  account?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-2" class="collapse" aria-labelledby="accordion-heading-4-2"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>We only support one account per customer. This means that if you already have an account tied to
                    your Social Security number, you’ll need to regain access to your original account to use Itrust ,
                    even if you submitted a new application.</p>
                  <p>If you’ve forgotten your account password or want to change it, tap the Forgot Password link on
                    the login page of the Itrust website to send a password reset email to your email address on file.
                    <p>If you need help accessing your account, please contact us.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-3">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-3"
                  aria-expanded="false" aria-controls="accordion-collapse-4-3">When will I hear back about my
                  application?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-3" class="collapse" aria-labelledby="accordion-heading-4-3"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>The review process begins as soon as you submit your application. In the days following, you’ll
                    receive an email either confirming your application status or asking for more information. If we
                    request a document to verify your identity, please give us 5–7 days to review the materials.
                    During periods of high volume, it might take us a little longer than usual to review your
                    information—we appreciate your patience.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-4">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-4"
                  aria-expanded="false" aria-controls="accordion-collapse-4-4">Do I own the shares I buy through
                  Itrust?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-4" class="collapse" aria-labelledby="accordion-heading-4-4"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>You own the shares you buy through Itrust as soon as your order is executed.</p>
                  <p>For more information, see our blog post about debunking misinformation.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-5">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-5"
                  aria-expanded="false" aria-controls="accordion-collapse-4-5">Why isn’t my referral link
                  working?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-5" class="collapse" aria-labelledby="accordion-heading-4-5"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>Make sure that your friend used your link to sign up and link their bank account. Learn more
                    about referral rewards.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-6">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-6"
                  aria-expanded="false" aria-controls="accordion-collapse-4-6">Why am I having trouble linking my bank
                  account or making a withdrawal?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-6" class="collapse" aria-labelledby="accordion-heading-4-6"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>We recommend linking a checking account rather than a savings account to avoid potential transfer
                    reversals. Read more about how to link your bank.
                    To withdraw your funds smoothly, it’s best to transfer them to the same bank account you
                    originally used to deposit the money into your Itrust account. Any restrictions on your account
                    could also make the withdrawal process take longer than expected.</p>
                  <p>Learn more about how to withdraw money.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-7">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-7"
                  aria-expanded="false" aria-controls="accordion-collapse-4-7">How long does it take for my transfer
                  to go through?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-7" class="collapse" aria-labelledby="accordion-heading-4-7"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>It generally takes up to five trading days to transfer funds from your bank account to your
                    Itrust brokerage account. Keep in mind that weekends and national holidays don't count as trading
                    days.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-4-8">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4-8"
                  aria-expanded="false" aria-controls="accordion-collapse-4-8">How can I cancel my application/close
                  my account?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-4-8" class="collapse" aria-labelledby="accordion-heading-4-8"
                data-bs-target="#accordion-4">
                <div class="card-body">
                  <p>If you applied and would like to withdraw it, please contact us. No action is required if you
                    started an application but didn’t submit it.
                    <p>If you’d like to close your account, please follow these instructions. After you initiate a
                      full transfer, your account will be restricted to help ensure the transfer is processed
                      smoothly. If you have any questions about the status of your transfer, please contact us.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.accordion-wrapper -->
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10">
        <div class="col-lg-3 mb-0">
          <h2 class="fs-15 text-uppercase text-primary mb-3">FAQ</h2>
          <h3 class="display-5 mb-4">Account Security </h3>
        </div>
        <!--/column -->
        <div class="col-lg-9">
          <div id="accordion-5" class="accordion-wrapper">
            <div class="card">
              <div class="card-header" id="accordion-heading-5-1">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-5-1"
                  aria-expanded="false" aria-controls="accordion-collapse-5-1">Can I connect my Itrust account to
                  third-party services like Mint?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-5-1" class="collapse" aria-labelledby="accordion-heading-5-1"
                data-bs-target="#accordion-5">
                <div class="card-body">
                  <p>We made some changes to the Itrust website to help us protect our customers. These changes
                    prevent some third-party services from connecting to Itrust accounts, including Mint. At this
                    time, we don’t have plans to allow third-party logins, but we may revisit this in the future.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-5-2">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-5-2"
                  aria-expanded="false" aria-controls="accordion-collapse-5-2">I got locked out of my account. How do
                  I get back in?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-5-2" class="collapse" aria-labelledby="accordion-heading-5-2"
                data-bs-target="#accordion-5">
                <div class="card-body">
                  <p>If you don’t have access to the email and phone number associated with your account, please
                    contact us and we’ll help you update your account information.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-5-3">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-5-3"
                  aria-expanded="false" aria-controls="accordion-collapse-5-3">Why are there extra security measures
                  at login?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-5-3" class="collapse" aria-labelledby="accordion-heading-5-3"
                data-bs-target="#accordion-5">
                <div class="card-body">
                  <p>To help ensure the safety of your account, we added additional security measures when attempting
                    to sign into your account from a new device. Because of the change, you’re no longer able to
                    verify a new trusted device by email alone. Instead, you’ll need to verify any new trusted devices
                    using the phone number associated with your account.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.accordion-wrapper -->
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->

  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10">
        <div class="col-lg-3 mb-0">
          <h2 class="fs-15 text-uppercase text-primary mb-3">FAQ</h2>
          <h3 class="display-5 mb-4">Itrust Crypto</h3>
        </div>
        <!--/column -->
        <div class="col-lg-9">
          <div id="accordion-6" class="accordion-wrapper">
            <div class="card">
              <div class="card-header" id="accordion-heading-6-1">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-6-1"
                  aria-expanded="false" aria-controls="accordion-collapse-6-1">Are crypto prices the same across all
                  trading platforms?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-6-1" class="collapse" aria-labelledby="accordion-heading-6-1"
                data-bs-target="#accordion-6">
                <div class="card-body">
                  <p>Cryptocurrency prices are set by the supply and demand at each crypto exchange or trading venue,
                    which can result in price differences across trading platforms at times. This is particularly true
                    during periods of high volatility.</p>
                  <p>Itrust Crypto sources liquidity (the availability of assets) from multiple trading venues to
                    allow you to receive competitive pricing.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-6-2">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-6-2"
                  aria-expanded="false" aria-controls="accordion-collapse-6-2">Can I transfer crypto into or out of my
                  Itrust Crypto account?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-6-2" class="collapse" aria-labelledby="accordion-heading-6-2"
                data-bs-target="#accordion-6">
                <div class="card-body">
                  <p>Not yet, but we’re working on it! We’re prioritizing safety and service reliability as we build
                    out features that allow you to make cryptocurrency deposits and withdrawals.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-6-3">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-5-3"
                  aria-expanded="false" aria-controls="accordion-collapse-6-3">What is Itrust Crypto’s maintenance
                  schedule?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-6-3" class="collapse" aria-labelledby="accordion-heading-6-3"
                data-bs-target="#accordion-6">
                <div class="card-body">
                  <p>Scheduled maintenance happens at the same time every day, from approximately 5:29 PM – 5:40 PM ET
                    and 11:57 PM – 12:09 AM ET. We set aside this time to add features, fix bugs, and make Itrust
                    Crypto easier and faster to use.</p>
                  <p>During these maintenance windows, you can still place crypto trades, but some pending limit
                    orders may not execute until the maintenance window has ended.We also periodically schedule
                    maintenance windows that may occur at different times and could affect your ability to place
                    orders or impact the execution of pending limit orders.</p>
                  <p>You’ll be notified in the app before scheduled maintenance begins. Learn more about trading
                    times.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.accordion-wrapper -->
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>

  <!-- /section -->
  <section class="wrapper bg-light wrapper-border">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12 gy-10">
        <div class="col-lg-3 mb-0">
          <h2 class="fs-15 text-uppercase text-primary mb-3">FAQ</h2>
          <h3 class="display-5 mb-4">Brokerage Products</h3>
        </div>
        <!--/column -->
        <div class="col-lg-9">
          <div id="accordion-7" class="accordion-wrapper">
            <div class="card">
              <div class="card-header" id="accordion-heading-6-1">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-7-1"
                  aria-expanded="false" aria-controls="accordion-collapse-7-1">Are crypto prices the same across all
                  trading platforms?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-7-1" class="collapse" aria-labelledby="accordion-heading-7-1"
                data-bs-target="#accordion-7">
                <div class="card-body">
                  <p>Itrust Gold gives you access to research reports on stocks, Level II market data, and larger
                    instant deposits for a $5 monthly fee. If eligible, you'll also be able to invest on margin.</p>
                  <p>
                    <strong>Keep in Mind:</strong>
                    Margin investing is an optional Gold feature. Not all investors will be eligible to invest on
                    margin. Margin involves the risk of greater investment losses. Additional interest charges may
                    apply depending on the amount of margin used. Customers approved for options trading may require
                    the use of margin.
                  </p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-7-2">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-7-2"
                  aria-expanded="false" aria-controls="accordion-collapse-7-2">What features do you offer for options
                  investing?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-7-2" class="collapse" aria-labelledby="accordion-heading-7-2"
                data-bs-target="#accordion-7">
                <div class="card-body">
                  <p>Last year we improved our options offering, adding more educational resources, the ability to
                    exercise in app, live voice support for customers in certain options scenarios, and more.</p>
                  <p>Check out our blog post to read more about the added features. You can find articles about
                    options in our Options Knowledge Center and on Itrust Learn.</p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header" id="accordion-heading-7-3">
                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-7-3"
                  aria-expanded="false" aria-controls="accordion-collapse-7-3">What’s the criteria for closing out
                  option positions early?</button>
              </div>
              <!-- /.card-header -->
              <div id="accordion-collapse-7-3" class="collapse" aria-labelledby="accordion-heading-7-3"
                data-bs-target="#accordion-7">
                <div class="card-body">
                  <p>If we determine that your option(s) position has the potential of being exercised or assigned
                    without the required collateral to buy or sell the deliverable of the contract, we may take
                    proactive steps to help reduce risk to the firm and your market risk. This may include closing
                    at-risk positions prior to market close. </p>
                  <p><strong> How it works:</strong>
                    <ul>
                      <li>Risk checks generally begin 60-90 minutes before market close on expiration days, but may
                        begin earlier at our discretion</li>
                      <li>These checks are put in place to help protect both your account and Itrust </li>
                      <li>You're not able to choose the order of the risk checks if you have multiple holdings with
                        the same underlying stock</li>
                      <li>You’re not able to opt out of the risk check process</li>
                    </ul>
                  </p>
                  <p><strong>NOTE :</strong> We cannot guarantee that we’ll close all at-risk positions. It is
                    ultimately your responsibility to monitor your open options contracts.</p>
                  <p></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.collapse -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.accordion-wrapper -->
          <p><strong>Disclosures</strong><br></p>
          <p>All investments involve risk and loss of principal is possible.</p>
          <p>Options trading entails significant risk and is not appropriate for all investors. Investors should
            consider their investment objectives and risks carefully before investing in options. To learn more about
            the risks associated with options, please read the Characteristics and Risks of Standardized Options
            before you begin trading options. Supporting documentation for any claims, if applicable, will be
            furnished upon request.</p>
          <p>Itrust Investment LLC is a registered broker dealer (member SIPC). Itrust Securities, LLC provides
            brokerage clearing services (member SIPC). Itrust Crypto, LLC provides crypto currency trading. All are
            subsidiaries of Itrust Markets, Inc. (‘Itrust’).</p>
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->


@endsection
