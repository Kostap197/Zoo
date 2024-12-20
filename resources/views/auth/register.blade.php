@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header text-center text-success font-weight-bold">{{ __('Регистрация') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Имя') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Электронная почта') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Пароль') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Подтвердите пароль') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-lg">{{ __('Зарегистрироваться') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f8f9fa; /* Светлый фон страницы */
        }

        .card {
            border-radius: 12px; /* Закругленные углы */
        }

        .card-header {
            background-color: #4CAF50; /* Зеленый фон */
            color: white;
            font-size: 1.5rem;
            padding: 15px;
        }

        .card-body {
            background-color: #ffffff; /* Белый фон для формы */
            padding: 30px;
        }

        .btn-success {
            background-color: #388e3c; /* Зеленая кнопка */
            border-color: #388e3c;
        }

        .btn-success:hover {
            background-color: #2c6f30; /* Темно-зеленая кнопка при наведении */
            border-color: #2c6f30;
        }

        .form-control {
            border-radius: 8px; /* Закругленные углы полей ввода */
        }

        .invalid-feedback {
            font-size: 0.875rem;
            color: #dc3545;
        }

        .btn-link {
            color: #4CAF50; /* Зеленая ссылка */
        }

        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection
