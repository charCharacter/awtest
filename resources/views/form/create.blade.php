@extends('layouts.main')
@section('content')
<div class="col-sm-6 col-sm-offset-3">
    <h1>Отправить форму</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success') }}
        </div>
    @endif
    <form role="form" id="contactForm" method="POST" action="/form">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-sm-8">
                <label for="name" class="h4">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <label for="name" class="h4">Email</label>
                <input type="email" class="form-control" id="email" name="user[email]" placeholder="Введите email" required>
                <div class="help-block with-errors">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <label for="text" class="h4">Введите текст</label>
                <textarea class="form-control" id="text" name="text" rows="3"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <img src="{{ $captcha }}" alt="captcha" class="captcha-img" data-refresh-config="default"><a href="#" id="refresh"><span class="glyphicon glyphicon-refresh"></span></a></p>
                <label for="name" class="h4">Введите рузультат вычеслений</label>
                <input type="number" class="form-control" id="secure" name="secure" placeholder="" required>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <button type="submit" class="btn btn-primary mb-2">Отправить</button>
            </div>
        </div>

    </form>
</div>
@endsection
