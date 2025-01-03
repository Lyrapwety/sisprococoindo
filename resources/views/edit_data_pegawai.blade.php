@extends('layouts.app')

@section('content')
    <style>
        .mainbar {
            flex: 1%;
            background-color: #D9D9D9 !important;
            padding-top: 20px;
            margin-left: 235px;
            height: 100vh;
            width: calc(100% - 235px);
            font-family: 'Inter', sans-serif;
        }

        .container {
            padding: 20px;
            background-color: #F7F7F7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 94%;
            height: 85%;
            margin-left: 40px;
            font-family: 'Inter', sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;

        }

        .header h2 {
            font-size: 16px;
            margin: 0;
            color: #636362;
            display: flex;
            justify-content: center;
            text-align: center;
            transform: translateX(375px);
        }

        .profile-pic img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .form-container {
            background-color: #F7F7F7;
            padding: 20px;
            border-radius: 10px;
            height: 85%;
            margin: 0 auto;
        }

        .form-main {
            display: flex;
            gap: 20px;
        }

        .form-inputs {
            flex: 2;

        }

        .profile-picture {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #profile-image {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ccc;
            transform: translateY(-20px);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
        }

        .form-group label {
            font-size: 12px;
            margin-bottom: 8px;
            color: #636362;
            font-weight: 500;
        }

        .form-group input {
            width: :75%;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #636362;
            font-weight: 400;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .form-group select {
        width: 100%; 
        height: 80%;
        padding: 8px; 
        font-size: 12px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        background-color: #f9f9f9; 
        color: #636362; 
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2); 
        appearance: none; 
        -webkit-appearance: none; 
        -moz-appearance: none; 
}
        .btn-update {
            display: flex;
            width: 20%;
            padding: 8px;
            margin-top: 5px;
            background-color: #0e4375;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 50px;
            text-align: center;
            justify-content: center;
            align-content: center;
            margin: 0 auto;
        }

        .btn-update:hover {
            background-color: #063361;
        }

        .btn-update-foto {
            padding: 8px;
            width: 100px;
            background-color: #0e4375;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-align: center;
        }

        .btn-update-foto:hover {
            background-color: #063361;
        }
    </style>

    <div class="mainbar">
        <div class="container">
            <div class="header">
                <h2>Form Edit Data Pegawai</h2>
            </div>

            <div class="form-container">
                <form action="{{ route('data_pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-main">
                        <div class="form-inputs">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="tgl-join">Tgl Join</label>
                                    <input type="date" name="tgl_join" id="tgl-join" value="{{ old('tgl_join', $pegawai->tgl_join) }}">
                                </div>
                                <div class="form-group">
                                    <label for="tgl-out">Tgl Out</label>
                                    <input type="date" name="tgl_out" id="tgl-out" value="{{ old('tgl_out', $pegawai->tgl_out) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="nama" id="name" value="{{ old('nama', $pegawai->nama) }}">
                                </div>
                                <div class="form-group">
                                    <label for="id">ID Pegawai</label>
                                    <input type="text" name="id_pegawai" id="id" value="{{ old('id_pegawai', $pegawai->id_pegawai) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="position">Posisi</label>
                                    <input type="text" name="posisi" id="position" value="{{ old('posisi', $pegawai->posisi) }}">
                                </div>
                                <div class="form-group">
                                    <label for="department">Departemen</label>
                                    <input type="text" name="departemen" id="department" value="{{ old('departemen', $pegawai->departemen) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status-kepegawaian">Status Kepegawaian</label>
                                    <input type="text" name="kepagawaian" id="status-kepegawaian" value="{{ old('kepagawaian', $pegawai->kepagawaian) }}">
                                </div>
                                
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control" id="status" name="status" value="{{ old('status', $pegawai->status) }}">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                            </div>

                            <button type="submit" class="btn-update">Update</button>
                        </div>
                      
                        </form>
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 50px;">
                            @if($pegawai->foto)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" id="profile-image" 
                                         style="width: 150px; height: auto; border-radius: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                </div>
                            @endif
                        
                            <form method="POST" action="{{ route('data_pegawai.update', $pegawai->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  
                                    <input type="file" name="foto" class="form-control" id="foto" accept="image/*" style="display: none;">
                                </div>
                                </form>
                        </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        </main>



    </div>
@endsection

@section('scripts')
    <script>
      
      document.addEventListener('DOMContentLoaded', function() {
    
        var changeProfileBtn = document.getElementById('change-profile-btn');
        var profileInput = document.getElementById('foto');
        var profileImage = document.getElementById('profile-image');

        changeProfileBtn.addEventListener('click', function() {
            profileInput.click(); 
        });

        profileInput.addEventListener('change', function() {
            var file = profileInput.files[0]; 
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result; 
                };
                reader.readAsDataURL(file); 
            }
        });
    });
    </script>
