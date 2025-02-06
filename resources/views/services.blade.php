<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
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

        .satuan-box {
        border: 1px solid #ced4da;
        padding: 10px;
        border-radius: 5px;
        background-color: #ffffff;
        min-height: 38px;
        display: flex;
        align-items: center;
    }

    .nama-layanan-box {
        border: 1px solid #ced4da;
        padding: 10px;
        border-radius: 5px;
        background-color: #ffffff;
        min-height: 38px;
        display: flex;
        align-items: center;
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
    <div class="satuan-box">
        <span id="satuan">Pilih Bandwidth Terlebih Dahulu</span>
    </div>
    </div>

    <div class="form-group">
    <label for="nama_layanan" class="form-label">Nama Layanan</label>
    <div class="nama-layanan-box">
        <span id="nama_layanan">Pilih Kategori dan Subkategori</span>
    </div>
    </div>

    <div class="form-group">
        <label for="harga" class="form-label">Harga</label>
        <div id="harga" class="result-box">Pilih kategori terlebih dahulu</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //Fungsi untuk menampilkan nama layanan/Kategori
     $(document).ready(function(){
        function NamaLayanan() {
            var kategori = $('#kategori option:selected').text();
            var subkategori = $('#subkategori option:selected').text();

            if (kategori && kategori !== "Pilih Kategori" && subkategori && subkategori !== "Pilih Subkategori") {
                $('#nama_layanan').text(kategori + " _ " + subkategori);
            } else {
                $('#nama_layanan').text("Pilih Kategori dan Subkategori");
            }
        }

        //Fungsi untuk menampilkan subkategori
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
                        console.log(data);
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
            NamaLayanan();
        });

        //Fungsi untuk menampilkan bandwidth
        $('#subkategori').on('change', function(){
            var id_subkategori = $(this).val();
            console.log(id_subkategori);
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
            NamaLayanan();
        });

        //Fungsi untuk menampilkan satuan dan harga
        $('#bandwidth').on('change', function(){
            var selectedBandwidth = $(this).val().trim();
            var selectedSubkategori = $('#subkategori').val();
            console.log(selectedBandwidth, selectedSubkategori);
            if (selectedBandwidth && selectedSubkategori) {
                $.ajax({
                    url: '/details/' + selectedBandwidth,
                    type: 'GET',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id_subkategori': selectedSubkategori
                    },
                    dataType: 'json',
                    success: function(data){
                        console.log(data);  
                        if (data && data.harga) {
                            $('#satuan').text(data.satuan.trim());
                            $('#harga').text('Harga: Rp' + parseInt(data.harga).toLocaleString('id-ID'));
                        } else {
                            $('#satuan').text("Pilih Bandwidth Terlebih Dahulu");
                            $('#harga').text('Harga: Pilih bandwidth terlebih dahulu');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error AJAX:", status, error);
                    }
                });
            } else {
                $('#satuan').text("Pilih Bandwidth Terlebih Dahulu");
                $('#harga').text('Harga: Pilih bandwidth terlebih dahulu');
            }
        });

    });

</script>

</body>
</html>