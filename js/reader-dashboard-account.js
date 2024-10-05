document.getElementById('uploadDiv').addEventListener('click', function() {
    document.getElementById('fileInput').click();
  });
  
  document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const previewImage = document.getElementById('previewImage');
        previewImage.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  });
  