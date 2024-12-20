<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cage;
use App\Models\Animal;

class CageController extends Controller
{
    public function index()
    {
        $cages = Cage::all();
        $totalAnimals = Animal::count();
        return view('cages.index', compact('cages', 'totalAnimals'));
    }

    public function create()
    {
        return view('cages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
        ]);
        Cage::create($request->all());
        return redirect()->route('cages.index');
    }

    public function show(Cage $cage)
    {
        return view('cages.show', compact('cage'));
    }

    public function edit(Cage $cage)
    {
        return view('cages.edit', compact('cage'));
    }

    public function update(Request $request, Cage $cage)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
        ]);

        // Проверка вместимости
        if ($request->capacity < $cage->animals->count()) {
            return redirect()->back()->withErrors([
                'capacity' => 'Невозможно установить вместимость меньше, чем текущее количество животных в клетке (' . $cage->animals->count() . ').'
            ]);
        }

        $cage->update($request->all());
        return redirect()->route('cages.index')->with('success', 'Клетка успешно обновлена!');
    }


    public function destroy(Cage $cage)
    {
        if ($cage->animals->count() > 0) {
            return redirect()->route('cages.index')->with('error', 'Сначала переселите животных');
        }
        $cage->delete();
        return redirect()->route('cages.index');
    }


}
