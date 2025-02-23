<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #faf9f6;
           
        }
        .custom-bg {
            background-color: #FAF9F6; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .info-bar {
            background-color: #333; /* Warna gelap */
            color: white; /* Warna teks */
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            
            /* Biar full width & nempel di bawah */
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            
            /* Bayangan atas biar terlihat terpisah dari konten */
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        }

        .info-bar a {
            color: #FFD700; /* Warna emas */
            text-decoration: none;
        }
        .info-bar a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body class="container mt-5">

    <h1 class="text-center mb-4">Daftar Karyawan</h1>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card p-3 mb-4 custom-bg">
        <h2>Tambah Karyawan</h2>
        <form action="{{ url('/employees') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Nama" required minlength="5" maxlength="20">
            </div>
            <div class="col-md-2">
                <input type="number" name="age" class="form-control" placeholder="Umur" required min="21">
            </div>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control" placeholder="Alamat" required minlength="10" maxlength="40">
            </div>
            <div class="col-md-3">
                <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required pattern="08[0-9]{7,10}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Tambah Karyawan</button>
            </div>
        </form>
    </div>



    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->phone }}</td>
                <td>

                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $employee->id }}">
                        Update
                    </button>


                    <div class="modal fade" id="editModal{{ $employee->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/employees/' . $employee->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required minlength="5" maxlength="20">
                                        </div>
                                        <div class="mb-3">
                                            <label>Umur</label>
                                            <input type="number" name="age" class="form-control" value="{{ $employee->age }}" required min="21">
                                        </div>
                                        <div class="mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="address" class="form-control" value="{{ $employee->address }}" required minlength="10" maxlength="40">
                                        </div>
                                        <div class="mb-3">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}" required pattern="08[0-9]{7,10}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form action="{{ url('/employees/' . $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <footer class="info-bar">
        <p>&copy; 2025 PT BananaCat | Contact: <a href="mailto:info@BananaCat.com">info@BananaCat.com</a></p>
        <p>Phone: 0812-3456-7890 | Address: Jl. Merdeka No.10, Jakarta Pusat</p>
        
    </footer>


</body>

</html>
