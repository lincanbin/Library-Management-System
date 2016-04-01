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
    </tr>
  </thead>
  <tbody>
    @foreach($records as $record)
    <tr>
      <td>
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{ $record->id }}">
          <input type="checkbox" id="switch-{{ $record->id }}" class="mdl-switch__input" {{ $record->enable==1?'checked="checked"':'' }}>
        </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">{{ $record->name }}</td>
      <td>{{ $record->email }}</td>
      <td>{{ $record->time }}</td>
      <td>{{ $record->return_time==0?'未归还':$record->return_time }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</section>
@endsection
