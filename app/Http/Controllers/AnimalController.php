<?php

namespace App\Http\Controllers;
use App\Models\Cage;
Use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function create()
    {
        $cages = Cage::all();
        return view('animals.create', compact('cages'));
    }

    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'required|integer',
            'description' => 'required',
            'cage_id' => 'required|exists:cages,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Получаем клетку, в которую хотим добавить животное
        $cage = Cage::find($request->cage_id);

        // Проверяем, не превышает ли количество животных в клетке её вместимость
        if ($cage->animals->count() >= $cage->capacity) {
            return redirect()->back()->withErrors(['cage' => 'В этой клетке нет места для нового животного. Освободите место или выберите другую клетку.']);
        }

        // Обработка загрузки фото
        if ($request->hasFile('image')) {
            // Генерация уникального имени для фото
            $imagePath = $request->file('image')->store('animals_image', 'public'); // Сохранение в папку storage/app/public/animals_image
        }

        // Создание нового животного
        Animal::create([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'description' => $request->description,
            'cage_id' => $request->cage_id,
            'image' => $imagePath ?? null, // Если фото было загружено, сохраняем путь к фото
        ]);

        return redirect()->route('animals.index')->with('success', 'Животное успешно добавлено!');
    }

    public function show(Animal $animal)
    {
        return view('animals.show', compact('animal'));
    }




    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('cages.index');
    }

    public function edit(Animal $animal)
    {
        $cages = Cage::all();
        return view('animals.edit', compact('animal', 'cages'));
    }

    public function update(Request $request, Animal $animal)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'species' => 'required',
            'age' => 'required|integer',
            'description' => 'required',
            'cage_id' => 'required|exists:cages,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Валидация для фото
        ]);

        // Сохраняем старое фото, если оно существует
        $imagePath = $animal->image;

        // Если загружено новое фото, обрабатываем его
        if ($request->hasFile('image')) {
            // Удаляем старое фото, если оно было
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            // Генерация уникального имени для нового фото
            $imagePath = $request->file('image')->store('animals_image', 'public');
        }

        // Обновляем животное с новыми данными
        $animal->update([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'description' => $request->description,
            'cage_id' => $request->cage_id,
            'image' => $imagePath, // Сохраняем новый путь к фото
        ]);

        return redirect()->route('animals.index')->with('success', 'Животное успешно обновлено!');
    }

    public function index()
    {
        $animals = Animal::with('cage')->get(); // Получаем всех животных с данными о клетке
        return view('animals.index', compact('animals'));
    }


}
