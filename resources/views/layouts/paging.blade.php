@if ($paginator->hasPages())
	<div class="pagenavi">
		{{-- Previous Page Link --}}
		@if ($paginator->onFirstPage())
			<span class="nextpostslink" rel="prev">&lt; {{ __('前のページ') }}</span>
		@else
			<a class="nextpostslink" rel="prev" href="{{ $paginator->previousPageUrl() }}">&lt; {{ __('前のページ') }}</a>
		@endif

		{{-- Pagination Elements --}}
		@foreach ($elements as $element)
			{{-- Array Of Links --}}
			@if(is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<span class="current">{{ $page }}</span>
					@else 
						<a class="page larger" href="{{ $url }}">{{ $page }}</a>
					@endif
				@endforeach
			@else
				<span><i class="fa fa-ellipsis-h"></i></span>
			@endif
		@endforeach

		{{-- Next Page Link --}}
		@if ($paginator->hasMorePages())
			<a class="nextpostslink" rel="next" href="{{ $paginator->nextPageUrl() }}">{{ __('次のページ') }} &gt;</a>
		@else
			<span class="nextpostslink" rel="next">{{ __('次のページ') }} &gt;</span>
		@endif
	</div>
@endif