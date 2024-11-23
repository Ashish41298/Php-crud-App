
<?php
    include('./conn.php');
    $msg = "";
    $color = '';
   $id =  $_GET['id'];
   $path = "http://localhost/projects/pcrud/uploads/";
    if(isset($id)){

        $sql = "select * from users where id = $id";
        $result = mysqli_query($conn, $sql);
        if(isset($result)){
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
          $msg = "Not user found yet! please try again.";
          $color = "crimson";
          header("Location:index.php?msg=$msg&&color=$color");
        }
        }else{
          echo "Error in query execution: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['esend']) && $_POST['esend'] != ""){
      function addfile($datai){
        global $path; global $row;
        if(isset($datai['name']) && $datai['name'] !=""){
          if(isset($row['userimage'])){
          if(file_exists('./uploads/'.$row['userimage'])){
            if(isset($row['userimage']) && $row['userimage'] != ""){unlink('./uploads/'.$row['userimage']);}
          }
          $filename = "img_".date('dmY')."_". $datai['full_path'];
          $path = "uploads/".$filename;
          $tname = $datai['tmp_name'];
          if(move_uploaded_file($tname, $path)){
              return $filename;
          }
        }
        }else{
         return  $filename = $row['userimage'];
        }
        
       
       
    }
      $name = ($_POST['name']) ? $_POST['name'] : "";
      $email = $_POST['email'] ? $_POST['email'] : "";
      $password = $_POST['password'] ? $_POST['password'] : $row['password'];
      $profileimg = $_FILES['image'] ? $_FILES['image'] : "";
      $eimgname = addfile($profileimg);

      $esql = "UPDATE `users` SET `id`='$id' ,`name`='$name',`email`='$email',`password`='$password',`userimage`='$eimgname' WHERE `id` = $id";
      
      $eres = mysqli_query($conn, $esql);
      if(isset($eres)){
        $color = 'green';
        $msg = "user updated successfully!";
        header("Location:index.php?msg=$msg&&color=$color");
      }else{
        $color = 'crimson';
        $msg = "some thing whent! to wrong user can't update";
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
        <h3 class="m-0" >Edit Users</h3>
    </div>
</div>
<div class="container mt-5 d-flex align-item-center justify-content-center">
 <div class="">
 <form method="post" enctype="multipart/form-data" >
  <div class="mb-3">
    <label class="form-label" >Name</label>
    <input type="text" name = "name" class="form-control" value="<?php echo $row['name'];?>">
  </div>
  <div class="mb-3">
    <label class="form-label" >Email</label>
    <input type="email" name = "email" class="form-control" value="<?php echo $row['email'];?>">
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" name="password" class="form-control" value="" >
  </div>
  <div class="mb-3 d-flex flex-column align-items-center "  >
    <label style="margin-left: -225px;" class="form-label">profile image</label>
    <input type="file" name="image" class="form-control" onchange="previmg(event)" >
    <div class="pre mt-3 rounded-5" style="overflow: hidden;">
    <img  src="<?php if(isset($row['userimage'])){echo $path.$row['userimage'];}else{echo "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png";}?>" alt="" srcset="">
  </div>
  </div>
  
  <div class="text-center mb-5">
  <input type="submit" name="esend" class="btn btn-outline-primary btn-large" value="save">
  <a href="./index.php" class="btn btn-outline-dark ms-2">cancel</a>
 </div>
</form>
 </div>
</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previmg(e){
  var file = e.target.files[0];
    if (file) { 
        var imgPreview = document.querySelector('.pre img');
        imgPreview.src = URL.createObjectURL(file);
    } 
  }
</script>
</body>
</html>