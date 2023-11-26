<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Membership;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\DataTables;

// use DataTables;


class MembershipController extends Controller
{
    public function showdata()
    {
        $usersWithPayments = User::has('pembayaran')->get();
        return view('page.admin.member.index', compact('usersWithPayments'));
    }

    public function daftar()
    {
        return view('page.user.membership.daftar');
    }

    public function getDataMember(Request $request)
    {

        if ($request->ajax()) {
            $members = Membership::select(['id_member', 'id_user', 'status', 'tanggal_langganan'])->get();
            \Log::info('testajg:', $members);
            dd('babikk', $members);

            return DataTables::of($members)
                ->addColumn('user_name', function ($member) {
                    return $member->user->name ?? ''; // Use null coalescing operator to handle cases where user is null
                })
                ->addColumn('action', function ($member) {
                    return '<a href="/membership/' . $member->id_member . '/edit" class="btn btn-primary">Edit</a>
                    <a href="/membership/' . $member->id_member . '" class="btn btn-danger">Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('page.admin.member.datamember');
    }

    public function store(Request $request)
    {
        // Validation rules
        $this->validate($request, [
            'id_user' => 'required|exists:users,id',
            'harga' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        // Find the existing user
        $user = User::findOrFail($request->id_user);

        // Perform the operation within a transaction
        DB::transaction(function () use ($user, $request) {
            // Check if the user already has a membership
            if ($user->membership) {
                return redirect()->route('membership.showdata')->with('error', 'User already has a membership.');
            }

            // Check if the user has made a payment
            if (!$user->pembayaran()->exists()) {
                return redirect()->route('membership.showdata')->with('error', 'User has not made a payment.');
            }

            // Get the latest payment record for the user
            $latestPayment = $user->pembayaran()->latest()->first();

            // Create a new membership for the user
            $membership = Membership::create([
                'id_user' => $user->id,
                'status' => 'aktif',
                'tanggal_langganan' => $latestPayment->tanggal,
            ]);
        });

        return redirect()->route('membership.showdata')->with('success', 'Membership berhasil dibuat');
    }


}