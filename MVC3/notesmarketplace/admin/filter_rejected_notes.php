           <?php
session_start();
include"../includes/database.php";
 ob_start();

?>      
                        
                        
                        
                        <table class="progres">

                        <tr>
                            <th>Sr.No.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>

                            <th>SELLER</th>
                            <th></th>
                            <th>DATE EDITED</th>
                            <th> REJECTED BY</th>
                            <th>REMARK</th>

                            <th></th>
                        </tr>
                        <?php
                            
                        $user = $_POST['user'] ;   
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
                            ?>
                            <div class="temp">
                                <?php
                                 if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                 $query = "SELECT * FROM sellernotes WHERE Status = 'rejected' AND Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                        
                        
                            else{
                           
                             $query = "SELECT * FROM sellernotes AS s JOIN users AS u ON s.SellerID = u.ID WHERE Status = 'rejected' AND s.IsActive = 1 AND u.FirstName = '{$user}'"; 
                     
                            }
                        
                                
                                ?>
                                
                            </div>
                            
                            <?php
                            
                            
                        
                          $published_notes = mysqli_query($connection,$query);

                        if(!$published_notes){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($published_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno = 0;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($published_notes)){
                             $srno++;
                                if($row['IsPaid'] == 'no'){
                                    $selltype = "Free";
                                }else{
                                    $selltype = "Paid";
                                }
                            $seller = $row['SellerID'];
                            $title = $row['Title'];
                            $status = $row['Status'];
                            $cat = $row['Category'];
                            $n_id = $row['ID'];
                            $u_query = "SELECT * FROM users WHERE ID = $seller";
                             $user_query = mysqli_query($connection,$u_query);
                             if(!$user_query){
                                 die(mysqli_error($connection));
                             }
                            if(mysqli_num_rows($user_query)!== 0){
                               $user = mysqli_fetch_assoc($user_query);
                                $publisher = $user['FirstName'].' '.$user['LastName'];
                               
                            }
                            
                            $price = $row['SellingPrice'];
                            $publish_date = $row['CreatedDate'];
                            
                            $downloads = "SELECT * FROM downloads WHERE NoteID = $n_id";
                            $downloads_query = mysqli_query($connection,$downloads);
                            if(!$downloads_query){
                                 die(mysqli_error($connection));
                             }
                            $download_num = mysqli_num_rows($downloads_query);
                            
                            $file_path = $row['FilePath'];
                           
                            if($start_from<$i){


                    ?>
                        <tr>
                            <td><?php echo $srno; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $cat; ?></td>

                            <td><?php echo  $publisher; ?></td>
                            <td>
                                <a href="">
                                    <img src="../img/images/eye.png">
                                </a>
                            </td>
                            <td><?php echo $publish_date; ?></td>
                            <td></td>
                            <td>

                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="../img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="../<?php echo $file_path; ?>" download>Download Note</a>
                                        <a class="dropdown-item text-center" href="<?php echo '../note_details.php?note_id='.$n_id ;?>">View More Details</a>
                                        <a class="dropdown-item text-center" data-toggle="modal" data-target="#p<?php echo $srno; ?>">Approve</a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <!--modal for reject-->

                        <div class="modal fade" id="p<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="title">
                                            <h4><?php echo $title;?></h4>
                                            <h4 style="font-size:16px; margin-top:20px;"> Are you sure you want to approve this note?</h4>
                                        </div>

                                        <?php
                                            if(isset($_POST['reject'])){
                                                $remark = $_POST['remark'];
                                                $unpublish = "UPDATE sellernotes SET Status = 'published', AdminRemarks = '$remark' WHERE ID = $n_id ";
                                                $unpublish_query = mysqli_query($connection,$unpublish);
                                                if(!unpublish_query){
                                                    die(mysqli_error($connection));
                                                }

                                            }
                                            ?>
                                        

                                           


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                        <a class="btn btn-primary" href="approve_note.php?note_id=<?php echo $n_id ?>" role="button" style="margin-right:50px; " id="approved">YES</a>
                                        
                                    </div>
                                   

                                </div>
                            </div>
                        </div>



                        <?php                        
                        }
                             $i++;
                                if($i>$k){
                                    break;
                                }
                        }
                    ?>




                    </table>