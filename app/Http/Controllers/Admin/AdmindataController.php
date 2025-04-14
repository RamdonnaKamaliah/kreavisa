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
             'nama_lengkap' => 'required|string|max:100',
             'name' => 'required|string|max:100|unique:users,name',
             'usia' => 'required|integer|min:0',
             'gender' => 'required|in:Laki-laki,Perempuan',
             'tanggal_lahir' => 'required|date',
             'no_telepon' => 'required|string|unique:users,no_telepon',
             'email' => 'required|email|unique:users,email',
             'jabatan_id' => 'required|exists:jabatan_karyawans,id',
             'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
         ]);
     
         // Cek apakah user sudah ada berdasarkan email atau username
         $existingUser = User::where('email', $request->email)
                             ->orWhere('name', $request->name)
                             ->exists();
         
         if ($existingUser) {
             return redirect()->route('datakaryawan.create')
                 ->with('error', 'Data sudah ada! Silakan cek kembali.')
                 ->withInput();
         }
     
         // Generate password random
         $randomPassword = Str::random(8);
     
         $data = $request->except('password', 'foto');
         $data['password'] = Hash::make($randomPassword);
     
         // Tentukan usertype berdasarkan jabatan
         $jabatan = JabatanKaryawan::find($request->jabatan_id);
         // Pada method store
        $data['usertype'] = 'karyawan'; // Selalu set sebagai karyawan
     
         // Simpan foto jika ada
         if ($request->hasFile('foto')) {
             $file = $request->file('foto');
             $destinationPath = 'uploads/datakaryawan';
             $fileName = time() . '_' . $file->getClientOriginalName();
             $file->move(public_path($destinationPath), $fileName);
             $data['foto'] = $destinationPath . '/' . $fileName;
         }
     
         // Simpan data karyawan
         $user = User::create($data);
     
         // Kirim email dengan password yang dihasilkan
         try {
             Mail::to($request->email)->send(new SendPasswordEmail($randomPassword));
         } catch (\Exception $e) {
             return redirect()->route('datakaryawan.index')
                 ->with('success', 'Data berhasil ditambahkan, tetapi email gagal dikirim.');
         }
     
         return redirect()->route('datakaryawan.index')->with('added', true);
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

    // Ambil data jabatan berdasarkan ID
    $jabatan = JabatanKaryawan::findOrFail($request->jabatan_id);
    
    $usertype = 'karyawan'; // Selalu set sebagai karyawan

    // Update jabatan dan usertype di database
    $karyawan->update([
        'jabatan_id' => $request->jabatan_id,
        'usertype' => $usertype,
    ]);


    return redirect()->route('datakaryawan.index')->with('edited', true);
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
        

        return redirect()->route('datakaryawan.index')->with('deleted', true);
    }
}



