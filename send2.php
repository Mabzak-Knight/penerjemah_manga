<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengiriman Data</title>
</head>
<body>
    <form id="my-form" enctype="multipart/form-data">
        <input type="file" name="data" accept="image/*"> <!-- Input untuk memilih file gambar -->
        <button type="submit">Kirim Data</button> <!-- Menggunakan type "submit" untuk tombol formulir -->
    </form>

    <div id="result-container"></div> <!-- Wadah untuk menampilkan hasil dari server -->

    <script>
        document.getElementById('my-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir dikirimkan secara default
            sendData();
        });

        function sendData() {
            const formData = new FormData(document.getElementById('my-form'));
            fetch('https://eb8a-35-204-189-59.ngrok-free.app/process_data', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);  // Hasil dari Colab
                document.getElementById('result-container').innerText = data;  // Menampilkan hasil dari Colab
            });
        }
    </script>
</body>
</html>