@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Добавить животное</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-lg">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-success">Имя</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label text-success">Вид</label>
                <input type="text" name="species" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label text-success">Возраст</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-success">Описание</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cage_id" class="form-label text-success">Клетка</label>
                <select name="cage_id" class="form-control" required>
                    @foreach($cages as $cage)
                        <option value="{{ $cage->id }}">{{ $cage->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label text-success">Фото</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>
        </form>
    </div>


@endsection
