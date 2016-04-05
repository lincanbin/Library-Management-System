@extends('layouts.app')
@section('title', '借书管理')
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
<table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">允许借阅</th>
      <th>书名</th>
      <th>借阅人</th>
      <th>借阅时间</th>
      <th>归还时间</th>
      <th class="mdl-data-table__cell--non-numeric">归还图书</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $record)
    <tr>
      <td>
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="enable-{{ $record->id }}">
          <input type="checkbox" id="enable-{{ $record->id }}" class="mdl-switch__input" {{ $record->enable==1?'checked="checked"':'' }}>
        </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">{{ $record->book_name }}</td>
      <td>{{ $record->user_name }}</td>
      <td>{{ date('Y-m-d H:i', $record->time) }}</td>
      <td>
      @if( $record->return_time > 0 )
          {{ date('Y-m-d H:i', $record->return_time) }}
      @elseif(($record->time+86400*60) < time())
           已逾期
      @elseif(($record->time+86400*30) < time())
           即将逾期
      @else
          未归还
      @endif
      </td>
      <td>
      @if( $record->return_time == 0 && $record->enable == 1)
          <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="return-{{ $record->id }}">
            <input type="checkbox" id="return-{{ $record->id }}" class="mdl-switch__input">
          </label>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</section>
@endsection
