@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
    <!-- @if(!empty($category_info)) <h3>{{ $category_info['name'] }}</h3>
    <p>{{ $category_info['content'] }}</p>
    @endif
    -->
    <div class="mdl-grid">
        @foreach($books as $value)
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-card-square mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand" style="background: url('{{ $value->image }}') center / cover;">
                    <h2 class="mdl-card__title-text">
                        {{ $value->name }}
                    </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <p>
                        <div id="p1" class="mdl-progress mdl-js-progress is-upgraded" data-upgraded=",MaterialProgress"
                        style="width: 100%;">
                            <div class="progressbar bar bar1" style="width: {{ intval(($value->rating)*10) }}%;">
                            </div>
                            <div class="bufferbar bar bar2" style="width: 100%;">
                            </div>
                            <div class="auxbar bar bar3" style="width: 0%;">
                            </div>
                        </div>
                        <br />
                        <span class="mdl-badge" data-badge="{{ intval(($value->rating)*10) }}">
                            Rating
                        </span>
                        <br />
                        作 者：{{ $value->author }}
                        <br />
                        出版社：{{ $value->publisher }}
                        <br />
                        索引号：{{ $value->get_id }}
                    </p>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
                    href="/book/{{ $value->id }}">
                        View Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
