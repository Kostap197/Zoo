@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Редактировать животное</h1>

        <form action="{{ route('animals.update', $animal) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-success">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ $animal->name }}" required>
            </div>

            <div class="mb-3">
                <label for="species" class="form-label text-success">Вид</label>
                <input type="text" name="species" class="form-control" value="{{ $animal->species }}" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label text-success">Возраст</label>
                <input type="number" name="age" class="form-control" value="{{ $animal->age }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-success">Описание</label>
                <textarea name="description" class="form-control" required>{{ $animal->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="cage_id" class="form-label text-success">Клетка</label>
                <select name="cage_id" class="form-control" required>
                    @foreach($cages as $cage)
                        <option value="{{ $cage->id }}" @if($cage->id == $animal->cage_id) selected @endif>
                            {{ $cage->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label text-success">Текущая фотография</label>
                @if ($animal->image)
                    <div class="mb-3">
                        <img src="{{ asset('../storage/app/public/' . $animal->image) }}" alt="Фото животного" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @else
                    <p>Фото отсутствует</p>
                @endif
                <label for="image" class="form-label text-success">Заменить фотографию</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>


@endsection
