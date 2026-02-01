<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home = Home::all(); // Mengambil semua data proyek
        return view('admin.home.index', compact('home')); // Kirim data ke view admin.home.index
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string',
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar
        ]);

         // Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = 'uploads/home'; // Folder uploads di public
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
        
            $imagePath = $destinationPath.'/'.$fileName;
        }

        Home::create([
            'posisi' => $request->posisi,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'foto' => $imagePath,
        ]);


        return redirect()->route('home.index')->with(key:'added', value:'true');
    }

    /**     
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $home = Home::findOrFail($id); // Ambil data berdasarkan ID
        return view('admin.home.show', compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $home = Home::findOrFail($id); // Ambil data berdasarkan ID
        return view('admin.home.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'posisi' => 'required|string',
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar 
        ]);
    
        $home = Home::findOrFail($id);
    
        // Upload gambar baru jika ada, dan hapus gambar lama
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = 'uploads/home'; // Folder uploads di public
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
        
            $imagePath = $destinationPath.'/'.$fileName;
            
            if ($home->foto) {
                if (file_exists('uploads/home/'.$home->foto)) {
                    unlink('uploads/home/'.$home->foto);
                }
            }
        } else {
            $imagePath = $home->foto;
        }
        
        
    
        // Update data lainnya
        $home->update([
            'posisi' => $request->posisi,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'foto' =>  $imagePath, // Pastikan tetap mengacu ke 'foto'
        ]);
    
        return redirect()->route('home.index')->with(key:'edited', value:'true');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}