@extends('layouts.app')
@section('title', '借书管理')
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Material</th>
      <th>Quantity</th>
      <th>Unit price</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $key => $record)
    <tr>
      <td class="mdl-data-table__cell--non-numeric">Acrylic (Transparent)</td>
      <td>25</td>
      <td>$2.90</td>
    </tr>
    @endforeach
  </tbody>
</table>
</section>
@endsection
