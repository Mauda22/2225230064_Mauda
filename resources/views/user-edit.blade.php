@extends('layouts.mainlayouts')
@section('content')
<div class="container-fluid mt-5">

    <div class="row">

        <div class="col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Gunakan method PUT untuk operasi update --}}
                    
                        <div class="form-group">
                            <label for="name">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" value="{{ old('name', $user->name) }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <input type="number" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $user->nim) }}" required>
                            @error('nim')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat', $user->alamat) }}" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger mt-3">Batal</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection