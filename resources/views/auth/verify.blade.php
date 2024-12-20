@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header text-center text-success font-weight-bold">{{ __('Подтверждение электронной почты') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('На вашу электронную почту был отправлен новый ссылку для подтверждения.') }}
                            </div>
                        @endif

                        <p>{{ __('Перед тем, как продолжить, пожалуйста, проверьте вашу почту для ссылки для подтверждения.') }}</p>
                        <p>{{ __('Если вы не получили письмо') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Нажмите здесь, чтобы запросить другое письмо') }}</button>.
                        </form>
                        </p>
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

        .btn-link {
            color: #388e3c; /* Зеленая ссылка */
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .alert-success {
            background-color: #d4edda; /* Зеленый фон для уведомлений */
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
@endsection
