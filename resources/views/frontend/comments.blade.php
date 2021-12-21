@foreach($comments as $comment)
                    <li class="comment">
                      <div class="comment-header d-md-flex align-items-center">
                        <div class="d-flex align-items-center">
                          <figure class="user-avatar"><img class="rounded-circle" alt="" src="{{ asset('img/avatars/blog1.png') }}" />
                          </figure>
                          <div>
                            <h6 class="comment-author"><a href="#" class="link-dark">{{ $comment->name }}</a></h6>
                            <ul class="post-meta">
                              <li><i class="uil uil-calendar-alt"></i>{{ \Carbon\Carbon::make($comment->created_at)->format('d M Y') }}</li>
                            </ul>
                            <!-- /.post-meta -->
                          </div>
                          <!-- /div -->
                        </div>
                        
                      </div>
                      <p>{{$comment->comment}}</p>
                    </li>
                    @endforeach
