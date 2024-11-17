<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;

class CarController extends Controller
{

    public function view(Request $request): Response
    {
        $search = [];

        // $request->model;

        $cars = null;
        if (count($search) > 0) {
            $cars = Car::where($search);
        }
        else {
            $cars = Car::all();
        }

        return Inertia::render('Car/View', ['cars' => $cars]);
    }

    public function add(): Response
    {
        return Inertia::render('Car/Edit');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'number_plate' => 'required|string',
            'model' => 'required|string',
            'trademark' => 'required|string',
            'production_year' => 'required|integer|digits:4',
            'rent_price' => 'required|integer',
            'available' => 'required|bool'
        ]);

        $car = Car::updateOrCreate([
            'id' => $request->id,
        ],
        [
            'number_plate' => $request->number_plate,
            'model' => $request->model,
            'trademark' => $request->trademark,
            'production_year' => $request->production_year,
            'rent_price' => $request->rent_price,
            'available' => $request->available,
        ]);

        return Redirect::route('car.view');
    }

    public function edit(Request $request): Response
    {
        $id = $request->id;
        $car = Car::find($id);

        return Inertia::render('Car/Edit', ['car' => $car, 'edit' => true]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $number_plate = $request->number_plate;
        $car = Car::firstWhere('number_plate', $number_plate);

        $car->delete();

        return Redirect::route('car.view');
    }
}
