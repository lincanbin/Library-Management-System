<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('title')
        </title>
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
                    <h3>
                        @yield('title')
                    </h3>
                </div>
                <div class="mdl-layout--large-screen-only mdl-layout__header-row">
                </div>
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
                    <a href="{{ url('/') }}" class="mdl-layout__tab{!!(Request::is('/')) ? ' is-active' : '' !!}">
                        首页
                    </a>
                    <a href="#main" class="mdl-layout__tab{!!(Request::is('/')) ? '' : ' is-active' !!}">
                        当前页
                    </a>
                    <a href="#search_layout" class="mdl-layout__tab">
                        搜索
                    </a>
                    <a href="#help" class="mdl-layout__tab">
                        帮助
                    </a>
                    @if (Auth::guest())
                    <a href="#login_layout" class="mdl-layout__tab">
                        登录
                    </a>
                    <a href="#register_layout" class="mdl-layout__tab">
                        注册
                    </a>
                    @else
                    <a href="#main" class="mdl-layout__tab">
                        {{ Auth::user()->name }}
                    </a>
                    <a href="{{ url('/logout') }}" class="mdl-layout__tab">
                        退出
                    </a>
                    @endif
                    <a href="#search_layout">
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--4dp mdl-color--accent"
                        id="search">
                            <i class="material-icons" role="presentation">
                                search
                            </i>
                            <span class="visuallyhidden">
                                Search
                            </span>
                        </button>
                    </a>
                </div>
            </header>
            <main class="mdl-layout__content">
                <div class="mdl-layout__tab-panel is-active" id="main">
                    @yield('content')
                </div>
                <div class="mdl-layout__tab-panel" id="search_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                搜索
                            </h4>
                            <p>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" id="search_text">
                                    <label class="mdl-textfield__label" for="search_text">
                                        关键词
                                    </label>
                                </div>
                                <button onclick="window.location.href='/search/'+$('#search_text').val()+'/page/1';"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                    搜索
                                </button>
                            </p>
                        </div>
                    </section>
                </div>
                @if (Auth::guest())
                <div class="mdl-layout__tab-panel" id="login_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                登录
                            </h4>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {!! csrf_field() !!}
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            E-Mail Address
                                        </label>
                                        <input type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}">
                                    </div>
                                    <br />
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Password
                                        </label>
                                        <input type="password" class="mdl-textfield__input" name="password">
                                    </div>
                                </p>
                                <p>
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="remember"
                                        checked>
                                        <span class="mdl-checkbox__label">
                                            记住登录状态
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                        <i class="fa fa-btn fa-sign-in">
                                        </i>
                                        登录
                                    </button>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        忘记密码？
                                    </a>
                                </p>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="mdl-layout__tab-panel" id="register_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                注册
                            </h4>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                {!! csrf_field() !!}
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Name
                                        </label>
                                        <input type="text" class="mdl-textfield__input" name="name" value="{{ old('name') }}">
                                    </div>
                                </p>
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            E-Mail Address
                                        </label>
                                        <input type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}">
                                    </div>
                                </p>
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Password
                                        </label>
                                        <input type="password" class="mdl-textfield__input" name="password">
                                    </div>
                        </div>
                        </p>
                        <p>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <label class="mdl-textfield__label">
                                    Confirm Password
                                </label>
                                <input type="password" class="mdl-textfield__input" name="password_confirmation">
                            </div>
                        </p>
                        <p>
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                <i class="fa fa-btn fa-user">
                                </i>
                                注册
                            </button>
                        </p>
                        </form>
                </div>
                </section>
        </div>
        @endif
        <footer class="mdl-mega-footer">
            <div class="mdl-mega-footer--middle-section">
                <div class="mdl-mega-footer--drop-down-section">
                    <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
                    <h1 class="mdl-mega-footer--heading">
                        校内图书馆
                    </h1>
                    <ul class="mdl-mega-footer--link-list">
                        <li>
                            <a href="#">
                                暨南大学图书馆
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                暨南大学珠海校区图书馆
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                暨南大学南校区图书馆
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mdl-mega-footer--drop-down-section">
                    <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
                    <h1 class="mdl-mega-footer--heading">
                        友情链接
                    </h1>
                    <ul class="mdl-mega-footer--link-list">
                        <li>
                            <a href="#">
                                Spec
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Tools
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Resources
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mdl-mega-footer--drop-down-section">
                    <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
                    <h1 class="mdl-mega-footer--heading">
                        相关政策
                    </h1>
                    <ul class="mdl-mega-footer--link-list">
                        <li>
                            <a href="#">
                                How it works
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Patterns
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Usage
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Contracts
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mdl-mega-footer--drop-down-section">
                    <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked>
                    <h1 class="mdl-mega-footer--heading">
                        帮助中心
                    </h1>
                    <ul class="mdl-mega-footer--link-list">
                        <li>
                            <a href="#">
                                Questions
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Answers
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Contact us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mdl-mega-footer--bottom-section">
                <div class="mdl-logo">
                    Powered By © 2006-2016 林灿斌
                </div>
                <ul class="mdl-mega-footer--link-list">
                    <li>
                        <a href="https://github.com/lincanbin/Library-Management-System">
                            Source Code
                        </a>
                    </li>
                    <li>
                        <a href="http://weibo.com/lincanbin">
                            Weibo
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/lincanbin">
                            GitHub
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
        </main>
        </div>
        <script src="/static/js/jquery.min.js">
        </script>
        <script src="/static/js/material.min.js">
        </script>
    </body>
    {{--
    <script src="{{ elixir('js/app.js') }}">
    </script>
    --}}

</html>