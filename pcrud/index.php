<?php include('./conn.php');

$msg = isset($_GET['msg']) ? $_GET['msg']: "";
$clr = isset($_GET['color']) ? $_GET['color'] : "";

 $sql = "select * from users";

 $query = mysqli_query($conn, $sql);

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
<style>
  table, tr, th, td{
    border: 1px solid blue;
    border-radius: 5px;
    border-collapse: collapse;
    text-align: center;
  }
  .message{
    background: rebeccapurple;
    height: 35px;
    margin: 0px;
    padding: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border-radius: 5px;
  }
</style>
<body>

<div class="container mt-5 p-2 rounded-2" style="background: lightgray;">
    <div class="d-flex text-align-center justify-content-between">
        <h3>crud-operation</h3>
        <a href="add.php" class="btn btn-outline-dark"><i class="bi bi-plus-lg"></i> Add New</a>
    </div>
</div>
<?php if($msg !=""){
?>
  <div class="container mt-3 mdata">
    <div class="message" style="background: <?php if(isset($clr)) echo $clr;?>;">
        <span><?php if(isset($msg)){{echo $msg;}}?></span>
        <button class="btn" style="position: absolute; right: 50px; z-index:5555;"><i style="color:white; font-size: 20px;" class="bi bi-x-square cl"></i></button>
    </div>
</div>
<?php
} ?>

<div class="container mt-5 p-2 rounded-2 d-flex justify-content-center" style="background: lightgray;">


    <?php
    if(mysqli_num_rows($query) > 0){
        ?>
           <table >
    <tr>
        <th style="width: 40px;" class="cell">#</th>
        <th style="width: 150px;" class="cells">User Name</th>
        <th style="width: 150px;" class="cells">Email</th>
        <th style="width: 150px;" class="cells">Profile Image</th>
        <th>Action</th>
    </tr>
    <?php
        $path = "http://localhost/projects/pcrud/uploads/";
       while($data = mysqli_fetch_assoc($query)){
       ?>
            <tr>
        <td class="cells px-2" ><?php echo $data["id"];?></td>
        <td class="cells px-2" ><?php echo $data["name"];?></td>
        <td class="cells px-2" ><?php echo $data["email"];?></td>
        <td class="cells px-2" > <a href="<?php echo $path.$data['userimage'] ?>"><img style="padding:10px; height: 100px; width:100px; object-fit:cover; border-radius:20px;" src="<?php echo $path.$data['userimage'] ?>" alt=""></a> </td>
        <td class="cells px-2"> <a href="view.php?id=<?php echo $data['id'] ?>" class="btn btn-info"><i class="bi bi-view-stacked me-1"></i>view</a> <a href="edit.php?id=<?php echo $data['id'] ?>" class="btn btn-success"><i class="bi bi-pencil me-1"></i>edit</a>
        <a href="delete.php?id=<?php echo $data['id'] ?>" class="btn btn-danger"><i class="bi bi-trash3 me-1"></i> delete</a>
        </td>
        </tr>
       <?php
       }
    }else{
        ?>
        <div class="container" >
            <div class="d-flex align-items-center justify-content-center">User not Found!😒</div>
        </div>
        <?php
    }
    ?>

   </table>
</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.querySelector('.mdata');
    if(el){
        setTimeout(function(){
            el.style.display = "none";
        },3000);
    }
    var el = document.querySelector('.mdata');
    var cl = document.querySelector('.cl');
    if(cl){
        cl.addEventListener('click', function(){
        el.style.display = "none";
    });
    }
   
</script>
</body>
</html>