<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JabatanKaryawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // Add this line
use App\Mail\SendPasswordEmail; // Add this line
use Illuminate\Support\Str;


class AdmindataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKaryawan = User::with('jabatan')->where('usertype', '!=', 'admin')->get();
        return view('admin.datakaryawan.index', compact('dataKaryawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatanKaryawan = JabatanKaryawan::all();
        return view('admin.datakaryawan.create', compact('jabatanKaryawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
 

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'usia' => 'required|integer|min:18|max:65',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'tanggal_lahir' => 'required|date',
        'no_telepon' => 'required|string|unique:users,no_telepon',
        'email' => 'required|email|unique:users,email',
        'jabatan_id' => 'required|exists:jabatan_karyawans,id',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Generate password random
    $randomPassword = Str::random(8);
    
    $data = $request->except('password', 'foto');
    $data['password'] = Hash::make($randomPassword);

    $jabatan = JabatanKaryawan::find($request->jabatan_id);
    $data['usertype'] = ($jabatan && strtolower($jabatan->nama_jabatan) === 'gudang') ? 'gudang' : 'karyawan';

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $destinationPath = 'uploads/datakaryawan';
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($destinationPath), $fileName);
        $data['foto'] = $destinationPath . '/' . $fileName;
    }

    // Simpan data karyawan
    User::create($data);

    // Kirim email dengan password yang dihasilkan
    Mail::to($request->email)->send(new SendPasswordEmail($randomPassword));

    return redirect()->route('datakaryawan.index')->with('added', 'true');
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = User::findOrFail($id);
        $jabatanKaryawan = JabatanKaryawan::all();
        return view('admin.datakaryawan.edit', compact('karyawan', 'jabatanKaryawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karyawan = User::findOrFail($id);
    
        $request->validate([
            'jabatan_id' => 'required|exists:jabatan_karyawans,id',
        ]);
    
        // Hanya memperbarui jabatan
        $karyawan->update([
            'jabatan_id' => $request->jabatan_id,
        ]);
    
        return redirect()->route('datakaryawan.index')->with('edited', 'true');
    }
    

public function show($id)
{
    $datakaryawan = User::with('jabatan')->findOrFail($id);
    return view('admin.datakaryawan.show', compact('datakaryawan'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = User::findOrFail($id);
        $karyawan->delete();
        
        return redirect()->route('datakaryawan.index')->with('deleted', 'true');
    }
}



