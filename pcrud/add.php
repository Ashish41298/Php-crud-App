<?php
include("./conn.php");
$color = "";
function addfile($image){
    
    $filename = "img_".date('dmY')."_". $image['full_path'];
    $path = "uploads/".$filename;
    $tname = $image['tmp_name'];
    if(move_uploaded_file($tname, $path)){
        return $filename;
    }

}

if(isset($_POST['send'])){
    $name = ($_POST['name']) ? $_POST['name'] : "";
    $email = $_POST['email'] ? $_POST['email'] : "";
    $password = $_POST['password'] ? $_POST['password'] : "";
    $profileimg = $_FILES['image'] ? $_FILES['image'] : "";

    $filedata = addfile($profileimg);
    
    $sql = "INSERT INTO users (name,email,password,userimage) VALUE ('$name', '$email','$password','$filedata')";
    $result = mysqli_query($conn, $sql);

    if($result){
      $msg = "user created successfully.";
      $color = 'green';
        header("Location:index.php?msg=$msg&&color=$color");
    }else{
      $color = 'crimson';
      $msg = "user can't create! please try again.";
      header("Location:index.php?msg=$msg&&color=$color");
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>p Crud operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5 p-2 rounded-2" style="background: lightgray;">
    <div class="d-flex text-align-center justify-content-center">
        <h3 class="m-0" >Add Users</h3>
    </div>
</div>

<div class="container mt-5 d-flex align-item-center justify-content-center">
 <div class="w-50">
 <form method="post" enctype="multipart/form-data" >
  <div class="mb-3 box">
    <label class="form-label" >Name</label>
    <input type="text" name = "name" class="form-control">
  </div>
  <div class="mb-3 box">
    <label class="form-label" >Email</label>
    <input type="email" name = "email" class="form-control">
  </div>
  <div class="mb-3 box">
    <label  class="form-label">Password</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <div class="mb-3 box">
    <label  class="form-label">profile image</label>
    <input type="file" name="image" accept="image/*" class="form-control" onchange="previmg(event)" >
    <div class="container d-flex align-items-center justify-content-center mt-2" >
      <div class="pre" style="display: none; overflow:hidden !important; border-radius:10px; ">
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div class="text-center mb-2">
  <button type="submit" name="send" class="btn btn-outline-primary btn-large" onclick="pd($event)" >save</button>
  <a href="./index.php" class="btn btn-outline-dark ms-2  ">cancel</a>
</div>

</form>
 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
   function previmg(e){
  var file = e.target.files[0];
    if (file) { 
        var imgconatiner = document.querySelector('.pre');
        imgconatiner.style.display = "flex";
        var imgPreview = document.querySelector('.pre img');
        imgPreview.src = URL.createObjectURL(file);
    } 
  }
</script>
</body>
</html>