<!-- ══════════════════════════════════════════════ -->
<!-- DESTINATIONS SECTION                         -->
<!-- ══════════════════════════════════════════════ -->

@if(!empty($destinations['heading']) || !empty($destinations['items']))
<section class="dest-section">
    <div class="container">

        <!-- HEADER -->
        @if(!empty($destinations['heading']))
        <div class="dest-header">
            <div class="dest-heading">
                <h2>{{ $destinations['heading'] }}</h2>
            </div>
        </div>
        @endif

        <!-- DESTINATION CARDS -->
        @if(!empty($destinations['items']))
        @php($destCardCount = max(2, min(5, count($destinations['items']))))
        <div class="dest-grid" style="--dest-count: {{ $destCardCount }};">
            @foreach($destinations['items'] as $destination)
            <article class="dest-card" data-slug="{{ $destination['slug'] }}">
                @if(!empty($destination['image']))
                <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}">
                @endif
                <div class="dest-overlay"></div>
                <div class="dest-content">
                    @if(!empty($destination['name']))
                    <h3>{{ $destination['name'] }}</h3>
                    @endif
                    @if(!empty($destination['dates']))
                    <p class="dest-content__dates">{{ $destination['dates'] }}</p>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
        @endif

    </div>
</section>
@endif
