<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarManagementController extends Controller
{
    public function index()
    {
        // Tambahkan logika Anda di sini untuk menampilkan mobil yang ada di sistem
        $cars = Car::all(); // Mengambil semua data mobil

        return view('manajemen.index', compact('cars')); // Menampilkan view index dengan data mobil yang telah diambil

    }

    public function create()
    {
        // Tambahkan logika Anda di sini untuk membuat mobil baru
        return view('manajemen.create');
    }

    public function store(Request $request)
    {
        // Tambahkan logika Anda di sini untuk menyimpan mobil baru ke dalam sistem
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'license_plate' => 'required',
            'rental_rate' => 'required|numeric',
        ]);

        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate' => $request->rental_rate,
        ]);

        return redirect()->route('manage-cars')
            ->with('success', 'Car created successfully.');
    }

    public function search(Request $request)
    {
        // Tambahkan logika Anda di sini untuk mencari mobil berdasarkan merek, model, atau ketersediaan
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('manage-cars')
            ->with('success', 'Car has been deleted successfully');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('manajemen.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'license_plate' => 'required',
            'rental_rate' => 'required|numeric',
        ]);

        $car = Car::findOrFail($id);

        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate' => $request->rental_rate,
        ]);

        return redirect()->route('manage-cars')
            ->with('success', 'Car updated successfully.');
    }
}
