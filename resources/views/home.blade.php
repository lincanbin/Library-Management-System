@extends('layouts.app')
@section('title', '暨南大学珠海校区图书馆')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    {{ var_dump($classes) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
