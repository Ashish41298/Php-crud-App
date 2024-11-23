
<?php
include('./conn.php');
$msg = "";
$color = "";
$id = $_GET['id'];
if(isset($id)){

    $geri = "select * from users where id = $id";
    $ds = mysqli_query($conn, $geri);

    if(isset($ds)){
        if (mysqli_num_rows($ds) > 0) {
            $rowing = mysqli_fetch_assoc($ds);
            function checkigm($imdata){
                if($imdata['userimage'] !=""){
                    if(file_exists('./uploads/'.$imdata['userimage'])){
                        unlink('./uploads/'.$imdata['userimage']);
                    };
                }
            }
             $data = checkigm($rowing);
            $dsql = "delete from users where id = $id";
            $dres = mysqli_query($conn, $dsql);
            if($dres){
                $color = "green";
                $msg = "user deleted successfully.";
                header("Location:index.php?msg=$msg&&color=$color");
            }else{
                $color = "crimson";
                $msg = "can't user delete! some thing went to wrong.";
                header("Location:index.php?msg=$msg&&color=$color");
            }
        } else {
            echo "No user found yet!.";
        }
    }

  
}
?>