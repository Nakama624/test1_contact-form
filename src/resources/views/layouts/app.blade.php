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
        <div class="header__btn">
        </div>
      @elseif (request()->path() == 'login')
        <!-- ログイン画面 -->
        <div class="header__btn">
          <a href="/register" class="header__btn--design">Register</a>
        </div>
      @else
        <!-- 認証あり -->
        @if (Auth::check())
          <form action="/logout" method="post">
            @csrf
            <div class="header__btn">
              <button type="submit" class="header__btn--design">LogOut</button>
            </div>
          </form>
        @else
          <!-- 認証なし -->
          <div class="header__btn">
            <a href="/login" class="header__btn--design">Login</a>
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