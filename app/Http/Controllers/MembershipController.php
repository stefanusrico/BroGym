<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
// use Yajra\DataTables\Facades\DataTables;
use DataTables;
use Illuminate\Support\Carbon;
use App\Models\Pembayaran;
use App\Models\Transaksi;
class MembershipController extends Controller
{
    public function index()
    {
        return view('page.admin.member.datamember');
    }
    public function showdata()
    {
        $filteredUsers = Pembayaran::with('user')->get();

        return view('page.admin.member.index', compact('filteredUsers'));
    }


    public function daftar()
    {
        $user_id = Auth::id();

        // Check if there is a membership record for the user
        $membership = Membership::where('id_user', $user_id)->first();

        // Determine the membership status
        $statusMember = $membership ? 1 : 0;
        $tanggalKadaluarsa = null;

        // Jika keanggotaan ditemukan, tambahkan informasi tanggal_pembayaran + 30 hari
        if ($membership) {
            $tanggalLangganan = Carbon::parse($membership->tanggal_langganan);
            $tanggalKadaluarsa = $tanggalLangganan->addDays(30);
            $tl = Carbon::parse($membership->tanggal_langganan);
            $tanggalLangganan = $tl ? $tl->formatLocalized('%d-%B-%Y') : null;
            setlocale(LC_TIME, 'id_ID'); // Atur locale ke Bahasa Indonesia

            $formattedTanggalKadaluarsa = $tanggalKadaluarsa ? $tanggalKadaluarsa->formatLocalized('%d-%B-%Y') : null;

            return view('page.user.membership.daftar', compact('user_id','statusMember', 'tanggalLangganan','formattedTanggalKadaluarsa'));
        }

        else{
            return view('page.user.membership.daftar', compact('user_id','statusMember'));
        }
        }






    public function getDataMember(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $members = Membership::select(['id', 'id_user', 'status', 'tanggal_langganan'])->get();

            return DataTables::of($members)
                ->addColumn('user_name', function ($member) {
                    return $member->user->name ?? '';
                })
                ->addColumn('action', function ($member) {
                    $url = route('membership.edit', ['id' => $member->id]);
                    $urlHapus = route('membership.delete', $member->id);
                    return '<a href="' . $url . '" class="btn btn-primary">Edit</a>
                    <a href="' . $urlHapus . '" class="btn btn-danger">Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('page.admin.member.datamember');
    }


    public function store(Request $request)
{
    $this->validate($request, [
        'id_user' => 'required|exists:users,id',
    ]);

    $user = User::findOrFail($request->id_user);
    $pembayaran = Pembayaran::findOrFail($request->id_pembayaran);

    // Perform the operation within a transaction



        if ($user->membership) {
            return redirect()->route('membership.showdata')->with('error', 'User already has a membership.');
        }

        if (!$user->pembayaran()->exists()) {
            return redirect()->route('membership.showdata')->with('error', 'User has not made a payment.');
        }

        // Create a membership record
        Membership::create([
            'id_user' => $user->id,
            'status' => 'aktif',
            'tanggal_langganan' => now(),
        ]);

        // Copy payment data to transaction table

        Transaksi::create([
            'id_user' => $user->id,
            'nama_transaksi' => 'Membership Payment',
            'harga' => $pembayaran->harga, // Update the price accordingly
            'tanggal' => $pembayaran->created_at,
        ]);

        // Move payment data to transaksi table and delete the payment record




        // Delete the payment record
        $pembayaran->delete();



        return redirect()->route('membership.showdata')->with('success', 'Membership berhasil dibuat');


}

    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('page.admin.member.edit', compact('membership'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'status' => 'required|in:aktif,nonaktif', // Assuming the status can only be 'aktif' or 'nonaktif'
            ]);

            // Update the status
            $membership->status = $request->status;
            $membership->save();
            return redirect()->route('membership.index', ['id' => $membership->id])->with('success', 'Status berhasil diubah');
        }

        return view('page.admin.member.edit', [
            'membership' => $membership
        ]);
    }

    public function hapusMember($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        return redirect()->route('membership.index', ['id' => $membership->id])->with('success', 'Data berhasil dihapus');
    }
}
