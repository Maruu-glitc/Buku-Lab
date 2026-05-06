<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Http\Requests\StoreLabRequest;
use App\Http\Requests\UpdateLabRequest;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $labs = Lab::all();

        $labs = Lab::withCount([
            'penggunaanLabs as aktif_count' => function ($query) {
                $query->whereNull('jam_keluar');
            }
        ])->get();

        return view('admin.lab.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $labs = Lab::all();
        return view('admin.lab.create', compact('labs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabRequest $request)
    {
        //
        Lab::create($request->validated());
        return redirect()->route('lab.index')->with('success', 'Lab berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        $pengunjung = $lab->penggunaanLabs()
            ->with(['pengunjung', 'keperluan'])
            ->latest()
            ->get();

        $labs = Lab::all();

        return view('admin.lab.show', [
            'lab' => $lab,
            'pengunjung' => $pengunjung,
            'labs' => $labs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabRequest $request, Lab $lab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        //
        $lab = Lab::findOrFail($lab->id);
        $lab->delete();
        return redirect()->route('lab.index')->with('deleted', 'Data Lab berhasil dihapus.');
    }
}
