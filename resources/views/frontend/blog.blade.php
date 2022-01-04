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
  <div class="">
      @if(count($blogs) > 0)
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
                              @foreach($blogs as $blog)
                                  <article class="post">
                                      <div class="card">
                                          <figure class="card-img-top overlay overlay1 hover-scale">
                                              <a href="{{  route('frontend.blogview', $blog->title) }}">
                                                  <img src="{{ asset($blog->image) }}"  alt="" />
                                              </a>
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
                                                  <h2 class="post-title mt-1 mb-0"><a class="link-dark" href="{{  route('frontend.blogview', $blog->title) }}">{{ $blog->title }}</a></h2>
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
                                                  <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Admin</span></a></li>
                                                   <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>{{ $blog->comments()->count() }}<span> Comments</span></a>
                                                   <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>0</a></li>
                                              </ul>
                                              <!-- /.post-meta -->
                                          </div>
                                          <!-- /.card-footer -->
                                      </div>
                                      <!-- /.card -->
                                  </article>
                              @endforeach
                              {{-- @endforeach --}}
                          </div>
                          <!-- /.blog -->
{{--                          <div class="blog grid grid-view">--}}
{{--                              <div class="row isotope gx-md-8 gy-8 mb-8">--}}
{{--                                  @foreach ($blogs as $blog)--}}
{{--                                      <article class="item post col-md-6">--}}
{{--                                          <div class="card">--}}
{{--                                              <figure class="card-img-top overlay overlay1 hover-scale" style="width: 100%; height:75%;"><a href="{{ route('frontend.blogview', $blog->title) }}"> <img class="img" src="{{ asset($blog->image) }}"--}}
{{--                                                                                                                                                                                                     alt="" /></a>--}}
{{--                                                  <figcaption>--}}
{{--                                                      <h5 class="from-top mb-0">Read More</h5>--}}
{{--                                                  </figcaption>--}}
{{--                                              </figure>--}}
{{--                                              <div class="card-body">--}}
{{--                                                  <div class="post-header">--}}
{{--                                                      <div class="post-category text-line">--}}
{{--                                                          <a href="#" class="hover" rel="category">{{ $blog->category }}</a>--}}
{{--                                                      </div>--}}
{{--                                                      <!-- /.post-category -->--}}
{{--                                                      <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{  route('frontend.blogview', $blog->title) }}">{{ $blog->title }}</a></h2>--}}
{{--                                                  </div>--}}
{{--                                                  <!-- /.post-header -->--}}
{{--                                                  <div class="post-content">--}}
{{--                                                      <p>{!! substr($blog->body, 0, 100) !!}</p>--}}
{{--                                                      <a href="{{ route('frontend.blogview', $blog->title) }}">Read More</a>--}}
{{--                                                  </div>--}}
{{--                                                  <!-- /.post-content -->--}}
{{--                                              </div>--}}
{{--                                              <!--/.card-body -->--}}
{{--                                              <div class="card-footer">--}}
{{--                                                  <ul class="post-meta d-flex mb-0">--}}
{{--                                                      <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog->created_at)->format('d M Y') }}</span></li>--}}
{{--                                                      <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li>--}}
{{--                                                      <li class="post-likes ms-auto"><a href="#"><i class="uil uil-heart-alt"></i>5</a></li>--}}
{{--                                                  </ul>--}}
{{--                                                  <!-- /.post-meta -->--}}
{{--                                              </div>--}}
{{--                                              <!-- /.card-footer -->--}}
{{--                                          </div>--}}
{{--                                          <!-- /.card -->--}}
{{--                                      </article>--}}
{{--                                  @endforeach--}}
{{--                              </div>--}}
{{--                              <!-- /.row -->--}}
{{--                          </div>--}}

                      {{ $blogs->links('vendor.pagination.custom') }}
                      <!-- /.blog -->

                          <!-- /nav -->
                      </div>
                      <!-- /column -->
                      <div class="col-lg-4 sidebar mt-8 mt-lg-6">

                          <!-- /.widget -->
                          <div class="widget mb-3">
                              <h4 class="widget-title mb-3">Popular Posts</h4>
                              <ul class="image-list">
                                  @foreach($popular_blogs as $blog)
                                      <li>
                                          <figure class="rounded">
                                              <a href="{{  route('frontend.blogview', $blog->title) }}">
                                                  <img class="img" src="{{ asset($blog->image) }}" alt="" />
                                              </a>
                                          </figure>
                                          <div class="post-content">
                                              <h6 class="mb-2"> <a class="link-dark" href="{{  route('frontend.blogview', $blog->title) }}">{{ $blog->title }}</a> </h6>
                                              <ul class="post-meta">
                                                  <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog->created_at)->format('d M Y') }}</span></li>
                                                  <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>{{ $blog->comments()->count() }}</a></li>
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
                              </ul>
                          </div>
                      </div>
                      <!-- /column .sidebar -->
                  </div>
                  <!-- /.row -->
              </div>
              <!-- /.container -->
          </section>
      @else
          <h1 class="text-center mt-5">No Posts Yet</h1>
      @endif
  </div>


@endsection
