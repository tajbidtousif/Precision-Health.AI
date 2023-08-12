<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
  <style>
    

body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Ubuntu', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
}

.container {
    position: relative;
    width: 100%;
}

.navigation {
    position: fixed;
    width: 300px;
    height: 100%;
    background: rgb(15, 18, 22);
    left: 0px;
    border-left: 10px solid;
    transition: 0.5s;
    overflow: hidden;
}


.navbar .navbar-brand {
    color: #d46b25;
    font-size: 1.5rem;
    font-weight: bold;
    transition: color 0.3s;
}

@keyframes rubberBand {
    0% { transform: scaleX(1); }
    30% { transform: scaleX(1.25); }
    40% { transform: scaleX(0.75); }
    50% { transform: scaleX(1.15); }
    65% { transform: scaleX(0.95); }
    75% { transform: scaleX(1.05); }
    100% { transform: scaleX(1); }
}


.navbar-brand {
    transition: transform 0.5s;
}

.navbar-brand:hover {
    animation: rubberBand 0.5s;
}

.navigation ul li:nth-child(1){
    margin-bottom: 40px;
    
    
}

.navigation ul li:nth-child(1):hover{
   background:none
}
.navigation ul {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 0; 
}

.navigation ul li {
    list-style: none;
}

.navigation ul li a {
    display: block; 
    padding: 10px; 
    color:  #d46b25; 
    text-decoration: none; 
}

.navigation ul li:hover {
    background: #ffffff;
    
}

.navigation ul li a.icon{
        position:relative;
        display: block;
        min-width: 60px;
        height: 60px;
        line-height: 60px;
        text-align: center;

}

.navigation ul li a.icon ion-icon{
       font-size: 1.75em;

}

.search-bar {
      position: absolute;
      top: 0;
      right: 300px;
      padding: 15px;
      display: flex;
      align-items: center;
    }

    .search-bar input {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #d46b25;
      font-size: 16px;
      width: 450px;
      margin-right: 10px;
    }

    .user-icon {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #d46b25;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .user-icon img {
      max-width: 100%;
      max-height: 100%;
      border-radius: 50%;
    }

    .image-upload {
      display: none;
      position: absolute;
      top: 70px;
      right: 20px;
      background-color: white;
      border: 1px solid #d46b25;
      border-radius: 4px;
      padding: 10px;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .image-upload input[type="file"] {
      display: none;
    }

    .image-upload label {
      color: #d46b25;
      cursor: pointer;
      
    }
    .upload-label {
      color: #d46b25;
      cursor: pointer;
      transition: color 0.3s; 
    }

    .upload-label:hover {
      color: #ff9900; 
    }
 </style>
</head>
<body>
  <div class="container">
    <div class="navigation">
      <ul>
        <li>
          <a class="navbar-brand fun-animation" href="landingpage.php">
            <i class="fa fa-male"></i> PrecisionHealth.Com
        </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
            <span class="title">Users</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
            <span class="title">Message</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
            <span class="title">Help</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
            <span class="title">Settings</span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
            <span class="title">Signout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div class="search-bar">
    <input type="search" placeholder="Search...">
    <i class="fas fa-search" style="color: #d46b25;"></i>
  </div>

  <div class="user-icon" onclick="showImageUpload()">
    <img src="path/to/default-image.png" alt="User Image">
  </div>

  <div class="image-upload" id="imageUploadContainer">
    <input type="file" id="image-input" onchange="uploadImage()">
    <label for="image-input" class="upload-label">User Image Profile</label>
  </div>
  
  <script>
    const imageUploadContainer = document.getElementById('imageUploadContainer');
    const imageInput = document.getElementById('image-input');
    const userIcon = document.querySelector('.user-icon img');

    function showImageUpload() {
      imageUploadContainer.style.display = 'block';
    }

    function uploadImage() {
      const selectedImage = imageInput.files[0];
      if (selectedImage) {
        const reader = new FileReader();
        reader.onload = function() {
          userIcon.src = reader.result;
          imageUploadContainer.style.display = 'none';
        }
        reader.readAsDataURL(selectedImage);
      }
    }
  </script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>