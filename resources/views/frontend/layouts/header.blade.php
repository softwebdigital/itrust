<nav class="navbar center-nav transparent navbar-expand-lg navbar-light">
    <div class="container flex-lg-row flex-nowrap align-items-center">
      <div class="navbar-brand w-100"><a href="/"><img src="img/logo.png" srcset="img/logo.png 2x" alt="" /></a></div>
      <div class="navbar-collapse offcanvas-nav">
        <div class="offcanvas-header d-lg-none d-xl-none">
          <a href="/"><img src="img/logo-light.png" srcset="img/logo.png 2x" alt="" /></a>
          <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#!">Product</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.stocks') }}">Stocks and Funds</a></li>
                <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.crypto') }}">Crypto</a></li>
                <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.gold') }}">Gold</a></li>
                <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.cash') }}">Cash Management</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.options') }}">Options</a></li>
            </ul>
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#!">Learn</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.invest') }}">How to invest</a></li>
            </ul>
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#!">Who we Are</a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.about') }}">About Us</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.commitments') }}">Our Commitments</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.investor_relations') }}">Investor Relations</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.blog') }}">Blog</a></li>
            </ul>
          <li class="nav-item"><a class="nav-link" href="{{ route('frontend.faq') }}">F.A.Q</a>
        </ul>
        <!-- /.navbar-nav -->
      </div>
      <!-- /.navbar-collapse -->
      <div class="navbar-other w-100 d-flex ms-auto">
        <ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
          <li class="nav-item dropdown language-select text-uppercase">
            <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-info-circle"></i></a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a class="dropdown-item" href="{{ route('register') }}">Sign up</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.terms') }}">Terms & Condition</a></li>
              <li class="nav-item"><a class="dropdown-item" href="{{ route('frontend.privacy') }}">Privacy Policy</a></li>
            </ul>
          </li>
          <li class="nav-item d-md-block">
                @auth
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Dashboard</a>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                @endguest
          </li>
          <li class="nav-item d-lg-none">
            <div class="navbar-hamburger"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
          </li>
        </ul>
        <!-- /.navbar-nav -->
      </div>
      <!-- /.navbar-other -->
    </div>
    <!-- /.container -->
  </nav>
