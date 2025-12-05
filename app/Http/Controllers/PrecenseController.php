<?php

namespace App\Http\Controllers;

use App\Models\Precense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrecenseExport;

class PrecenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $precenses = Precense::latest()->get();
        return view('admin.precenses.index', compact('precenses'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required',
            'reason' => 'nullable|string',
        ]);

        Precense::create([
            'name' => Auth::user()->name,
            'nik' => Auth::user()->nik,
            'position' => Auth::user()->position,
            'date' => $request->date,
            'status' => $request->status,
            'reason' => $request->reason
        ]);

        return back()->with('success', 'Absensi berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Precense $precense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Precense $precense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Precense $precense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Precense $precense)
    {
        //
    }


    public function exportExcel()
    {
        $fileName = 'absensi.xlsx';
        return Excel::download(new PrecenseExport, $fileName);
    }

    public function chartData()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $hadir = Precense::where('status', 'hadir')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        $sakit = Precense::where('status', 'sakit')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        $izin = Precense::where('status', 'izin')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        return response()->json([
            'data' => [$hadir, $sakit, $izin]
        ]);
    }

}
