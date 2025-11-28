@if ($paginator->hasPages())
  <nav class="pagination-nav">
    <ul class="pagination pagination-custom">
      {{-- ＜ 前へ --}}
      @if ($paginator->onFirstPage())
        <li class="pagination__item pagination__item--disabled">
          <span>&lt;</span>
        </li>
      @else
        <li class="pagination__item">
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        </li>
      @endif

      {{-- ページ番号 --}}
      @foreach ($elements as $element)
        {{-- 省略部分 (...) --}}
        @if (is_string($element))
          <li class="pagination__item pagination__item--ellipsis">
            <span>{{ $element }}</span>
          </li>
        @endif

        {{-- ページ番号リンク --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="pagination__item pagination__item--active">
                <span>{{ $page }}</span>
              </li>
            @else
              <li class="pagination__item">
                <a href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- 次へ ＞ --}}
      @if ($paginator->hasMorePages())
        <li class="pagination__item">
          <a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
        </li>
      @else
        <li class="pagination__item pagination__item--disabled">
          <span>&gt;</span>
        </li>
      @endif
    </ul>
  </nav>
@endif
