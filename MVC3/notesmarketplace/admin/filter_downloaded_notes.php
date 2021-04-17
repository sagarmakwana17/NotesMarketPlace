 
   <?php
session_start();
include"../includes/database.php";
 ob_start();

?>      



<?php
if(isset($_POST['note'])){
?>
  <table class="progres">

                        <tr>
                            <th>SR.NO.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>BUYER</th>
                            <th></th>
                            <th>SELLER</th>
                            <th></th>
                            <th>SELL TYPE</th>
                            <th> PRICE</th>
                            <th>DOWNLOAD DATE/TIME</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        
                            $n_t = $_POST['note'];
                      
                         if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            $page =mysqli_real_escape_string($connection,$page);
                            $page = htmlentities($page);
                            }
                            else{
                                $page = 1;
                            }    
                            $num_per_page = 5;
                            $start_from = ($page-1) * $num_per_page;
                            
                             if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                 $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID WHERE Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID WHERE s.Title = '{$n_t}'";
                            }
                        
                          $published_notes = mysqli_query($connection,$query);

                        if(!$published_notes){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($published_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno =0;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($published_notes)){
                            
                             $count = $count + 1;
                                if($row['IsPaid'] == 'no'){
                                    $selltype = "Free";
                                }else{
                                    $selltype = "Paid";
                                }
                            $seller = $row['Seller'];
                            $buyer = $row['Downloader'];
                            $title = $row['Title'];
                            $status = $row['Status'];
                            $cat = $row['Category'];
                            $n_id = $row['ID'];
                            
                            /*getting details of seller*/
                            
                            $u_query = "SELECT * FROM users WHERE ID = $seller";
                             $user_query = mysqli_query($connection,$u_query);
                             if(!$user_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($user_query)!== 0){
                               $user = mysqli_fetch_assoc($user_query);
                                $publisher = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            /*get details of buyer*/
                            $b_query = "SELECT * FROM users WHERE ID = $buyer";
                             $buyer_query = mysqli_query($connection,$b_query);
                             if(!$buyer_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($buyer_query)!== 0){
                               $b = mysqli_fetch_assoc($buyer_query);
                                $buyer = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            
                            $price = $row['SellingPrice'];
                            $download_date = $row['AttachmentDownloadedDate'];
                            
                            $downloads = "SELECT * FROM downloads WHERE NoteID = $n_id";
                            $downloads_query = mysqli_query($connection,$downloads);
                            if(!$downloads_query){
                                 die(mysqli_error($connection));
                             }
                            $download_num = mysqli_num_rows($downloads_query);
                            
                            $file_path = $row['FilePath'];
                           
                            if($start_from<$i){
                                $srno++;


                    ?>
                        <tr>
                            <td><?php echo $srno; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $cat; ?></td>
                            <td><?php echo $buyer; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo  $publisher; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo $selltype; ?></td>
                            <td>$<?php echo $price; ?></td>

                            <td><?php echo $download_date; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="../img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="<?php echo '../'.$file_path; ?>" download>Download Note</a>
                                        <a class="dropdown-item text-center" href="<?php echo '../note_details.php?note_id='.$n_id ;?>">View More Details</a>

                                    </div>
                                </div>
                            </td>

                        </tr>
                        <!--modal for reject-->
                        <?php                        
                        }
                             $i++;
                                if($i>$k){
                                    break;
                                }
                        }
                        
                    ?>

                    </table>
            <?php
}
            ?>        
            
           
          
         
<!--code for seller dropdown-->        
       
      <?php
if(isset($_POST['seller'])){
?>
  <table class="progres">

                        <tr>
                            <th>SR.NO.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>BUYER</th>
                            <th></th>
                            <th>SELLER</th>
                            <th></th>
                            <th>SELL TYPE</th>
                            <th> PRICE</th>
                            <th>DOWNLOAD DATE/TIME</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        
                            $n_t = $_POST['seller'];
                      
                         if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            $page =mysqli_real_escape_string($connection,$page);
                            $page = htmlentities($page);
                            }
                            else{
                                $page = 1;
                            }    
                            $num_per_page = 5;
                            $start_from = ($page-1) * $num_per_page;
                            
                             if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                 $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID WHERE Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID JOIN users AS u ON s.SellerID = u.ID  WHERE u.FirstName = '{$n_t}'";
                            }
                        
                          $published_notes = mysqli_query($connection,$query);

                        if(!$published_notes){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($published_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno =0;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($published_notes)){
                            
                             $count = $count + 1;
                                if($row['IsPaid'] == 'no'){
                                    $selltype = "Free";
                                }else{
                                    $selltype = "Paid";
                                }
                            $seller = $row['Seller'];
                            $buyer = $row['Downloader'];
                            $title = $row['Title'];
                            $status = $row['Status'];
                            $cat = $row['Category'];
                            $n_id = $row['ID'];
                            
                            /*getting details of seller*/
                            
                            $u_query = "SELECT * FROM users WHERE ID = $seller";
                             $user_query = mysqli_query($connection,$u_query);
                             if(!$user_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($user_query)!== 0){
                               $user = mysqli_fetch_assoc($user_query);
                                $publisher = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            /*get details of buyer*/
                            $b_query = "SELECT * FROM users WHERE ID = $buyer";
                             $buyer_query = mysqli_query($connection,$b_query);
                             if(!$buyer_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($buyer_query)!== 0){
                               $b = mysqli_fetch_assoc($buyer_query);
                                $buyer = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            
                            $price = $row['SellingPrice'];
                            $download_date = $row['AttachmentDownloadedDate'];
                            
                            $downloads = "SELECT * FROM downloads WHERE NoteID = $n_id";
                            $downloads_query = mysqli_query($connection,$downloads);
                            if(!$downloads_query){
                                 die(mysqli_error($connection));
                             }
                            $download_num = mysqli_num_rows($downloads_query);
                            
                            $file_path = $row['FilePath'];
                           
                            if($start_from<$i){
                                $srno++;


                    ?>
                        <tr>
                            <td><?php echo $srno; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $cat; ?></td>
                            <td><?php echo $buyer; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo  $publisher; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo $selltype; ?></td>
                            <td>$<?php echo $price; ?></td>

                            <td><?php echo $download_date; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="../img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="<?php echo '../'.$file_path; ?>" download>Download Note</a>
                                        <a class="dropdown-item text-center" href="<?php echo '../note_details.php?note_id='.$n_id ;?>">View More Details</a>

                                    </div>
                                </div>
                            </td>

                        </tr>
                        <!--modal for reject-->
                        <?php                        
                        }
                             $i++;
                                if($i>$k){
                                    break;
                                }
                        }
                        
                    ?>

                    </table>
            <?php
}
            ?>        
     
     
     <!--code for seller dropdown-->        
       
      <?php
if(isset($_POST['buyer'])){
?>
  <table class="progres">

                        <tr>
                            <th>SR.NO.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>BUYER</th>
                            <th></th>
                            <th>SELLER</th>
                            <th></th>
                            <th>SELL TYPE</th>
                            <th> PRICE</th>
                            <th>DOWNLOAD DATE/TIME</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        
                            $n_t = $_POST['buyer'];
                      
                         if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            $page =mysqli_real_escape_string($connection,$page);
                            $page = htmlentities($page);
                            }
                            else{
                                $page = 1;
                            }    
                            $num_per_page = 5;
                            $start_from = ($page-1) * $num_per_page;
                            
                             if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                 $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID WHERE Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID JOIN users AS u ON d.Downloader = u.ID  WHERE u.FirstName = '{$n_t}'";
                            }
                        
                          $published_notes = mysqli_query($connection,$query);

                        if(!$published_notes){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($published_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno =0;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($published_notes)){
                            
                             $count = $count + 1;
                                if($row['IsPaid'] == 'no'){
                                    $selltype = "Free";
                                }else{
                                    $selltype = "Paid";
                                }
                            $se = $row['Seller'];
                            $buyer = $row['Downloader'];
                            $title = $row['Title'];
                            $status = $row['Status'];
                            $cat = $row['Category'];
                            $n_id = $row['ID'];
                            
                            /*getting details of seller*/
                            
                            $u_query = "SELECT * FROM users WHERE ID = $se";
                             $user_query = mysqli_query($connection,$u_query);
                             if(!$user_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($user_query)!== 0){
                               $user = mysqli_fetch_assoc($user_query);
                                $publisher = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            
                           
                                $buyername = $row['FirstName'].' '.$row['LastName'];
                               
                            
                            
                            $price = $row['SellingPrice'];
                            $download_date = $row['AttachmentDownloadedDate'];
                            
                            $downloads = "SELECT * FROM downloads WHERE NoteID = $n_id";
                            $downloads_query = mysqli_query($connection,$downloads);
                            if(!$downloads_query){
                                 die(mysqli_error($connection));
                             }
                            $download_num = mysqli_num_rows($downloads_query);
                            
                            $file_path = $row['FilePath'];
                           
                            if($start_from<$i){
                                $srno++;


                    ?>
                        <tr>
                            <td><?php echo $srno; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $cat; ?></td>
                            <td><?php echo $buyername; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo  $publisher; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo $selltype; ?></td>
                            <td>$<?php echo $price; ?></td>

                            <td><?php echo $download_date; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="../img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="<?php echo '../'.$file_path; ?>" download>Download Note</a>
                                        <a class="dropdown-item text-center" href="<?php echo '../note_details.php?note_id='.$n_id ;?>">View More Details</a>

                                    </div>
                                </div>
                            </td>

                        </tr>
                        <!--modal for reject-->
                        <?php                        
                        }
                             $i++;
                                if($i>$k){
                                    break;
                                }
                        }
                        
                    ?>

                    </table>
            <?php
}
            ?>        
     
    
   
  
 










