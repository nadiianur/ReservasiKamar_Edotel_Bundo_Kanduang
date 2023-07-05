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
            'status' => 'required',
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

         // Ubah status pembayaran
        if ($transactions->status == 'verified') {
            $transactions->pembayaran = 'paid';
            $transactions->save();
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
            'pembayaran' => 'unpaid',
        ];

        Transaksi::create($dataBooking);

        return redirect('booking')->with('success', 'Booking Room Successful!');
    }

    public function create()
    {
        $user = User::all();
        $kamar = Kamar::all();

        return view('transaction.transactions', compact('user', 'kamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeByAdmin(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_kamar' => 'required',
            'check_in_at' => 'required|date',
            'check_out_at' => 'required|date',
        ]);

        $kamar = Kamar::find($validated['no_kamar']);

        if ($kamar) {
            $lama_penginapan = Carbon::parse($validated['check_in_at'])->diffInDays(Carbon::parse($validated['check_out_at']));
            $total_harga = $lama_penginapan * $kamar->harga;

            $dataBooking = [
                'id_user' => $validated['nama'],
                'id_kamar' => $validated['no_kamar'],
                'check_in_at' => $validated['check_in_at'],
                'check_out_at' => $validated['check_out_at'],
                'lama_penginapan' => $lama_penginapan,
                'total_harga' => $total_harga,
                'status' => 'verified',
                'pembayaran' => 'paid'
            ];

            $kamar->status = 'not ready';
            $kamar->save();
            Transaksi::create($dataBooking);

            return redirect('transactions')->with('success', 'Booking Room Successful!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $id_user = Auth::user();
        $transactions = $id_user->transaksi->where('status', 'filled');
        $user = User::find('id_user');
        $kamar = Kamar::all();
        return view('transaction.booking', compact('transactions', 'user', 'kamar'));
    }

    /**
     * Display the specified resource.
     */
    public function showMyBooking()
    {
        $id_user = Auth::user();
        $transactions = $id_user->transaksi;
        $user = User::find('id_user');
        $kamar = Kamar::all();
        return view('transaction.riwayatBooking', compact('transactions', 'user', 'kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_transaksi)
    {
        $data = $request->validate([
            'no_kamar' => 'required',
            'check_in_at' => 'required|date',
            'check_out_at' => 'required|date',
        ]);

        $transactions = Transaksi::findOrFail($id_transaksi);

        // Mengecek user yang sedang login yang dapat mengedit data booking miliknya
        if (Auth::user()->role == 'customer') {
            if ($transactions->id_user != Auth::id()) {
                return redirect()->back()->with('error', 'You are not authorized to edit this booking');
            }
        }

        $kamar = Kamar::find($data['no_kamar']);

        $lama_penginapan = Carbon::parse($data['check_in_at'])->diffInDays(Carbon::parse($data['check_out_at']));
        $total_harga = $lama_penginapan * $kamar->harga;

        $dataUpdate = [
            'check_in_at' => $data['check_in_at'],
            'check_out_at' => $data['check_out_at'],
            'id_kamar' => $data['no_kamar'],
            'lama_penginapan' => $lama_penginapan,
            'total_harga' => $total_harga,
        ];

        $transactions->update($dataUpdate);
        $kamar->status = 'not ready';
        $kamar->save();

        if (Auth::user()->role == 'customer') {
            return redirect('booking')->with('success', 'Booking updated successfully');
        } elseif (Auth::user()->role == 'admin') {
            return redirect('transactions')->with('success', 'Booking updated successfully');
        }
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function verifyBooking(Request $request, $id_transaksi)
    {
        $request->validate([
            'pembayaran' => 'required',
        ]);

        //ubah status transaksi
        $transactions = Transaksi::findOrFail($id_transaksi);
        $transactions->status = 'booking';


        //ubah status pembayaran berdasarkan checkboxyang dipilih
        $pembayaran = $request->has('pembayaran') ? $request->input('pembayaran')[0] : 'default';
        $transactions->pembayaran = $pembayaran;
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
