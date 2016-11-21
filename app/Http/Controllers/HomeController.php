<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Species;
use App\Breeds;
use App\Animals;

class HomeController extends Controller
{

    public function __construct()
    {
        //  $this->middleware('auth');
    }

    public function index()
    {
        $species = Species::all();
        $animals = Animals::all();
        return view('welcome')->withAnimals($animals)->withSpecies($species);
    }

    public function getContact()
    {
        return view('contacts');
    }

    public function getPortfolio()
    {
        $species = Species::all();
        return view('portfolio')->withSpecies($species);
    }

    public function getBreed($id)
    {
        $breeds = Breeds::where('species_id', $id)->get();
        echo "<option  selected >" . "Всі </option>";
        foreach ($breeds as $breed) {
            echo "<option value=" . '"' . $breed->id . '">' . $breed->name . "</option>";
        };

    }
    public function getBreedPort($id)
    {
        $breeds = Breeds::where('species_id', $id)->get();
       // echo "<option  selected >" . "Всі </option>";
        foreach ($breeds as $breed) {
            echo "<option value=" . '"' . $breed->id . '">' . $breed->name . "</option>";
        };

    }

    public function search(Request $request)
    {
        $s = $request->input('species');
        $b = $request->input('breed');
        $br='';
        if ($b and ($b !== "Всі")) {
            $animals = Animals::where('breed_id', $b)->get();
            $br=Breeds::find($b);
        } else {
            if ($s !== "Всі") {
                $animals = Animals::where('species_id', $s)->get();
            } else {
                $animals = Animals::all();
            }
        }
        $species = Species::all();

        return view('welcome')->withAnimals($animals)->withSpecies($species)->withS($s)->withBr($br)->withB($b);

    }
}



