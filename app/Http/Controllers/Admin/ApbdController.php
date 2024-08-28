<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apbd;
use App\Http\Requests\StoreApbdRequest;
use App\Http\Requests\UpdateApbdRequest;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ApbdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $apbd = Apbd::query()->orderBy('created_at', 'desc');

                return DataTables::of($apbd)
                    ->addIndexColumn()
                    ->editColumn('type', function ($apbd) {
                        if ($apbd->type == 1) {
                            return '<span class="badge badge-success">' . ucfirst('Pelaksanaan') . '</span>';
                        } else if ($apbd->type == 2) {
                            return '<span class="badge badge-warning">' . ucfirst('Pendapatan') . '</span>';
                        } else if ($apbd->type == 3) {
                            return '<span class="badge badge-info">' . ucfirst('Pembelanjaan') . '</span>';
                        } else {
                            return '<span class="badge badge-danger">' . ucfirst('undefined') . '</span>';
                        }
                    })
                    ->editColumn('amount', function ($apbd) {
                        return 'Rp. ' . number_format($apbd->amount, 0, ',', '.');
                    })
                    ->addColumn('action', function ($apbd) {
                        return view('pages.admin.apbd.components.button', compact('apbd'))->render();
                    })
                    ->rawColumns(['type', 'amount', 'action'])
                    ->make(true);
            }

            return view('pages.admin.apbd.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('pages.admin.apbd.store');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'type' => 'required',
            ], [
                'required' => ':attribute harus diisi',
            ]);
            if (strpos($request->amount, 'Rp ') === 0) {
                $amount = str_replace(['Rp ', '.', ',', ',00'], '', $request->amount);
            }
            DB::beginTransaction();
            $village = GeneralInfo::first();

            $apbd = new Apbd();
            $apbd->village_id = $village->id;
            $apbd->description = $request->description;
            $apbd->amount = $amount;
            $apbd->date = $request->date;
            $apbd->type = $request->type;
            $apbd->save();

            DB::commit();
            return back()->with('success', 'Data Berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Apbd $apbd)
    {
        try {
            return view('pages.admin.apbd.show', compact('apbd'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apbd $apbd) {
        try {
            return view('pages.admin.apbd.edit', compact('apbd'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apbd $apbd)
    {
        try {
            // dd($request->all());
            $request->validate([
                'description' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'type' => 'required',
            ], [
                'required' => ':attribute harus diisi',
            ]);

            // if (strpos($request->amount, 'Rp ') === 0) {
                $amount = str_replace(['Rp ', '.', ',', ',00'], '', $request->amount);
            // }
            // dd($amount);
            DB::beginTransaction();
            $village = GeneralInfo::first();

            $apbd = Apbd::find($apbd->id);
            $apbd->village_id = $village->id;
            $apbd->description = $request->description;
            $apbd->amount = $amount;
            $apbd->date = $request->date;
            $apbd->type = $request->type;
            $apbd->save();

            DB::commit();
            return back()->with('success', 'Data Berhasil di update');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apbd $apbd)
    {
        try {
            DB::beginTransaction();
            $apbd->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'UMKM berhasil di hapus'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
