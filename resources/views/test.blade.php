<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select2 Example</title>

    <!-- Tautan Gaya -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Skrip Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>

<body>

    <select id="basic-usage" name="unit_id" class="form-control" data-placeholder="Pilih Unit ID">
        <option></option>
        <!-- Tambahkan opsi sesuai kebutuhan -->
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
    </select>

    <!-- Skrip Anda atau skrip lainnya -->
    <script>
        $(document).ready(function() {
            $('#basic-usage').select2({
                theme: "bootstrap4",
                width: '100%',
                placeholder: "Pilih satu opsi",
            });
        });
    </script>

</body>

</html>
