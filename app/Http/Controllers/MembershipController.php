<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Membership;
// use Yajra\DataTables\Facades\DataTables;
use DataTables;


class MembershipController extends Controller
{
    public function index()
    {
        return view('page.admin.member.datamember');
    }
    public function showdata()
    {
        $usersWithPayments = User::has('pembayaran')->get();
        $filteredUsers = $usersWithPayments->filter(function ($user) {
            return !$user->membership;
        });
        return view('page.admin.member.index', compact('filteredUsers'));
    }

    public function daftar()
    {
        return view('page.user.membership.daftar');
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
            'harga' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $user = User::findOrFail($request->id_user);

        // Perform the operation within a transaction
        DB::transaction(function () use ($user, $request) {
            if ($user->membership) {
                return redirect()->route('membership.showdata')->with('error', 'User already has a membership.');
            }

            if (!$user->pembayaran()->exists()) {
                return redirect()->route('membership.showdata')->with('error', 'User has not made a payment.');
            }

            $latestPayment = $user->pembayaran()->latest()->first();

            $membership = Membership::create([
                'id_user' => $user->id,
                'status' => 'aktif',
                'tanggal_langganan' => $latestPayment->tanggal,
            ]);
        });

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