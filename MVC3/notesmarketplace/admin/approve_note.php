<?php
session_start();
include"../includes/database.php";
 ob_start();

?>

 
 <?php

 if(isset($_GET['note_id'])){
                                                
      $n_id =  $_GET['note_id'];             
      $remark = $_POST['remark'];
       $approve = "UPDATE sellernotes SET Status = 'published' WHERE ID = $n_id ";
          $approve_query = mysqli_query($connection,$approve);
       if(!$approve_query){
          die(mysqli_error($connection));
        }
?>

<script>
    location.replace('rejected_notes.php');

</script>

<?php          

}
        
    
?>