
 <?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['delete'])){
                                                
      $c_id =  $_GET['delete'];             
        $d = "DELETE FROM sellernotesreportedissues WHERE ID = $c_id";
            $deactivate_query = mysqli_query($connection,$d);
       if(!$deactivate_query){
        die(mysqli_error($connection));
        }
?>

<script>
    location.replace('spam_reports.php');

</script>

<?php          

}
        
    
?>