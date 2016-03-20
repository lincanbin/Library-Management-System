@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
<!--
    @if(!empty($category_info))
        <h3>{{ $category_info['name'] }}</h3>
        <p>{{ $category_info['content'] }}</p>
    @endif
-->
    <div class="mdl-grid">
        
        @foreach($books as $value)
            <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-card-square mdl-card mdl-shadow--2dp">
                  <div class="mdl-card__title mdl-card--expand" style="background: url('{{ $value->image }}') center / cover;">
                    <h2 class="mdl-card__title-text">{{ $value->name }}</h2>
                  </div>
                  <div class="mdl-card__supporting-text">
                    <p>
                        <input class="mdl-slider mdl-js-slider" type="range" min="0" max="100" value="{{ intval(($value->rating)*10) }}" tabindex="0" /><!--disabled="disabled"-->
                        <br /><span class="mdl-badge" data-badge="{{ intval(($value->rating)*10) }}">Rating</span><br />
                        作  者：{{ $value->author }}<br />
                        出版社：{{ $value->publisher }}<br />
                        索引号：{{ $value->get_id }}
                    </p>
                  </div>
                  <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                      View Detail
                    </a>
                  </div>
                </div>
                
            </div>
        @endforeach
    </div>
</section>

@endsection
