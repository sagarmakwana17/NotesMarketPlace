<?php
include"includes/database.php";
session_start();
?>


<?php
$email= $_SESSION['email'];
/*$email = $_GET['vkey'];
echo $email;*/
if(isset($_GET['vkey'])){
  $query = "UPDATE users SET IsEmailVerified = '1' WHERE EmailID = '{$email}' ";  
    $registration_query = mysqli_query($connection, $query);
                            if(!$registration_query){
                              die("FAILED TO EXECUTE YOUR REQUEST" . mysqli_error($connection));
                           }
          else if($registration_query){
                               ?>
                               <script>
                                    location.replace('login.php');
                               </script>    
                            <?php    
                           }
}

?>