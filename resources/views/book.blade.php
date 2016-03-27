@extends('layouts.app')
@section('title', $book_info->name)
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-card-square mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand" style="background: url('{{ $book_info->image }}') center / cover;">
                    <h2 class="mdl-card__title-text">
                        {{ $book_info->name }}
                    </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <p>
                        <div id="p1" class="mdl-progress mdl-js-progress is-upgraded" data-upgraded=",MaterialProgress"
                        style="width: 100%;">
                            <div class="progressbar bar bar1" style="width: {{ intval(($book_info->rating)*10) }}%;">
                            </div>
                            <div class="bufferbar bar bar2" style="width: 100%;">
                            </div>
                            <div class="auxbar bar bar3" style="width: 0%;">
                            </div>
                        </div>
                        <br />
                        <span class="mdl-badge" data-badge="{{ intval(($book_info->rating)*10) }}">
                            Rating
                        </span>
                        <br />
                        作 者：{{ $book_info->author }}
                        <br />
                        出版社：{{ $book_info->publisher }}
                        <br />
                        页  数：{{ $book_info->pages }}
                        <br />
                        ISBN号：{{ $book_info->isbn }}
                        <br />
                        市场价：{{ $book_info->price }}
                        <br />
                        索引号：{{ $book_info->get_id }}
                      </p>
                      <p>
                        @foreach(explode('|', $book_info->tags) as $tag)
                          <a href="/search/{{ $tag }}/page/1">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                              {{ $tag }}
                            </button>
                          </a>
                        @endforeach
                    </p>
                </div>
                @if (Auth::check())
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="btn_borrow" onclick="$.post('/manage',{id : {{ $book_info->id }}},function(result){$('#btn_borrow').text('借阅成功，请等待图书管理员审核！');});">
                        我要借阅
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#summary-panel" class="mdl-tabs__tab is-active">
                        简介
                    </a>
                    <a href="#catalog-panel" class="mdl-tabs__tab">
                        目录
                    </a>
                    <a href="#author_intro-panel" class="mdl-tabs__tab">
                        作者简介
                    </a>
                </div>
                <div class="mdl-tabs__panel is-active" id="summary-panel">
                    <p><br />{!! str_replace("\n", '<br />', $book_info->summary) !!}</p>
                </div>
                <div class="mdl-tabs__panel" id="catalog-panel">
                    <p><br />{!! str_replace("\n", '<br />', $book_info->catalog) !!}</p>
                </div>
                <div class="mdl-tabs__panel" id="author_intro-panel">
                    <p><br />{!! str_replace("\n", '<br />', $book_info->author_intro) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
