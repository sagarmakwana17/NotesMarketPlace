<?php
include"database.php";
?>
<?php
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    
}else{
    $user_id = 16;
}
?>



<?php

if(isset($_GET['download_id'])&& isset($_GET['user_id']) ){
        $download_id = $_GET['download_id'];
        $user_id = $_GET['user_id'];
       $allow_download = "UPDATE downloads SET IsSellerHasAllowedDownload =1 WHERE ID = $download_id";
                        $allow_download_query = mysqli_query($connection,$allow_download);
                        
                        if(!$allow_download_query){
                            die(mysqli_error($connection));
                        }
                        else if($allow_download_query){
                            
                    ?>
                       <script>
                                    location.replace('../buyer_requests.php?user_id=<?php echo $user_id; ?>');
                         </script>
                    <?php                 
                        
                        }
}
?>