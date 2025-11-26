@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="content">
  <h2 class="content__title">login</h2>
  <form class="login-form" action="/login" method="post">
    @csrf
    <div class="login-form__content">
      <!-- メールアドレス -->
      <div class="login-form__email">
        <p class="login-form__title">メールアドレス</p>
        <div class="login-form__section">
          <input class="login-form__input" type="email" name="email" placeholder="例　test@example.com" value="{{ old('email') }}">
          <div class="form__error">
            @error('email')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <!-- パスワード -->
      <div class="login-form__password">
        <p class="login-form__title">パスワード</p>
        <div class="login-form__section">
          <input class="login-form__input" type="password" name="password" placeholder="例　coachtech1106">
          <div class="form__error">
            @error('password')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <!-- ボタン -->
      <div class="login-form__button">
        <button class="login-form__button-submit" type="submit">ログイン</button>
      </div>
    </form>
  </div>
</div>
@endsection