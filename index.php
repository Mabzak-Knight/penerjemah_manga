<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crop and Download Image</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik&display=swap"
      rel="stylesheet"
    />
    <!-- Cropper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <div class="image-container">
          <img id="image" />
        </div>
        <div class="preview-container">
          <img id="preview-image" />        
          <div id="result-container"></div> <!-- Wadah untuk menampilkan hasil dari server -->
        </div>
      </div>
      <input type="file" id="file" accept="image/*" />
      <label for="file">Upload Gambar</label>
      <div class="options hide">
        <input
          type="number"
          id="height-input"
          placeholder="Enter Height"
          max="780"
        />
        <input
          type="number"
          id="width-input"
          placeholder="Enter Width"
          max="780"
        />
        <button class="aspect-ratio-button">16:9</button>
        <button class="aspect-ratio-button">4:3</button>
        <button class="aspect-ratio-button">1:1</button>
        <button class="aspect-ratio-button">2:3</button>
        <button class="aspect-ratio-button">Free</button>
      </div>
      <div class="btns">
        <button id="preview" class="hide">Ambil</button>
        <a href="" id="download" class="hide">Download</a>
      </div>
      <div class="btns" align="center">
        <form id="my-form">
         <select style="border-radius: 5px; padding: 8px; margin-bottom: 10px;" name="bahasa">
            <option selected value="id">Bahasa Indonesia</option>
            <option value="en">Bahasa Inggris</option>
            <!-- Tambahkan opsi bahasa lain sesuai kebutuhan -->
        </select>
          <button type="submit" id="tls">Terjemahkan</button>
        <form id="my-form" enctype="multipart/form-data">
      </div>
    </div>
    <!-- Script -->
    <script type="text/javascript">

document.getElementById('tls').style.display = 'none';
let fileInput = document.getElementById("file");
let image = document.getElementById("image");
let downloadButton = document.getElementById("download");
let aspectRatio = document.querySelectorAll(".aspect-ratio-button");
const previewButton = document.getElementById("preview");
const previewImage = document.getElementById("preview-image");
const options = document.querySelector(".options");
const widthInput = document.getElementById("width-input");
const heightInput = document.getElementById("height-input");
let cropper = "";
let fileName = "";

fileInput.onchange = () => {
  previewImage.src = "";
  heightInput.value = 0;
  widthInput.value = 0;
  downloadButton.classList.add("hide");
  document.getElementById('tls').style.display = 'none';

  //The FileReader object helps to read contents of file stored on the computer
  let reader = new FileReader();
  //readAsDataURL reads the content of input file
  reader.readAsDataURL(fileInput.files[0]);

  reader.onload = () => {
    image.setAttribute("src", reader.result);
    if (cropper) {
      cropper.destroy();
    }
    //Initialize cropper
    cropper = new Cropper(image);
    options.classList.remove("hide");
    previewButton.classList.remove("hide");
  };
  fileName = fileInput.files[0].name.split(".")[0];
};

//Set aspect ration
aspectRatio.forEach((element) => {
  element.addEventListener("click", () => {
    if (element.innerText == "Free") {
      cropper.setAspectRatio(NaN);
    } else {
      cropper.setAspectRatio(eval(element.innerText.replace(":", "/")));
    }
  });
});

heightInput.addEventListener("input", () => {
  const { height } = cropper.getImageData();
  if (parseInt(heightInput.value) > Math.round(height)) {
    heightInput.value = Math.round(height);
  }
  let newHeight = parseInt(heightInput.value);
  cropper.setCropBoxData({ height: newHeight });
});
widthInput.addEventListener("input", () => {
  const { width } = cropper.getImageData();
  if (parseInt(widthInput.value) > Math.round(width)) {
    widthInput.value = Math.round(width);
  }
  let newWidth = parseInt(widthInput.value);
  cropper.setCropBoxData({ width: newWidth });
});

previewButton.addEventListener("click", (e) => {
  e.preventDefault();
  downloadButton.classList.remove("hide");
  document.getElementById('tls').style.display = 'block';
  let imgSrc = cropper.getCroppedCanvas({}).toDataURL();

   // Buat Blob dari Data URL
  const blob = dataURItoBlob(imgSrc);

  // Buat URL untuk Blob
  const blobUrl = URL.createObjectURL(blob);

  //Set preview
  previewImage.src = blobUrl;
  downloadButton.download = `cropped_${fileName}.png`;
  downloadButton.setAttribute("href", blobUrl);
});

function dataURItoBlob(dataUrl) {
  const arr = dataUrl.split(',');
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);

  while(n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }

  return new Blob([u8arr], { type: mime });
}

window.onload = () => {
  download.classList.add("hide");
  options.classList.add("hide");
  previewButton.classList.add("hide");
  document.getElementById('tls').style.display = 'none';
};

document.getElementById('my-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir dikirimkan secara default
            sendData();
 });

function sendData() {
    const formData = new FormData(document.getElementById('my-form'));

    // Dapatkan hasil pemotongan dari Cropper.js
    let imgSrc = cropper.getCroppedCanvas({}).toDataURL();
    const blob = dataURItoBlob(imgSrc);

    // Tambahkan hasil pemotongan sebagai file ke FormData
    formData.append('data', blob, 'cropped_image.png');

    fetch('https://fec1-34-83-53-118.ngrok-free.app/process_data', {
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