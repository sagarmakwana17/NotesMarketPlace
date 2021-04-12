
 <?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['user_id'])){
                                                
      $u_id =  $_GET['user_id'];             
        $d = "UPDATE users SET IsActive = 0  WHERE ID = $u_id";
            $deactivate_query = mysqli_query($connection,$d);
       if(!$deactivate_query){
        die(mysqli_error($connection));
     }
?>

<script>
    location.replace('manage_administrator.php');

</script>

<?php          

}
        
    
?>