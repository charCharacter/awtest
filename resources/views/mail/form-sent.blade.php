@extends('layouts.mail')
@section('content')

    <p>Данные формы</p>
    <p>Имя:{{$form->name}}</p>
    <p>Текст:{{$form->text}}</p>
    <p>Email:{{$form->user->email}}</p>
    <p>{{$form->comment}}</p>
    @if($isAdmin)
        <p>Ссылка на страницу пользователя: {{route('form.userForm', ['id'=>$form->user->id])}}</p>
    @endif
    <p>Спасибо,<br>
    {{ config('app.name') }}</p>
@endsection

