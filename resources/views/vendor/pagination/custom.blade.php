{{-- <nav class="d-flex" aria-label="pagination">
    <ul class="pagination">
      <li class="page-item disabled">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
        </a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
        </a>
      </li>
    </ul>
    <!-- /.pagination -->
  </nav> --}}




  @if ($paginator->hasPages())
  <nav class="d-flex" aria-label="pagination">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="disabled" aria-disabled="true" >
                    <span aria-hidden="true">&lsaquo;</span>
                </li> --}}

                <li class="page-item disabled" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
                    </a>
                </li>
            @else
                {{-- <li>
                    <a href="" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}


                <li class="page-item disabled" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                      <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    {{-- <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li> --}}

                    <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}

                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                      <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
                    </a>
                  </li>
            @else
                {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li> --}}


                <li class="page-item disabled">
                    <a class="page-link" aria-disabled="true" aria-label="@lang('pagination.next')">
                      <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
                    </a>
                  </li>
            @endif
        </ul>
    </nav>
@endif

