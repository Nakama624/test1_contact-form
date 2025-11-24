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
      @if (request()->is('register'))
      <div class="header-btn">
        <button class="header-btn__design">Login</button>
      </div>
      @elseif(request()->is('login'))
      <div class="header-btn">
        <button class="header-btn__design">register</button>
      </div>
      @elseif(request()->is('admin'))
      <div class="header-btn">
        <button class="header-btn__design">LogOut</button>
      </div>      
      @endif
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>