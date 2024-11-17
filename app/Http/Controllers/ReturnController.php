<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RentTransaction;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;

class ReturnController extends Controller
{

    public function view(Request $request): Response
    {
        $search = [];

        // $request->model;

        $userId = Auth::user()->id;
        $customer = Customer::where('user_id', $userId)->first();
        $transaction = RentTransaction::where('customer', $customer->id)->where('is_return', 1);

        return Inertia::render('Return/View', ['transaction' => $transaction]);
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

        $car = RentTransaction::updateOrCreate([
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
        $user = Auth::user()->user;
        $id = $request->id;
        $customer = Customer::where('user_id', $user->id)->first();
        $transaction = RentTransaction::where([
            ['id' => $user->id],
            ['is_returned' => 1]
        ]);

        return Inertia::render('Return/Edit', ['transaction' => $transaction, 'edit' => true]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $number_plate = $request->number_plate;
        $car = RentTransaction::firstWhere('number_plate', $number_plate);

        $car->delete();

        return Redirect::route('car.view');
    }
}
