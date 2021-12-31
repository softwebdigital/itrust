@extends('frontend.layouts.blog_app')

@section('content')

<style>
    .img{
        width: 100% !important;
        height: 75% !important;
        object-fit: cover;
    }
    .alertify-notifier.ajs-right {
    color: white !important;
}
</style>

<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
            <div class="post-category text-line">
              <a href="#" class="hover" rel="category">{{ $blog_post->category }}</a>
            </div>
            <!-- /.post-category -->
            <h1 class="display-1 mb-4">{{ $blog_post->title }}</h1>
            <ul class="post-meta mb-5">
              <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog_post->created_at)->format('d M Y') }}</span></li>
              <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Admin</span></a></li>
              <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>{{ $total_comments }}<span> Comments</span></a></li>
              {{-- <li class="post-likes"><a href="#"><i class="uil uil-heart-alt"></i>3<span> Likes</span></a></li> --}}
            </ul>
            <!-- /.post-meta -->
          </div>
          <!-- /.post-header -->
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
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="blog single mt-n17">
            <div class="card">
              <figure class="card-img-top "><img class="img align-self-center justify-content-between" src="{{ asset($blog_post->image) }}" alt="" /></figure>
              <div class="card-body">
                <div class="classic-view">
                  <article class="post">
                    <div class="post-content mb-5">
                      <h2 class="h1 mb-4">{{ $blog_post->heading }}</h2>
                      <p>{!! $blog_post->body !!}</p>
                      <div class="row g-6 mt-3 mb-10 light-gallery-wrapper">
                        <div class="col-md-6">
                          {{-- <figure class="hover-scale rounded"><a href="img/photos/b8-full.jpg" class="lightbox"
                              data-sub-html=".caption"> <img src="img/photos/b8.jpg" alt="" /></a></figure> --}}
                          {{-- <div class="caption d-none"> --}}
                            {{-- <h5>Heading</h5>
                            <p>Purus Vulputate Sem Tellus Quam</p> --}}
                          {{-- </div> --}}
                        </div>
                        <!--/column -->
                        <div class="col-md-12">
                          {{-- <figure class="hover-scale rounded"><a href="{{ env('APP_URL').'/'.$blog_post->image }}" class="lightbox"> <img
                                src="{{ env('APP_URL').'/'.$blog_post->image }}" alt="{{ $blog_post->title }}" /></a></figure> --}}
                        </div>
                        <!--/column -->
                        {{-- <div class="col-md-6">
                          <figure class="hover-scale rounded"><a href="img/photos/b10-full.jpg" class="lightbox"> <img
                                src="img/photos/b10.jpg" alt="" /></a></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6">
                          <figure class="hover-scale rounded"><a href="img/photos/b11-full.jpg" class="lightbox"> <img
                                src="img/photos/b11.jpg" alt="" /></a></figure>
                        </div> --}}
                        <!--/column -->
                      </div>
                      <!-- /.row -->

                    </div>
                    <!-- /.post-content -->
                    <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                      <div>
                        <ul class="list-unstyled tag-list mb-0">
                          {{-- <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill mb-0">Still Life</a></li>
                          <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill mb-0">Urban</a></li>
                          <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill mb-0">Nature</a></li> --}}
                        </ul>
                      </div>
                      <div class="mb-0 mb-md-2">
                        <div class="dropdown share-dropdown btn-group">
                          <button
                            class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-share-alt"></i> Share </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ Share::currentPage($blog_post->title)->twitter()->getRawLinks() }}"><i class="uil uil-twitter"></i>Twitter</a>
                            <a class="dropdown-item" href="{{ Share::currentPage($blog_post->title)->facebook()->getRawLinks()}}"><i class="uil uil-facebook-f"></i>Facebook</a>
                            <a class="dropdown-item" href="{{ Share::currentPage($blog_post->title)->linkedin()->getRawLinks() }}"><i class="uil uil-linkedin"></i>Linkedin</a>
                            {{-- {!! Share::page('http://jorenvanhocht.be')->facebook()!!} --}}
                          </div>
                          <!--/.dropdown-menu -->
                        </div>
                        <!--/.share-dropdown -->
                      </div>
                    </div>
                    <!-- /.post-footer -->
                  </article>
                  <!-- /.post -->
                </div>
                <!-- /.classic-view -->
                <hr />
                {{-- <div class="author-info d-md-flex align-items-center mb-3">
                  <div class="d-flex align-items-center">
                    <figure class="user-avatar"><img class="rounded-circle" alt="" src="img/avatars/u5.jpg" />
                    </figure>
                    <div>
                      <h6><a href="#" class="link-dark">Nikolas Brooten</a></h6>
                      <span class="post-meta fs-15">Sales Manager</span>
                    </div>
                  </div>
                  <div class="mt-3 mt-md-0 ms-auto">
                    <a href="#" class="btn btn-sm btn-soft-ash rounded-pill btn-icon btn-icon-start mb-0"><i
                        class="uil uil-file-alt"></i> All Posts</a>
                  </div>
                </div> --}}
                <!-- /.author-info -->
                {{-- <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                  sit amet risus. Maecenas faucibus mollis interdum. Fusce dapibus, tellus ac. Maecenas faucibus
                  mollis interdum.</p>
                <nav class="nav social">
                  <a href="#"><i class="uil uil-twitter"></i></a>
                  <a href="#"><i class="uil uil-facebook-f"></i></a>
                  <a href="#"><i class="uil uil-dribbble"></i></a>
                  <a href="#"><i class="uil uil-instagram"></i></a>
                  <a href="#"><i class="uil uil-youtube"></i></a>
                </nav> --}}
                <!-- /.social -->
                <hr />
                <h3 class="mb-6">You Might Also Like</h3>
                <div class="carousel owl-carousel blog grid-view mb-16" data-margin="30" data-dots="true"
                  data-autoplay="false" data-autoplay-timeout="5000"
                  data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "2"}}'>
                  @foreach($other_blogs as $blog)
                  <div class="item">
                    <article>
                      <figure class="overlay overlay1 hover-scale rounded mb-5"><a href="{{ route('frontend.blogview', $blog->id) }}"> <img
                            src="{{ asset($blog->image) }}" alt="" /></a>
                        <figcaption>
                          <h5 class="from-top mb-0">Read More</h5>
                        </figcaption>
                      </figure>
                      <div class="post-header">
                        <div class="post-category text-line">
                          <a href="#" class="hover" rel="category">{{ $blog->category }}</a>
                        </div>
                        <!-- /.post-category -->
                        <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="{{ route('frontend.blogview', $blog->id) }}">{!! $blog->title !!}</a></h2>
                      </div>
                      <!-- /.post-header -->
                      <div class="post-footer">
                        <ul class="post-meta mb-0">
                          <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::make($blog->created_at)->format('d M Y') }}</span></li>
                          {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li> --}}
                        </ul>
                        <!-- /.post-meta -->
                      </div>
                      <!-- /.post-footer -->
                    </article>
                    <!-- /article -->
                  </div>
                  @endforeach
                  <!-- /.item -->

                  <!-- /.item -->
                </div>
                <!-- /.owl-carousel -->
                <hr />
                <div id="comments">
                    <h3 class="mb-6">{{ $total_comments }} Comments</h3>
                    <ol id="singlecomments" class="commentlist">
            @include('frontend.comments', ['comments' => $comments])
                    {{-- <li class="comment">
                      <div class="comment-header d-md-flex align-items-center">
                        <div class="d-flex align-items-center">
                          <figure class="user-avatar"><img class="rounded-circle" alt="" src="img/avatars/u4.jpg" />
                          </figure>
                          <div>
                            <h6 class="comment-author"><a href="#" class="link-dark">Lou Bloxham</a></h6>
                            <ul class="post-meta">
                              <li><i class="uil uil-calendar-alt"></i>3 May 2021</li>
                            </ul>
                            <!-- /.post-meta -->
                          </div>
                          <!-- /div -->
                        </div>
                        <!-- /div -->
                        <div class="mt-3 mt-md-0 ms-auto">
                          <a href="#" class="btn btn-soft-ash btn-sm rounded-pill btn-icon btn-icon-start mb-0"><i
                              class="uil uil-comments"></i> Reply</a>
                        </div>
                        <!-- /div -->
                      </div>
                      <!-- /.comment-header -->
                      <p>Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper. Cum
                        sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </li> --}}
                    <div class="ajax-load text-center" style="display: none;">
                        <p><img width="100" src="{{ asset('img/loader.gif') }}" alt="">Loading More Comments</p>
                    </div>
                </ol>
                @if($total_comments > 5)
                <div>
                    <button type="submit" class="loadmore btn btn-primary rounded-pill mb-0">Load more</button>
                </div>
                @endif
                {{-- <button class="">CLick Me</button> --}}
                </div>
                <!-- /#comments -->
                <hr />

                <h3 class="mb-3">Would you like to share your thoughts?</h3>
                <p class="mb-7">Your email address will not be published. Required fields are marked *</p>
                <form method="POST" action="{{ route('frontend.blog.addcomment', $blog_post->id) }}" class="comment-form">
                    @csrf @method('POST')
                  <div class="form-label-group mb-4">
                    <input type="text" required class="form-control" name="name" placeholder="Name*" id="c-name">
                    @error('name')
                    <strong class="text-danger" role="alert">{{ $message }}</strong>
                    @enderror
                    <label for="c-name">Name *</label>
                  </div>
                  <div class="form-label-group mb-4">
                    <input type="email" required class="form-control" name="email" placeholder="Email*" id="c-email">
                    @error('email')
                    <strong class="text-danger" role="alert">{{ $message }}</strong>
                    @enderror
                    <label for="c-email">Email*</label>
                  </div>
                  <div class="form-label-group mb-4">
                    <textarea class="form-control" required name="comment" rows="5" placeholder="Comment"></textarea>
                    @error('comment')
                    <strong class="text-danger" role="alert">{{ $message }}</strong>
                    @enderror
                    <label>Comment *</label>
                  </div>
                  <button type="submit" class="btn btn-primary rounded-pill mb-0">Submit</button>
                </form>
                <!-- /.comment-form -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.blog -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>



@endsection
