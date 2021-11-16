@extends('layouts.mail')
@section('content')

    <p>Получено письмо от</p>
    <p>{{$form->name}}</p>
    <p>    {{$form->text}}</p>
    <p>{{$form->user->email}}</p>
    <p>{{$form->comment}}</p>
    @if($isAdmin)
        <p>Ссылка на страницу пользователя: {{route('form.userForm', ['id'=>$form->user->id])}}</p>
    @endif
    <p>Спасибо,<br>
    {{ config('app.name') }}</p>
@endsection

