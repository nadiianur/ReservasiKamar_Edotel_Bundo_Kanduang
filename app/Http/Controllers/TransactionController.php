<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
