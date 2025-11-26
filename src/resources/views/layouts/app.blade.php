<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact-form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')  
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">FashionablyLate</a>
      <!-- ボタンの表示非表示 -->
      @if (request()->path() == '/' || 
              request()->path() == 'confirm')
        <!-- お問い合わせフォーム、確認画面(表示なし) -->
        <div class="header-btn">
        </div>
      @elseif (request()->path() == 'login')
        <!-- ログイン画面 -->
        <div class="header-btn">
          <a href="/register" class="header-btn__design">Register</a>
        </div>
      @else
        <!-- 認証あり -->
        @if (Auth::check())
          <form class="form" action="/logout" method="post">
            @csrf
            <div class="header-btn">
              <button type="submit" class="header-btn__design">LogOut</button>
            </div>
          </form>
        @else
          <!-- 認証なし -->
          <div class="header-btn">
            <a href="/login" class="header-btn__design">Login</a>
          </div>
        @endif
      @endif
    </div>
  </header>
  <main>
    @yield('content')
  </main>
</body>
</html>