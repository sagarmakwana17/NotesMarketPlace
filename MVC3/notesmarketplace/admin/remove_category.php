
 <?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['c_id'])){
                                                
      $c_id =  $_GET['c_id'];             
        $d = "UPDATE notecategories SET IsActive = 0  WHERE ID = $c_id";
            $deactivate_query = mysqli_query($connection,$d);
       if(!$deactivate_query){
        die(mysqli_error($connection));
     }
?>

<script>
    location.replace('manage_category.php');

</script>

<?php          

}
        
    
?>