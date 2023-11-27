<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Organisasi</title>
</head>
<body>

    <div >
        <div class="row">
            <div class="col-md-10 offset-md-1">
            <x-nav></x-nav> 
            <h2 class="mb-4">Daftar location</h2>
            <a class="btn btn-primary my-2" href="{{ route('location.create') }}">Tambah location</a>
            @if(count($location) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Action</th> 
                            <th>ID</th>
                            <th>PathOF</th>
                            <th>Name</th>
                            <th>Identifier</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($location as $item)
                            <tr>
                                 <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('location.create') . "?locationOf=$item->id"  }}">Sub location</a>    
                                </td> 
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->partOf }}</td>
                                <td>{{ $item->identifier }}</td>
                                <td>{{ $item->identifier_value }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td> 
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada data location.</p>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
