<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $query = Person::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->department) {
            $query->where('known_for_department', $request->department);
        }

        $sort = $request->get('sort', 'popularity');
        $direction = $request->get('direction', 'desc');
        $people = $query->orderBy($sort, $direction)->get();

        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'known_for_department' => 'required',
            'popularity' => 'required|numeric',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biography' => 'nullable|string',
        ]);

        $profilePath = null;
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('people', 'public');
            $profilePath = '/storage/' . $profilePath;
        }

        Person::create([
            'tmdb_id' => rand(100000, 999999),
            'name' => $request->name,
            'known_for_department' => $request->known_for_department,
            'popularity' => $request->popularity,
            'profile_path' => $profilePath,
            'biography' => $request->biography,
        ]);

        return redirect()->route('people.index')->with('success', 'Person added successfully');
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required',
            'known_for_department' => 'required',
            'popularity' => 'required|numeric',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biography' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('people', 'public');
            $data['profile_path'] = '/storage/' . $profilePath;
        }

        $person->update($data);

        return redirect()->route('people.index')->with('success', 'Person updated successfully');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('people.index')->with('success', 'Person deleted successfully');
    }
}
