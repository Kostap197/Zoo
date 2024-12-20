@extends('layouts.app')

@section('title', 'Добавить клетку')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Добавить клетку</h1>
        <form action="{{ route('cages.store') }}" method="POST" class="bg-light p-4 rounded shadow-lg">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-success">Название клетки</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label text-success">Емкость</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('cages.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>


@endsection
