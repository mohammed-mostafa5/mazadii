<?php

namespace App\Http\Controllers\UsersPanel;


use App\Models\Pet;
use App\Models\File;
use App\Models\Breed;
use App\Models\Color;
use App\Models\Gender;
use App\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\File as FacadesFile;

class PetController extends AppBaseController
{

    public function index()
    {
        $pets = Pet::where('user_id', auth()->id())->get();

        return view('usersPanel.page.pets.index', compact('pets'));
    }

    public function create(Pet $pet)
    {
        $genders = Gender::get()->pluck('text', 'id');
        $breeds = Breed::get()->pluck('text', 'id');
        $colors = Color::get()->pluck('text', 'id');
        $pet_types = PetType::get()->pluck('text', 'id');

        return view('usersPanel.page.pets.create', compact('pet', 'genders', 'breeds', 'colors', 'pet_types'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate(Pet::$rules);
        $validated['user_id'] = $user->id;
        $validated['area_id'] = $user->area_id;

        Pet::create($validated);

        return redirect()->route('usersPanel.pets.index');
    }

    public function show(Pet $pet)
    {
        return view('usersPanel.page.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $genders = Gender::get()->pluck('text', 'id');
        $breeds = Breed::get()->pluck('text', 'id');
        $colors = Color::get()->pluck('text', 'id');
        $pet_types = PetType::get()->pluck('text', 'id');


        return view('usersPanel.page.pets.edit', compact('pet', 'genders', 'breeds', 'colors', 'pet_types'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:191',
            'description' => '',
            'gender_id' => 'required',
            'age' => 'required',
            'pet_type_id' => 'required',
            'breed_id' => 'required',
            'color_id' => 'required',
            'license_number' => 'required',
            'vaccinations' => 'required',
            'flesh_marks' => 'required',
            'pedigree' => 'required',
            'medical_history' => 'required',
            'area_id' => '',
            'photo_1' => '',
            'photo_2' => '',
            'photo_3' => '',
        ]);

        $pet->update($validated);

        return redirect()->route('usersPanel.pets.index');
    }

    public function destroy(Pet $pet)
    {

        $pet->delete();

        return redirect()->route('usersPanel.pets.index');
    }
}
