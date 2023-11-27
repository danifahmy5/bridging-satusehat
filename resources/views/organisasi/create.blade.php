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
                            <h3 class="card-title">Tambah Organisasi</h3>
                            <a class="btn btn-success" href="{{ route('organisasi.generateToken') }}">Generate Token</a>
                            {{ Session::has('bearer') ? Session::get('bearer') : '' }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('organisasi.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $pathOf }}" name="pathOf"> 
                                <div class="form-group">
                                    <label for="identifier">Identifier USE</label>
                                    <input type="text" value="official" class="form-control" id="identifier"
                                        name="identifier" required>

                                </div>
                                @if ($pathOf)
                                <div class="form-group"> 
                                    <label for="identifier">Path OF</label>
                                    <input type="text" value="{{ $pathOf }}" disabled class="form-control"> 
                                </div>
                                    
                                @endif
                                <div class="form-group">
                                    <label for="value_identifier">Value Identifier</label>
                                    <input type="text" class="form-control"
                                        placeholder="Berisi kode atau nomor internal sub organisasi."
                                        id="value_identifier" name="value_identifier" required>
                                </div>
                                <div class="form-group">
                                    <label for="ihs">IHS</label>
                                    <input type="text" class="form-control" value="100027612" id="ihs"
                                        name="ihs" required>
                                </div>
                                <div class="form-group">
                                    <label for="typecode">Type Code</label>
                                    <select class="form-control" id="typecode" name="typecode" required>
                                        @foreach ($typeCode as $itemTypeCode)
                                            <option @selected($loop->index == 1) value="{{ $itemTypeCode->code }}">{{ $itemTypeCode->display }} |
                                                {{ $itemTypeCode->definition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="typedisplay">Type Display</label>
                                    <input type="text" class="form-control" value="Departemen Rumah Sakit "  id="typedisplay" name="typedisplay" required>
                                    
                                </div> 

                                <div class="form-group">
                                    <label for="address_type">Address Type</label>
                                    <select  class="form-control" id="address_type" name="address_type"
                                        required> 
                                            @foreach ($addressType as $itemAddressType)
                                            <option @selected($loop->index == 1) value="{{ $itemAddressType->code }}">
                                                {{ $itemAddressType->display }} | {{ $itemAddressType->definition }}
                                            </option> 
                                            @endforeach
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="address_use">Address Use</label> 
                                        <select  class="form-control" id="address_use" name="address_use"
                                        required> 
                                            @foreach ($addressUse as $itemAddressUse)
                                            <option @selected($loop->index == 1) value="{{ $itemAddressUse->code }}">
                                                {{ $itemAddressUse->display }} | {{ $itemAddressUse->definition }}
                                            </option> 
                                            @endforeach
                                    </select> 
                                </div>
                                <div class="form-group">
                                    <label for="address_text">Address Text</label>
                                    <input type="text" value="Jl. Hasyim Asyari No.17, Kauman, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62113" class="form-control" id="address_text" name="address_text"
                                        required>
                                </div> 
                                <div class="form-group">
                                    <label for="address_line">Address Line</label>
                                    <input type="text" value="Jl. Hasyim Asyari No.17" class="form-control" id="address_line" name="address_line"
                                        required>
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
