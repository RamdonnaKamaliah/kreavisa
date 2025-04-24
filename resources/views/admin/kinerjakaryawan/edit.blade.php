@extends('layout.main')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Kinerja Karyawan</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('kinerja-karyawan.update', $kinerjaKaryawan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row p-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id" class="form-control-label">Nama Karyawan</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $kinerjaKaryawan->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->nama_lengkap }} - {{ $user->jabatan->nama_jabatan ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_penilaian" class="form-control-label">Tanggal Penilaian</label>
                                    <input type="date" name="tanggal_penilaian" id="tanggal_penilaian" class="form-control" value="{{ $kinerjaKaryawan->tanggal_penilaian->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="periode" class="form-control-label">Periode</label>
                                    <input type="text" name="periode" id="periode" class="form-control" value="{{ $kinerjaKaryawan->periode }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row px-4">
                            <div class="col-12">
                                <h6>Aspek Penilaian</h6>
                                <p>Berikan nilai 1-5 untuk setiap aspek (1 = Sangat Kurang, 5 = Sangat Baik)</p>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="disiplin" class="form-control-label">1. Disiplin</label>
                                    <select name="disiplin" id="disiplin" class="form-control" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $kinerjaKaryawan->disiplin == $i ? 'selected' : '' }}>
                                                {{ $i }} ({{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted">Kepatuhan terhadap waktu yang sudah ditentukan</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sikap_kerja" class="form-control-label">2. Sikap Kerja</label>
                                    <select name="sikap_kerja" id="sikap_kerja" class="form-control" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $kinerjaKaryawan->sikap_kerja == $i ? 'selected' : '' }}>
                                                {{ $i }} ({{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted">Kemampuan bekerja sama dengan tim</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kualitas_kerja" class="form-control-label">3. Kualitas Kerja</label>
                                    <select name="kualitas_kerja" id="kualitas_kerja" class="form-control" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $kinerjaKaryawan->kualitas_kerja == $i ? 'selected' : '' }}>
                                                {{ $i }} ({{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted">Kualitas hasil pekerjaan</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kecepatan_kerja" class="form-control-label">4. Kecepatan Kerja</label>
                                    <select name="kecepatan_kerja" id="kecepatan_kerja" class="form-control" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $kinerjaKaryawan->kecepatan_kerja == $i ? 'selected' : '' }}>
                                                {{ $i }} ({{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted">Kecepatan menyelesaikan tugas</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pengetahuan" class="form-control-label">5. Pengetahuan</label>
                                    <select name="pengetahuan" id="pengetahuan" class="form-control" required>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $kinerjaKaryawan->pengetahuan == $i ? 'selected' : '' }}>
                                                {{ $i }} ({{ $i == 1 ? 'Sangat Kurang' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Baik' : 'Sangat Baik'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <small class="text-muted">Pengetahuan tentang pekerjaan</small>
                                </div>
                            </div>
                        </div>

                        <div class="row p-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('kinerja-karyawan.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection