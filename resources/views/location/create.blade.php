<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Form Organisasi</title>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Lokasi</h3>
                            <a class="btn btn-success" href="{{ route('location.generateToken') }}">Generate Token</a>
                            {{ Session::has('bearer') ? Session::get('bearer') : '' }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('location.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $locationOf }}" name="locationOf"> 
                                
                                @if ($locationOf)
                                <div class="form-group"> 
                                    <label for="identifier">Path OF</label>
                                    <input type="text" value="{{ $locationOf }}" disabled class="form-control"> 
                                </div>
                                    
                                @endif
                                <div class="form-group">
                                    <label for="identifier_value">Identifier Value</label>
                                    <input type="text" class="form-control" placeholder="singkatan dari lokasi" id="identifier_value"
                                        name="identifier_value" required>

                                </div>
                                <div class="form-group">
                                    <label for="name">name </label>
                                    <input type="text" placeholder="Nama Lokasi" class="form-control" id="name"
                                        name="name" required>

                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <input type="text" class="form-control"
                                        placeholder="deskripsi terkait lokasinya."
                                        id="description" name="description" required>
                                </div> 
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    </body>

</html>
