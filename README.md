# Penerjemah Manga Berbasis Website
Aplikasi Penerjemah Manga ini pada Versi 1.1 pengguna dapat menerjemahkan ballon text dengan cara menseleksinya lalu memotongnya, hasil potongan akan diolah dengan manga-ocr dan terjemahan google, lalu di tampilkan pada hasil di website seperti di gambar

![image](https://github.com/Mabzak-Knight/penerjemah_manga/assets/56875726/9754e15c-b1c9-4ddc-9014-59ce17e6901a)

Versi 1.2 saat ini sudah bisa menerjemahkan satu halaman, untuk memakai ini tercatat bahwa RAM di atas 5GB tepakai di google colab dan harus menggunakan GPU Cuda. kali ini saya menggunakan fitur langsung dari Manga-image-translator yang dapat menerjemahkan satu folder sekaligus, tetapi untuk awal saya hanya membuat fitur satu halaman.
![image](https://github.com/Mabzak-Knight/penerjemah_manga/assets/56875726/f6ab1dce-f131-45eb-b9e6-609ab13068b1)


# Perhatian:
Bagian ini masih dalam pengembangan lebih lanjut, akan ada kemungkinan error saat anda menjalankanya sekarang.
untuk penggunaan siap pakai silahkan gunakan [Penerjemah dengan selector manual v.1.1](https://github.com/Mabzak-Knight/penerjemah_manga/tree/Penerjemah-dengan-selector-manual-v.1.1)

# Panduan Pemakaian
Jalankan [Server_Colab.ipynb](https://github.com/Mabzak-Knight/penerjemah_manga/blob/main/Server_Colab.ipynb) di google colab atau jupiter notebook

# Refrensi:
+ [Comic-Text-Detector](https://github.com/kha-white/comic-text-detector/)
+ [Manga_ocr](https://github.com/kha-white/manga-ocr)
+ [Manga Image Translator](https://github.com/zyddnys/manga-image-translator)
