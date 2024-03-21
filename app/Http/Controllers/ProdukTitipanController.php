<?php

namespace App\Http\Controllers;

use App\Models\ProdukTitipan;
use App\Http\Requests\StoreProdukTitipanRequest;
use App\Http\Requests\UpdateProdukTitipanRequest;
use Barryvdh\DomPDF\PDF;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaketExport;
use App\Exports\ProdukTitipanExport;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use PDOException;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['produktitipan'] =  ProdukTitipan::orderBy('created_at','ASC')->get();

        return view('produktitipan.index')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukTitipanRequest $request)
    {
        try{
            DB::beginTransaction();
            ProdukTitipan::create($request->all());
            DB::commit();
            return redirect('produktitipan')->with('success','Data berasil ditambahkan');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukTitipanRequest $request, ProdukTitipan $produktitipan)
    {
        $produktitipan->update($request->all());
        return redirect('produktitipan')->with('success',' Update Data berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukTitipan $produktitipan)
    {
        $produktitipan->delete();
        return redirect('/produktitipan')->with('success','Data berhasil dihapus!');
    }
    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new ProdukTitipanExport, $date. '_ProdukTitipan.xlsx');
    }

}