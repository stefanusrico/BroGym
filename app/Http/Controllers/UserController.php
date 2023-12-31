<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('page.user.home');
    }

    public function dashboard()
    {
        $user = auth()->user();

        return view('page.user.home', compact('user'));
    }

    public function profile()
    {
        return view('page.user.profile');
    }

    public function updateprofile(Request $request)
    {
        $usr = User::findOrFail(Auth::user()->id);
        if ($request->input('type') == 'change_profile') {
            $this->validate($request, [
                'name' => 'string|max:200|min:3',
                'email' => 'string|min:3|email',
                'user_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);
            $img_old = Auth::user()->user_image;
            if ($request->file('user_image')) {
                # delete old img
                if ($img_old && file_exists(public_path() . $img_old)) {
                    unlink(public_path() . $img_old);
                }
                $nama_gambar = time() . '_' . $request->file('user_image')->getClientOriginalName();
                $upload = $request->user_image->storeAs('public/admin/user_profile', $nama_gambar);
                $img_old = Storage::url($upload);
            }
            $usr->update([
                'name' => $request->name,
                'email' => $request->email,
                'user_image' => $img_old
            ]);
            return redirect()->route('profile')->with('status', 'Perubahan telah tersimpan');
        } elseif ($request->input('type') == 'change_password') {
            $this->validate($request, [
                'password' => 'min:8|confirmed|required',
                'password_confirmation' => 'min:8|required',
            ]);
            $usr->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('profile')->with('status', 'Perubahan telah tersimpan');
        }
    }

    public function berlangganan(Request $request)
    {
        $user = auth()->user();

        // Validasi input form, sesuaikan dengan kebutuhan Anda
        $request->validate([
            'membership_id' => 'required|numeric',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png',
        ]);

        // Tentukan harga berlangganan (gantilah dengan logika atau nilai yang sesuai)
        $hargaLangganan = 100000; // Ganti dengan nilai atau logika yang sesuai
        $file = $request->file('bukti_pembayaran');
        $fileName = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Simpan file ke direktori yang diinginkan dengan menggunakan storeAs
        $file->storeAs('public/pembayaran/bukti_pembayaran', $fileName);

        // Simpan nama file ke dalam database

        // Simpan data pembayaran ke tabel pembayaran
        $pembayaran = $user->pembayaran()->create([
            'harga' => $hargaLangganan,
            'tanggal' => now(),
            'bukti' => $fileName,
        ]);

        // Handle file bukti pembayaran

        // Tambahkan logika lainnya, seperti memberikan notifikasi atau mengarahkan ke halaman tertentu

        return redirect()->route('home')->with('status', 'Berlangganan berhasil');
    }


}