@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<!-- ここにページごとの内容を書く -->
<div class="content">
  <h2 class="content__title">Contact</h2>
  <form class="create-form">
    <!-- お名前 -->
    <div class="create-form__name">
      <p class="create-form__title">お名前<span class="create-form__title--red">※</span></p>
      <div class="create-form__fullname">
        <input class="create-form__firstname--input" type="text" name="first_name"  placeholder="（例）山田">
        <input class="create-form__lastname--input" type="text" name="last_name" placeholder="（例）太郎">
      </div>
    </div>
    <!-- 性別 -->
    <div class="create-form__gender">
      <p class="create-form__title">性別<span class="create-form__title--red">※</span></p>
      <!-- 機能要件一覧にてチェックボックス指定あり -->
      <label class="create-form__gender-checkbox">
        <input type="checkbox" name="gender" value="male"> 男性
      </label>
      <label class="create-form__gender-checkbox">
        <input type="checkbox" name="gender" value="female"> 女性
      </label>
      <label class="create-form__gender-checkbox">
        <input type="checkbox" name="gender" value="other"> その他
      </label>
    </div>
    <!-- メールアドレス -->
    <div class="create-form__email">
      <p class="create-form__title">メールアドレス<span class="create-form__title--red">※</span></p>
      <input class="create-form__email-input" type="text" name="email" placeholder="例:test@example.com">
    </div>
    <!-- 電話番号 -->
    <div class="create-form__tel">
      <p class="create-form__title">電話番号<span class="create-form__title--red">※</span></p>
      <div class="create-form--info-tel">
        <input class="create-form__tel1-input" type="text" name="tel1" placeholder="080">
        <p>-</p>
        <input class="create-form__tel2-input" type="text" name="tel2" placeholder="1234">
        <p>-</p>
        <input class="create-form__tel3-input" type="text" name="tel3" placeholder="5678">
      </div>
    </div>
    <!-- 住所 -->
    <div class="create-form__address">
      <p class="create-form__title">住所<span class="create-form__title--red">※</span></p>
      <input class="create-form__address-input" type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
    </div>
    <!-- ビル -->
    <div class="create-form__building">
      <p class="create-form__title">建物名</p>
      <input class="create-form__building-input" type="text" name="building" placeholder="例:千駄ヶ谷マンション101">
    </div>
    <!-- お問い合わせの種類 -->
    <div class="create-form__category">
      <p class="create-form__title">お問い合わせの種類<span class="create-form__title--red">※</span></p>
      <select class="create-form__category-select" name="category_id">
        <option value="" selected>カテゴリを選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->content }}</option>
        @endforeach
      </select>
    </div>
    <!-- お問い合わせ内容 -->
    <div class="create-form__detail">
      <p class="create-form__title--detail">お問い合わせ内容<span class="create-form__title--red">※</span></p>
      <textarea class="create-form__detail-text" name="detail" placeholder="例:お問い合わせ内容をご記載ください"></textarea>
    </div>
    <!-- ボタン -->
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection