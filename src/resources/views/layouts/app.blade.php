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
      @if (request()->path() === 'register')
        <div class="header-btn">
          <a href="/login" class="header-btn__design">Login</a>
        </div>
      @elseif (request()->path() === 'login')
        <div class="header-btn">
          <a href="/register" class="header-btn__design">register</a>
        </div>
      @elseif (request()->path() === 'admin' ||
              request()->path() === 'search' ||
              request()->path() === 'reset' )  
        <div class="header-btn">
          <a href="/logout" class="header-btn__design">LogOut</a>
        </div>      
      @endif
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>