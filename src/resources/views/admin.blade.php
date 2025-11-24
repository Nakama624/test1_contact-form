@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="content">
  <h2 class="content__title">Admin</h2>

  <div class="content-item">
    <div class="search-form">
      <!-- お名前やメールアドレス -->
      <input class="search-form__input" type="text" name="email" placeholder="名前やメールアドレスを入力してください" value="{{ old('email') }}">
      <!-- 性別 -->
      <select class="search-form__gender-select" name="gender">
        <option value="" selected>性別</option>
        <option value="1">男性</option>
        <option value="2">女性</option>
        <option value="3">その他</option>
      </select>
      <!-- お問い合わせの種類 -->
      <select class="search-form__category-select" name="category_id">
        <option value="" selected>お問い合わせの種類</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}"
            {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>
      <!-- 作成日 -->
      <input type="date" name="created_at" class="search-created-input">
      <!-- ボタン -->
      <div class="search-form__button">
        <!-- 検索 -->
        <button class="search-form__button-search" type="submit">検索</button>
        <!-- リセット -->
        <button class="search-form__button-reset" type="button">リセット</button>
      </div>
    </div>
    <div class="export-pagenation">
      <!-- エクスポート -->
      <button class="button__export" type="submit">エクスポート</button>
      <!-- ページネーション -->
      <div class="pagenation">
        <!-- ★要対応 -->
        <!-- {{ $contacts->links() }} -->
      </div>
    </div>
    <!-- テーブル -->
    <table class="contact-list">
      <tr class="contact-list__tr">
        <th class="contact-list__header">お名前</th>
        <th class="contact-list__header">性別</th>
        <th class="contact-list__header">メールアドレス</th>
        <th class="contact-list__header">お問い合わせの種類</th>
        <th class="contact-list__header"></th>
      </tr>
      @foreach ($contacts as $contact)
      <tr class="contact-list__tr">
        <td class="contact-list__td">
          {{$contact->last_name. ' ' . $contact->first_name}}
        </td>
        @php 
          $genderText = [ '1' => '男性', '2' => '女性', '3' => 'その他', ]; 
        @endphp
        <td class="contact-list__td">{{ $genderText[$contact->gender] }}</td>
        <td class="contact-list__td">{{$contact->email}}</td>
        <td class="contact-list__td">{{ $categories->firstWhere('id', $contact->category_id)->content }}</td>
        <td class="contact-list__td">
          <a href="#modal-{{ $contact->id }}" class="button_content-detail">詳細</a>
        </td>
      </tr>
      @endforeach
    </table>

    <!-- モーダル -->
    @foreach ($contacts as $contact)
      <div id="modal-{{ $contact->id }}" class="modal">
        <div class="modal-content">
          <a href="#" class="modal-close">×</a>

          <table class="modal-table">
            <tr>
              <th class="modal-table__header">お名前</thclass=table-name>
              <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">性別</th>
              <td>{{ $genderText[$contact->gender] }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">メールアドレス</th>
              <td>{{ $contact->email }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">電話番号</th>
              <td>{{ $contact->tel }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">住所</th>
              <td>{{ $contact->address }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">建物名</th>
              <td>{{ $contact->building }}</td>
            </tr>
            <tr>
              <th class="modal-table__header">お問い合わせ内容</th>
              <td>{{ $contact->detail }}</td>
            </tr>
          </table>
          <div class="contact-delete">
            <button class="delete-btn" type="submit">削除</button>
          </div>
        </div>
      </div>
    @endforeach



  </div>
</div>

@endsection