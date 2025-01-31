<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Layanan</title>
    <!-- Menambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menambahkan FontAwesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }

        .dropdown-container {
            margin-bottom: 20px;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        #price {
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <form>
            <!-- Dropdown Kategori -->
            <div class="dropdown-container">
                <label for="category" class="form-label">Kategori</label>
                <select id="category" name="category" class="form-select">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_kategori }}">{{ $category->kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Subkategori -->
            <div class="dropdown-container">
                <label for="subcategory" class="form-label">Subkategori</label>
                <select id="subcategory" name="subcategory" class="form-select" disabled>
                    <option value="">Pilih Subkategori</option>
                </select>
            </div>

            <!-- Dropdown Bandwidth -->
            <div class="dropdown-container">
                <label for="bandwidth" class="form-label">Bandwidth</label>
                <select id="bandwidth" name="bandwidth" class="form-select" disabled>
                    <option value="">Pilih Bandwidth</option>
                </select>
            </div>

            <!-- Harga -->
            <div id="price">
                <span>Harga: </span><strong id="price-value">-</strong>
            </div>
        </form>
    </div>

    <!-- Menambahkan jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
       $(document).ready(function() {
            // Ketika kategori dipilih
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.get('/subcategories/' + categoryId, function(data) {
                        $('#subcategory').prop('disabled', false).empty();
                        $('#subcategory').append('<option value="">Pilih Subkategori</option>');
                        $.each(data, function(key, subcategory) {
                            $('#subcategory').append('<option value="'+subcategory.id_subkategori+'">'+subcategory.subkategori+'</option>');
                        });
                    });
                } else {
                    $('#subcategory').prop('disabled', true).empty();
                    $('#bandwidth').prop('disabled', true).empty();
                    $('#price-value').text('-');
                }
            });

            // Ketika subkategori dipilih
            $('#subcategory').on('change', function() {
                var subcategoryId = $(this).val();
                if (subcategoryId) {
                    $.get('/bandwidth/' + subcategoryId, function(data) {
                        $('#bandwidth').prop('disabled', false).empty();
                        $('#bandwidth').append('<option value="">Pilih Bandwidth</option>');
                        $.each(data, function(key, bandwidth) {
                            $('#bandwidth').append('<option value="'+bandwidth.id_layanan+'">'+bandwidth.bandwidth+'</option>');
                        });
                    });
                } else {
                    $('#bandwidth').prop('disabled', true).empty();
                    $('#price-value').text('-');
                }
            });

            // Ketika bandwidth dipilih
            $('#bandwidth').on('change', function() {
                var bandwidthId = $(this).val();
                if (bandwidthId) {
                    $.get('/harga/' + bandwidthId, function(data) {
                        if (data.harga) {
                            $('#price-value').text(data.harga);
                        } else {
                            $('#price-value').text('Harga tidak ditemukan');
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>
