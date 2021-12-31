@extends('frontend.layouts.app')

@section('content')
<style>
    .img{
        width: 500px !important;
        height: 350px !important;
        object-fit: cover;
    }
</style>

<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
      <div class="row">
        <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
          <h1 class="display-1 mb-3">Business News</h1>
          <p class="lead px-lg-5 px-xxl-8">Welcome to our journal. Here you can find the latest company news and
            business articles.</p>
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light wrapper-border">
    <div class="container inner py-8">
      <div class="row gx-lg-8 gx-xl-12 gy-4 gy-lg-0">
        <div class="col-lg-8 align-self-center">
          <div class="blog-filter filter">
            <p>Blog Filter:</p>
            <ul>
                @foreach ($blogCategories as $item)
                <li><a class="active" href="#">{{ $item->category }}</a></li>
                @endforeach
              {{-- <li><a href="#">Fabric</a></li>
              <li><a href="#">Fashion</a></li>
              <li><a href="#">Party</a></li>
              <li><a href="#">Printables</a></li> --}}
            </ul>
          </div>
          <!--/.filter -->
        </div>
        <!--/column -->
        <aside class="col-lg-4 sidebar">
          <form class="search-form">
            <div class="form-label-group mb-0">
              <input id="search-form" type="text" class="form-control" placeholder="Search">
              <label for="search-form">Search</label>
            </div>
          </form>
          <!-- /.search-form -->
        </aside>
        <!-- /column .sidebar -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
      <div class="row gx-lg-8 gx-xl-12">
        <div class="col-lg-8">
          <div class="blog classic-view">
              {{-- @foreach ($blogs as $blog) --}}

            <article class="post">
              <div class="card">
                <figure class="card-img-top overlay overlay1 hover-scale">
                <a href="{{  route('frontend.blogview', $first_blog->id) }}">
                    <img src="{{ $first_blog->image }}"  alt="" />
                </a>
                  <figcaption>
                    <h5 class="from-top mb-0">Read More</h5>
                  </figcaption>
                </figure>
                <div class="card-body">
                  <div class="post-header">
                    <div class="post-category text-line">
                      <a href="#" class="hover" rel="category">{{ $first_blog->category }}</a>
                    </div>
                    <!-- /.post-category -->
                    <h2 class="post-title mt-1 mb-0"><a class="link-dark" href="{{  route('frontend.blogview', $first_blog->id) }}">{{ $first_blog->title }}</a></h2>
                  </div>
                  <!-- /.post-header -->
                  <div class="post-content">
                    <p>{!! substr($first_blog->body, 0, 200) !!}</p>
                  </div>
                  <!-- /.post-content -->
                </div>
                <!--/.card-body -->
                <div class="card-footer">
                  <ul class="post-meta d-flex mb-0">
                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($first_blog->created_at)->format('d M Y') }}</span></li>
                    <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Admin</span></a></li>
                    {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3<span> Comments</span></a> --}}
                    </li>
                    {{-- <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>3</a></li> --}}
                  </ul>
                  <!-- /.post-meta -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </article>
            {{-- @endforeach --}}

            <!-- /.post -->
            {{-- <article class="post">
              <div class="card">
                <div class="post-slider card-img-top">
                  <div class="basic-slider owl-carousel dots-over" data-margin="5">
                    <div class="item"><img class="img" src="img/photos/b2.jpg" class="" alt="" /></div>
                    <div class="item"><img class="img" src="img/photos/b3.jpg" alt="" /></div>
                  </div>
                  <!-- /.basic-slider -->
                </div>
                <!-- /.post-slider -->
                <div class="card-body">
                  <div class="post-header">
                    <div class="post-category text-line">
                      <a href="#" class="hover" rel="category">Ideas</a>
                    </div>
                    <!-- /.post-category -->
                    <h2 class="post-title mt-1 mb-0"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">Fringilla Ligula
                        Pharetra Amet</a></h2>
                  </div>
                  <!-- /.post-header -->
                  <div class="post-content">
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                      elit. Nullam quis risus eget urna mollis ornare vel. Nulla vitae elit libero, a pharetra augue.
                      Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est
                      at lobortis. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus
                      commodo, tortor mauris condimentum nibh. Cras mattis consectetur purus.</p>
                  </div>
                  <!-- /.post-content -->
                </div>
                <!--/.card-body -->
                <div class="card-footer">
                  <ul class="post-meta d-flex mb-0">
                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>25 Jun 2021</span></li>
                    <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Sandbox</span></a></li>
                    <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>5<span> Comments</span></a>
                    </li>
                    <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>4</a></li>
                  </ul>
                  <!-- /.post-meta -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </article>
            <!-- /.post -->
            <article class="post">
              <div class="card">
                <div class="card-img-top">
                  <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="j_Y2Gwaj7Gs"></div>
                </div>
                <div class="card-body">
                  <div class="post-header">
                    <div class="post-category text-line">
                      <a href="#" class="hover" rel="category">Workspace</a>
                    </div>
                    <!-- /.post-category -->
                    <h2 class="post-title mt-1 mb-0"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">Consectetur Bibendum
                        Sollicitudin Vulputate</a></h2>
                  </div>
                  <!-- /.post-header -->
                  <div class="post-content">
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
                      elit. Nullam quis risus eget urna mollis ornare vel. Nulla vitae elit libero, a pharetra augue.
                      Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est
                      at lobortis. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus
                      commodo, tortor mauris condimentum nibh. Cras mattis consectetur purus.</p>
                  </div>
                  <!-- /.post-content -->
                </div>
                <!--/.card-body -->
                <div class="card-footer">
                  <ul class="post-meta d-flex mb-0">
                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>18 May 2021</span></li>
                    <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Sandbox</span></a></li>
                    <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>8<span> Comments</span></a>
                    </li>
                    <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>6</a></li>
                  </ul>
                  <!-- /.post-meta -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </article> --}}
            <!-- /.post -->
          </div>
          <!-- /.blog -->
          <div class="blog grid grid-view">
            <div class="row isotope gx-md-8 gy-8 mb-8">
                @foreach ($blogs as $blog)


              <article class="item post col-md-6">
                <div class="card">
                  <figure class="card-img-top overlay overlay1 hover-scale" style="width: 100%; height:75%;"><a href="{{ route('frontend.blogview', $blog->id) }}"> <img class="img" src="{{ $blog->image }}"
                        alt="" /></a>
                    <figcaption>
                      <h5 class="from-top mb-0">Read More</h5>
                    </figcaption>
                  </figure>
                  <div class="card-body">
                    <div class="post-header">
                      <div class="post-category text-line">
                        <a href="#" class="hover" rel="category">{{ $blog->category }}</a>
                      </div>
                      <!-- /.post-category -->
                      <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">{{ $blog->title }}</a></h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="post-content">
                      <p>{!! substr($blog->body, 0, 200) !!}</p>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog->created_at)->format('d M Y') }}</span></li>
                      <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li>
                      <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>5</a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article>
              @endforeach
              {{-- <!-- /.post -->
              <article class="item post col-md-6">
                <div class="card">
                  <figure class="card-img-top overlay overlay1 hover-scale"><a href="#"> <img class="img" src="img/photos/b5.jpg"
                        alt="" /></a>
                    <figcaption>
                      <h5 class="from-top mb-0">Read More</h5>
                    </figcaption>
                  </figure>
                  <div class="card-body">
                    <div class="post-header">
                      <div class="post-category text-line">
                        <a href="#" class="hover" rel="category">Workspace</a>
                      </div>
                      <!-- /.post-category -->
                      <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">Nullam id dolor
                          elit id nibh</a></h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="post-content">
                      <p>Mauris convallis non ligula non interdum. Gravida vulputate convallis tempus vestibulum cras
                        imperdiet nun eu dolor. Aenean lacinia bibendum nulla sed.</p>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span>29 Mar 2021</span></li>
                      <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a></li>
                      <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>3</a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article>
              <!-- /.post -->
              <article class="item post col-md-6">
                <div class="card">
                  <figure class="card-img-top overlay overlay1 hover-scale"><a href="#"> <img class="img" src="img/photos/b6.jpg"
                        alt="" /></a>
                    <figcaption>
                      <h5 class="from-top mb-0">Read More</h5>
                    </figcaption>
                  </figure>
                  <div class="card-body">
                    <div class="post-header">
                      <div class="post-category text-line">
                        <a href="#" class="hover" rel="category">Meeting</a>
                      </div>
                      <!-- /.post-category -->
                      <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">Ultricies fusce
                          porta elit</a></h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="post-content">
                      <p>Mauris convallis non ligula non interdum. Gravida vulputate convallis tempus vestibulum cras
                        imperdiet nun eu dolor. Aenean lacinia bibendum nulla sed.</p>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span>26 Feb 2021</span></li>
                      <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>6</a></li>
                      <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>3</a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article>
              <!-- /.post -->
              <article class="item post col-md-6">
                <div class="card">
                  <figure class="card-img-top overlay overlay1 hover-scale"><a href="#"> <img class="img" src="img/photos/b7.jpg"
                        alt="" /></a>
                    <figcaption>
                      <h5 class="from-top mb-0">Read More</h5>
                    </figcaption>
                  </figure>
                  <div class="card-body">
                    <div class="post-header">
                      <div class="post-category text-line">
                        <a href="#" class="hover" rel="category">Business Tips</a>
                      </div>
                      <!-- /.post-category -->
                      <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">Morbi leo risus
                          porta eget</a></h2>
                    </div>
                    <div class="post-content">
                      <p>Mauris convallis non ligula non interdum. Gravida vulputate convallis tempus vestibulum cras
                        imperdiet nun eu dolor. Aenean lacinia bibendum nulla sed.</p>
                    </div>
                    <!-- /.post-content -->
                  </div>
                  <!--/.card-body -->
                  <div class="card-footer">
                    <ul class="post-meta d-flex mb-0">
                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span>7 Jan 2021</span></li>
                      <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>2</a></li>
                      <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>5</a></li>
                    </ul>
                    <!-- /.post-meta -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </article> --}}
              <!-- /.post -->
            </div>
            <!-- /.row -->
          </div>

          {{ $blogs->links('vendor.pagination.custom') }}
          <!-- /.blog -->

          <!-- /nav -->
        </div>
        <!-- /column -->
        <aside class="col-lg-4 sidebar mt-8 mt-lg-6">

          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title mb-3">Popular Posts</h4>
            <ul class="image-list">
                @foreach($popular_blogs as $blog)
              <li>
                <figure class="rounded"><a href="{{  route('frontend.blogview', $blog->id) }}"><img class="img" src="{{ $blog->image }}" alt="" /></a></figure>
                <div class="post-content">
                  <h6 class="mb-2"> <a class="link-dark" href="{{  route('frontend.blogview', $blog->id) }}">{{ $blog->title }}</a> </h6>
                  <ul class="post-meta">
                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog->created_at)->format('d M Y') }}</span></li>
                    <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a></li>
                  </ul>
                  <!-- /.post-meta -->
                </div>
              </li>
              @endforeach
            </ul>
            <!-- /.image-list -->
          </div>
          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title mb-3">Categories</h4>
            <ul class="unordered-list bullet-primary text-reset">
                @foreach ($blogCategories as $category)
                <li><a href="#">{{ $category->category }}</a></li>
                @endforeach
              {{-- <li><a href="#">Ideas (19)</a></li>
              <li><a href="#">Workspace (16)</a></li>
              <li><a href="#">Coding (7)</a></li>
              <li><a href="#">Meeting (12)</a></li>
              <li><a href="#">Business Tips (14)</a></li> --}}
            </ul>
          </div>
          <!-- /.widget -->
          {{-- <div class="widget">
            <h4 class="widget-title mb-3">Tags</h4>
            <ul class="list-unstyled tag-list">
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Still Life</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Urban</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Nature</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Landscape</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Macro</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Fun</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Workshop</a></li>
              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Photography</a></li>
            </ul>
          </div>
          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title mb-3">Archive</h4>
            <ul class="unordered-list bullet-primary text-reset">
              <li><a href="#">February 2019</a></li>
              <li><a href="#">January 2019</a></li>
              <li><a href="#">December 2018</a></li>
              <li><a href="#">November 2018</a></li>
              <li><a href="#">October 2018</a></li>
            </ul>
          </div> --}}
          <!-- /.widget -->
        </aside>
        <!-- /column .sidebar -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>


@endsection
