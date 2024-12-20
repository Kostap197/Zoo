<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Виртуальный зоопарк')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Общие стили */
        html, body {
            height: 100%;
            color: #dcd7c9; /* Светлый текст */
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        /* Стили для навигации */
        nav.navbar {
            background-color: #1b2b2b; /* Очень тёмный зелёный/сине-зелёный */
        }

        nav.navbar .navbar-brand {
            color: #c4a484; /* Светло-коричневый */
            font-weight: bold;
            font-size: 1.5rem;
        }

        nav.navbar .nav-link {
            color: #dcd7c9 !important; /* Светлый текст */
            transition: color 0.3s ease;
        }

        nav.navbar .nav-link:hover {
            color: #a4c3b2 !important; /* Светло-зелёный при наведении */
        }

        button.navbar-toggler {
            border-color: #c4a484; /* Светло-коричневый */
        }

        /* Стили для футера */
        footer {
            background-color: #1b2b2b; /* Темный футер */
            color: #dcd7c9; /* Светлый текст */
        }

        footer p {
            margin: 0;
        }

        /* Кнопка выхода */
        button.btn-link {
            color: #dcd7c9 !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        button.btn-link:hover {
            color: #a4c3b2 !important; /* Акцентный светло-зелёный */
        }
    </style>
</head>
<body class="d-flex flex-column">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">🌿 Зоопарк</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cages.index') }}">Клетки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('animals.index') }}">Животные</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('animals.create') }}">Добавить животное</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cages.create') }}">Добавить клетку</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Выйти</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="content-wrapper">
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

<footer class="text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} Виртуальный зоопарк</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
