<?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['note_id'])){
                                            
      $n_id =  $_GET['note_id'];             
     
       $reject = "UPDATE sellernotes SET Status = 'rejected' WHERE ID = $n_id ";
          $reject_query = mysqli_query($connection,$reject);
       if(!$reject_query){
          die(mysqli_error($connection));
        }
?>

<script>
    location.replace('notes_under_review.php');

</script>

<?php          

}
        
    
?>


