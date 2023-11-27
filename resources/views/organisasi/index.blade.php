<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Daftar Organisasi</title>
    </head>

    <body>

        <div class="">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <x-nav></x-nav>
                    <h2 class="mb-4">Daftar Organisasi</h2>
                    <a class="btn btn-primary my-2" href="{{ route('organisasi.create') }}">Tambah Organisasi</a>
                    @if (count($organisasi['entry']) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Path OF</th>
                                    <th>Name</th>
                                    <th>Value Identifier</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($organisasi['entry'] as $itemorganisasi)

                                    @php
                                        $item = $itemorganisasi['resource']; 
                                    @endphp  
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('organisasi.create') . "?pathOf=" . $item['id'] }}">Sub
                                                    Organisasi</a>
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('location.create') . "?organitationId=" . $item['id'] . "?locationId=" . $item['id'] }}">Sub
                                                    Location</a>

                                            </div>
                                        </td> 
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['partOf']['reference'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['identifier'][0]['value'] }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada data organisasi.</p>
                    @endif
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    </body>

</html>
