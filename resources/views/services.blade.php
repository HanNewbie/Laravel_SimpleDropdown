<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .result-box {
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            background-color: #e9ecef;
        }
        select[readonly] {
            pointer-events: none;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pilih Layanan</h2>

    <div class="form-group">
        <label for="kategori" class="form-label">Kategori</label>
        <select id="kategori" class="form-select">
            <option value="">Pilih Kategori</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id_kategori }}">{{ $kat->kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="subkategori" class="form-label">Subkategori</label>
        <select id="subkategori" class="form-select">
            <option value="">Pilih Subkategori</option>
        </select>
    </div>

    <div class="form-group">
        <label for="bandwidth" class="form-label">Bandwidth</label>
        <select id="bandwidth" class="form-select">
            <option value="">Pilih Bandwidth</option>
        </select>
    </div>

    <div class="form-group">
        <label for="satuan" class="form-label">Satuan</label>
        <div id="satuan" class="form-control-plaintext">Pilih Bandwidth Terlebih Dahulu</div>
    </div>

    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <div id="harga" class="result-box">Pilih kategori terlebih dahulu</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        $('#kategori').on('change', function(){
            var id_kategori = $(this).val();
            if(id_kategori){
                $.ajax({
                    url: '/services/' + id_kategori,
                    type: 'GET',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success:function(data){
                        if(data){
                            $('#subkategori').empty();
                            $('#subkategori').append('<option value="">Pilih Subkategori</option>');
                            $.each(data, function(key, value){
                                $('#subkategori').append('<option value="'+ value.id_subkategori +'">'+ value.subkategori +'</option>');
                            });
                        } else {
                            $('#subkategori').empty();
                        }
                    }
                });
            } else {
                $('#subkategori').empty();
            }
        });

        $('#subkategori').on('change', function(){
            var id_subkategori = $(this).val();
            if(id_subkategori){
                $.ajax({
                    url: '/bandwidth/' + id_subkategori,
                    type: 'GET',
                    data: {
                        '_token': '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        if(data){
                            $('#bandwidth').empty();
                            $('#bandwidth').append('<option value="">Pilih Bandwidth</option>');
                            $.each(data, function(key, value){
                                $('#bandwidth').append('<option value="'+ value.bandwidth +'">'+ value.bandwidth +'</option>');
                            });
                        } else {
                            $('#bandwidth').empty();
                        }
                    }
                });
            } else {
                $('#bandwidth').empty();
            }
        });

        $('#bandwidth').on('change', function(){
        var details = $(this).val(); 
        console.log('bandwidth yang dipilih',details); 
        if(details){
            $.ajax({
                url: '/details/' + details,
                type: 'GET',
                data: {
                    '_token': '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    if(data){
                        $('#satuan').empty(); 
                        $('#satuan').text(data.satuan);
                        $('#harga').text('Harga: Rp.' + data.harga);
                    } else {
                        $('#satuan').empty(); 
                        $('#harga').text('Harga: Pilih bandwidth terlebih dahulu');
                    }
                },
            });
        } else {
            $('#satuan').empty(); 
            $('#harga').text('Harga: Pilih bandwidth terlebih dahulu');
        }
    });

    });

</script>

</body>
</html>