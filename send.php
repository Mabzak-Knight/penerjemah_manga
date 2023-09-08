<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengiriman Data</title>
</head>
<body>
    <form id="my-form">
        <input required type="text" name="data" placeholder="Data 1">
        <button type="submit">Kirim Data</button> <!-- Menggunakan type "submit" untuk tombol formulir -->
    </form>

    <script>
        document.getElementById('my-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir dikirimkan secara default
            sendData();
        });

        function sendData() {
            const formData = new FormData(document.getElementById('my-form'));
            fetch('https://f7d9-35-204-189-59.ngrok-free.app/process_data', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);  // Hasil dari Colab
            });
        }
    </script>
</body>
</html>