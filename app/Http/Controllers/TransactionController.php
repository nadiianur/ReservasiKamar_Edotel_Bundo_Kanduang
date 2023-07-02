<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaksi::all();
        $user = User::all();
        $kamar = Kamar::all();
        return view('transaction.transactions' , compact('transactions', 'user', 'kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function verify(Request $request, $id_transaksi)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $transactions = Transaksi::find($id_transaksi);
        $transactions->update($request->all());

        if ($transactions->status == 'check out') {
            $rooms = Kamar::find($transactions->id_kamar);
            if($rooms){
                $rooms->update(['status' => 'ready']);
            }
        }else{
            $rooms = Kamar::find($transactions->id_kamar);
            if($rooms){
            $rooms->update(['status' => 'not ready']);
            }
        }

        return redirect()->back()->with('success', 'Transaction has been verified');
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_transaksi)
    {
        $transactions = Transaksi::findOrFail($id_transaksi);
        $rooms = Kamar::find($transactions->id_kamar);
            if($rooms){
                $rooms->update(['status' => 'ready']);
            }

        $transactions->delete();

        return redirect('transactions')->with('success', 'Transaction deleted successfully');
    }

     /**
     * Display the specified resource.
     */
    public function showStore($id_kamar)
    {
       $rooms = Kamar::findOrFail($id_kamar);
        return view('transaction.roomBooking', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kamar' => 'required|exists:rooms,id_kamar',
            'check_in_at' => 'required|date',
            'check_out_at' => 'required|date',
        ]);

        //req id_kamar yang di klik
        $rooms = Kamar::find($request->id_kamar);
        if (!$rooms) {
            return redirect()->back()->with('error', 'Invalid room ID');
        }

        $lama_penginapan = Carbon::parse($data['check_in_at'])->diffInDays(Carbon::parse($data['check_out_at']));
        $total_harga = $lama_penginapan * $rooms->harga;

        $dataBooking = [
            'id_user' => Auth::id(),
            'id_kamar' => $rooms->id_kamar,
            'check_in_at' => $data['check_in_at'],
            'check_out_at' => $data['check_out_at'],
            'lama_penginapan' => $lama_penginapan,
            'total_harga' => $total_harga,
            'status' => 'booking',
        ];

        // $data['id_user'] = Auth::id();
        // $data['id_kamar'] = Kamar::find($id_kamar);
        // $data['lama_penginapan'] = $data['check_in_at']->diff($data['check_out_at'])->days;
        // $data['total_harga'] = $data['lama_penginapan'] * $rooms->harga;
        // $data['status'] = 'booking';

        Transaksi::create($dataBooking);

        //ubah status room
        $rooms->status = 'not ready';
        $rooms->save();

        return redirect('dashboard')->with('success', 'Booking Room Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $id_user = Auth::user();
        $transactions = $id_user->transaksi;
        $user = User::find('id_user');
        $kamar = Kamar::find('id_kamar');
        return view('transaction.booking', compact('transactions', 'user', 'kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


}
