
 <?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['t_id'])){
                                                
      $t_id =  $_GET['t_id'];             
        $d = "UPDATE notetypes SET IsActive = 0  WHERE ID = $t_id";
            $deactivate_query = mysqli_query($connection,$d);
       if(!$deactivate_query){
        die(mysqli_error($connection));
     }
?>

<script>
    location.replace('manage_type.php');

</script>

<?php          

}
        
    
?>