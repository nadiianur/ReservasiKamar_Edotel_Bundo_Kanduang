<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

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

        if (Auth::user()->role == 'customer') {
            return redirect('booking')->with('success', 'Transaction deleted successfully');
        } elseif (Auth::user()->role == 'admin') {
            return redirect('transactions')->with('success', 'Transaction deleted successfully');
        }
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
            'status' => 'filled',
        ];

        // $data['id_user'] = Auth::id();
        // $data['id_kamar'] = Kamar::find($id_kamar);
        // $data['lama_penginapan'] = $data['check_in_at']->diff($data['check_out_at'])->days;
        // $data['total_harga'] = $data['lama_penginapan'] * $rooms->harga;
        // $data['status'] = 'booking';

        Transaksi::create($dataBooking);

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_transaksi)
    {
        $data = $request->validate([
            'check_in_at' => 'required|date',
            'check_out_at' => 'required|date',
        ]);

        $transactions = Transaksi::findOrFail($id_transaksi);

        // Mengecek user yang sedang login yang dapat mengedit data bookingnya
        if ($transactions->id_user != Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this booking');
        }

        $rooms = Kamar::find($transactions->id_kamar);

        $lama_penginapan = Carbon::parse($data['check_in_at'])->diffInDays(Carbon::parse($data['check_out_at']));
        $total_harga = $lama_penginapan * $rooms->harga;

        $dataUpdate = [
            'check_in_at' => $data['check_in_at'],
            'check_out_at' => $data['check_out_at'],
            'lama_penginapan' => $lama_penginapan,
            'total_harga' => $total_harga,
        ];

        $transactions->update($dataUpdate);

        return redirect('booking')->with('success', 'Booking updated successfully');
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function updateStatus($id_transaksi)
    {
        //ubah status transaksi
        $transactions = Transaksi::findOrFail($id_transaksi);
        $transactions->status = 'booking';
        $transactions->save();

        //ubah status room
        $rooms = Kamar::find($transactions->id_kamar);
        $rooms->status = 'not ready';
        $rooms->save();

        return redirect('booking')->with('success', 'Verified successfully');
    }

    public function cetakBuktiTransaksi($id_transaksi)
    {
        $transactions = Transaksi::findOrFail($id_transaksi);

        $html = View::make('transaction.buktiTransaksi', compact('transactions'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setBasePath(public_path());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        return Response::make($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Stayscape_booking.pdf"',
        ]);

    }
}
