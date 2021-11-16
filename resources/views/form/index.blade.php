@extends('layouts.main')
@section('content')
    <div class="col-sm-6 col-sm-offset-3">
        <h1>Формы</h1>
        <ul>
            @foreach ($forms as $form)
                <li><p>{{$form->name}}</p>
                    <p>    {{$form->text}}</p>
                    <p>{{$form->user->email}}</p>
                    <p>{{$form->comment}}</p></li>
            @endforeach
        </ul>
    </div>
@endsection
