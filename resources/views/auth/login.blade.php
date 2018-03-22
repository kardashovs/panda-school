@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="body">
            <div class="login-block">
                <div class="login-block__container">
                    <form class="login-block__form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="devider form-devider"></div>

                        <div class="login__field-block">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Почта" class="login__field__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="login__field-block">
                            <input id="password" type="password" placeholder="Пароль" class="login__field__input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="login__block-button">
                            <button type="submit" class="login__button login__button--signin">
                                Войти
                            </button>
                        </div>
                        <div class="login__block-button">
                            <button  class="login__button login__button--signup" onclick="location.href='/register'">
                                Регистрация
                            </button>
                        </div>

                        <div class="login__block-full center login__reset-password">
                            <a class="login__password__link" href="{{ route('password.request') }}">Забыли пароль?</a>
                        </div>
                    </form>
                    <div class="devider form-devider"></div>
                </div>
            </div>
        </div>

    </div>


@endsection
