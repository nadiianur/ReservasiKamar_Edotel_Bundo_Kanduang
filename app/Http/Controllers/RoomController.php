<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Kamar::all();
        return view('room/rooms' , compact('rooms'));
    }

    public function dashboard()
    {
        $rooms = Kamar::all();
        return view('dashboard', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'no_kamar' => 'required|numeric|unique:rooms,no_kamar',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'kapasitas' => 'required|numeric',
        ]);
        if (Kamar::create($validasi)){
            return redirect()->back()->with('success', 'Room added successfully');
        }
        else{
            return redirect()->back()->with('error', 'Failed to add room');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kamar)
    {
        $data = $request->validate([
            'no_kamar' => 'required|numeric',
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        $rooms = Kamar::findOrFail($id_kamar);
        $rooms->update($request->all());

        return redirect('rooms')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kamar)
    {
        $rooms = Kamar::findOrFail($id_kamar);
        $rooms->delete();

        return redirect('rooms')->with('success', 'Room deleted successfully');
    }
}
