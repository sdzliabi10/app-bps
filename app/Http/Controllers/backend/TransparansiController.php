<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transparansi;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transparansi::with(['desa.kecamatan']);

        // Filter by kecamatan if provided
        if ($request->has('kecamatan')) {
            $query->whereHas('desa', function($q) use ($request) {
                $q->where('kdkec', $request->kecamatan);
            });
        }

        // Filter by desa if provided
        if ($request->has('desa')) {
            $query->where('iddesa', $request->desa);
        }

        $transparansiList = $query->get();
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();

        return view('admin.transparansi.index', compact('transparansiList', 'kecamatanList', 'desaList'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.transparansi.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        try {
            // Validate request
            $rules = [
                'iddesa' => 'required|exists:desa,iddesa',
                'jenis' => 'required|in:peraturan,edaran,program',
                'file' => 'required|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
            ];

            // Add conditional validation rules
            if ($request->jenis === 'program') {
                $rules = array_merge($rules, [
                    'nama' => 'required|string',
                    'sumber' => 'required|in:pusat,provinsi,kabupaten',
                    'anggaran' => 'required|numeric|min:0',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'judul' => 'required|string',
                    'nomor' => 'required|string',
                    'tanggal' => 'required|date',
                ]);
            }

            $validatedData = $request->validate($rules);

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('transparansi-docs', $fileName, 'public');
                $validatedData['file'] = $filePath;
            }

            // Set null values based on jenis
            if ($request->jenis === 'program') {
                $validatedData['judul'] = null;
                $validatedData['nomor'] = null;
                $validatedData['tanggal'] = null;
            } else {
                $validatedData['nama'] = null;
                $validatedData['sumber'] = null;
                $validatedData['anggaran'] = null;
            }

            // Create record
            $transparansi = Transparansi::create($validatedData);

            // Redirect with success message
            return redirect()
                ->route('transparansi.index')
                ->with('success', 'Data transparansi berhasil ditambahkan');

        } catch (\Exception $e) {
            \Log::error('Error in TransparansiController@store: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $transparansi = Transparansi::findOrFail($id);
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.transparansi.edit', compact('transparansi', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'jenis' => 'required|in:peraturan,edaran,program',
            'judul' => 'required_if:jenis,peraturan,edaran',
            'nomor' => 'nullable|required_if:jenis,peraturan,edaran',
            'tanggal' => 'nullable|date|required_if:jenis,peraturan,edaran',
            'nama' => 'required_if:jenis,program',
            'sumber' => 'nullable|required_if:jenis,program|in:pusat,provinsi,kabupaten',
        ]);

        $transparansi = Transparansi::findOrFail($id);
        
        $data = $request->all();
        if ($request->jenis === 'program') {
            $data['judul'] = null;
            $data['nomor'] = null;
            $data['tanggal'] = null;
        } else {
            $data['nama'] = null;
            $data['sumber'] = null;
        }

        $transparansi->update($data);

        return redirect()->route('transparansi.index')
            ->with('success', 'Data transparansi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transparansi = Transparansi::findOrFail($id);
        $transparansi->delete();

        return redirect()->route('transparansi.index')
            ->with('success', 'Data transparansi berhasil dihapus');
    }
}




