@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="content">
  <h2 class="content-title">Confirm</h2>
  <form class="confirm-form" action="/thanks" method="post">
    @csrf
    <!-- お名前 -->
    <div class="confirm-form__name">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">お名前</p>
        <!-- 表示用　姓+名 -->
        <input class="confirm-form__fullname-input" value="{{ $contact['last_name'] . ' ' . $contact['first_name'] }}" readonly>
        <!-- 送信用　姓名別 -->
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="first_name"  value="{{ $contact['first_name'] }}">
      </div>
    </div>
    <!-- 性別 -->
    <div class="confirm-form__gender">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">性別</p>
        @php 
          $genderText = [ '1' => '男性', '2' => '女性', '3' => 'その他', ]; 
        @endphp
        <!-- 表示用 -->
        <input class="confirm-form__gender-checkbox" value="{{ $genderText[$contact['gender']] ?? '' }}" readonly />
        <!-- 送信用 -->
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
      </div>
    </div>
    <!-- メールアドレス -->
    <div class="confirm-form__email">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">メールアドレス</p>
        <input class="confirm-form__email-input" value="{{ $contact['email'] }}" name="email" readonly />
      </div>
    </div>
    <!-- 電話番号 -->
    <div class="confirm-form__tel">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">電話番号</p>
        <input class="confirm-form__tel-input"  
          value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" name="tel" readonly />
        <!-- 送信用 -->
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
      </div>
    </div>
    <!-- 住所 -->
    <div class="confirm-form__address">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">住所</p>
        <input class="confirm-form__address-input" value="{{ $contact['address'] }}" name="address" readonly />
      </div>
    </div>
    <!-- ビル -->
    <div class="confirm-form__building">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">建物名</p>
        <input class="confirm-form__building-input" value="{{ $contact['building'] }}" name="building" readonly />
      </div>
    </div>
    <!-- お問い合わせの種類 -->
    <div class="confirm-form__category">
      <div class="confirm-form__inner">
        <p class="confirm-form__title">お問い合わせの種類</p>
        <!-- 表示用 -->
        <input class="confirm-form__category-select" value="{{ $categories->firstWhere('id', $contact['category_id'])->content ?? '' }}" readonly>
        <!-- 送信用 -->
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
      </div>  
    </div>
    <!-- お問い合わせ内容 -->
    <div class="confirm-form__detail">
      <div class="confirm-form__inner--textarea">
        <p class="confirm-form__title">お問い合わせ内容</p>
        <input class="confirm-form__detail--textarea" value="{{ $contact['detail'] }}" name="detail" readonly />
      </div>
    </div>
    <!-- ボタン -->
    <div class="confirm-form__button">
      <!-- 送信 -->
      <button class="confirm-form__button-submit" type="submit">送信</button>
      <!-- 修正 -->
      <button class="confirm-form__button-modify" onclick="history.back();" type="button">修正</button>
    </div>
  </form>
</div>
@endsection