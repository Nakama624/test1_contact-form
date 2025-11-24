@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
  <h2 class="content__title">Register</h2>
  <form class="create-form" action="/register" method="post">
    @csrf
    <div class="create-form__content">
      <!-- お名前 -->
      <div class="create-form__name">
        <p class="create-form__title">お名前</p>
        <div class="create-form__section">
          <input class="create-form__input" type="text" name="name"  placeholder="例　山田 太郎" value="{{ old('name') }}">
          <div class="form__error">
          @error('name')
            {{ $message }}
          @enderror
          </div>
        </div>
      </div>
    
      <!-- メールアドレス -->
      <div class="create-form__email">
        <p class="create-form__title">メールアドレス</p>
        <div class="create-form__section">
          <input class="create-form__input" type="text" name="email" placeholder="例　test@example.com" value="{{ old('email') }}">
          <div class="form__error">
            @error('email')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <!-- パスワード -->
      <div class="create-form__password">
        <p class="create-form__title">パスワード</p>
        <div class="create-form__section">
          <input class="create-form__input" type="text" name="password" placeholder="例　coachtech1106" value="{{ old('password') }}">
          <div class="form__error">
            @error('password')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <!-- ボタン -->
      <div class="create-form__button">
        <button class="create-form__button-submit" type="submit">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection