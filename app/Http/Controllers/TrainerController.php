<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Trainer;
class TrainerController extends Controller
{

    public function index()
    {
        return view('page.admin.trainer.index');
    }




    public function getDataTrainer(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $members = Trainer::select(['id', 'nama_trainer', 'gaji', 'email'])->get();

            return DataTables::of($members)

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


}
