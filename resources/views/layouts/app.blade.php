<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link rel="stylesheet" href="/static/css/material.min.css">
    <link rel="stylesheet" href="/static/css/global.css">
</head>

  <body class="mdl-container mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
          <h3>@yield('title')</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
          <a href="{{ url('/') }}#main" class="mdl-layout__tab is-active">首页</a>
          <a href="#search_layout" class="mdl-layout__tab">搜索</a>
        @if (Auth::guest())
            <a href="{{ url('/login') }}" class="mdl-layout__tab">登录</a>
            <a href="{{ url('/register') }}" class="mdl-layout__tab">注册</a>
        @else
            <a href="#main" class="mdl-layout__tab"> {{ Auth::user()->name }} </a>
            <a href="{{ url('/logout') }}" class="mdl-layout__tab">退出</a>
        @endif
          <a href="#features" class="mdl-layout__tab">Details</a>
          <a href="#features" class="mdl-layout__tab">Technology</a>
          <a href="#features" class="mdl-layout__tab">FAQ</a>
          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--4dp mdl-color--accent" id="search">
            <i class="material-icons" role="presentation">search</i>
            <span class="visuallyhidden">Search</span>
          </button>
        </div>
      </header>
      <main class="mdl-layout__content">
        <div class="mdl-layout__tab-panel is-active" id="main">
          <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
            @yield('content')
          </section>
        </div>
         <div class="mdl-layout__tab-panel" id="search_layout">
            <section class="section--center mdl-grid mdl-grid--no-spacing">
            <div class="mdl-cell mdl-cell--12-col">
              <h4>搜索</h4>
              这里准备放个搜索框
            </div>
          </section>
        </div>
        <footer class="mdl-mega-footer">
          <div class="mdl-mega-footer--middle-section">
            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
              <h1 class="mdl-mega-footer--heading">Features</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="#">About</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Partners</a></li>
                <li><a href="#">Updates</a></li>
              </ul>
            </div>
            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
              <h1 class="mdl-mega-footer--heading">Details</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="#">Spec</a></li>
                <li><a href="#">Tools</a></li>
                <li><a href="#">Resources</a></li>
              </ul>
            </div>
            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
              <h1 class="mdl-mega-footer--heading">Technology</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="#">How it works</a></li>
                <li><a href="#">Patterns</a></li>
                <li><a href="#">Usage</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contracts</a></li>
              </ul>
            </div>
            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
              <h1 class="mdl-mega-footer--heading">FAQ</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="#">Questions</a></li>
                <li><a href="#">Answers</a></li>
                <li><a href="#">Contact us</a></li>
              </ul>
            </div>
          </div>
          <div class="mdl-mega-footer--bottom-section">
            <div class="mdl-logo">
              More Information
            </div>
            <ul class="mdl-mega-footer--link-list">
              <li><a href="https://developers.google.com/web/starter-kit/">Web Starter Kit</a></li>
              <li><a href="#">Help</a></li>
              <li><a href="#">Privacy and Terms</a></li>
            </ul>
          </div>
        </footer>
      </main>
    </div>
    <script src="/static/js/material.min.js"></script>
  </body>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</html>
