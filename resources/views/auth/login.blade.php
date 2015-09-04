@extends('layouts.login')

@section('title') Login @endsection

@section('styles')
<style>
body
{
    background: url(img/backgrounds/003.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}    
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-24 col-sm-8 loginbox">
    {!! Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'form-horizontal']) !!}
        
        <h2>Welcome</h2>
        <p>Enter your account details to Login.</p>        

        <div class="form-group">
            <div class="input-group">
            <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
            {!! Form::text('email', null, 
            ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'E-mail', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
            <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
            {!! Form::password('password', 
            ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Password', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label for="remember">
                    {!! Form::checkbox('remember', null, null, ['id' => 'remember']) !!} Remember Me
                </label>
            </div>
            <small class="text-danger">{{ $errors->first('remember') }}</small>
        </div>

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong>            
            @foreach ($errors->all() as $error)
                <br>{{ $error }}
            @endforeach            
        </div>
        @endif

        <div class="btn-group pull-right">
            {!! Form::submit("Login", ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
    </div>
</div>

@endsection