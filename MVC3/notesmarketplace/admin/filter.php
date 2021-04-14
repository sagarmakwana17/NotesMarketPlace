 
                           
<?php
 session_start();
include"../includes/database.php";
?>                                 
                           <tr>
                            <th>Sr.No.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>

                            <th>SELLER</th>
                            <th></th>
                            <th>DATE ADDED</th>
                            <th> STATUS</th>
                            <th></th>
                            <th>ACTION</th>
                            <th></th>
                        </tr>
                        <?php
$user = $_POST['user'];

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
                                 $query = "SELECT * FROM sellernotes WHERE Status = 'submitted' AND Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM sellernotes AS s JOIN users AS u ON s.SellerID = u.ID WHERE Status = 'submitted' AND FirstName LIKE '{$user}' ";
                            }
                        
                    $published_notes = mysqli_query($connection,$query);

                        if(!$published_notes){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($published_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno = 1;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($published_notes)){
                             $count = $count + 1;
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
                                <a class="" href="">
                                    <div class="dots">
                                        <img src="../img/images/eye.png">
                                    </div>
                                </a>
                            </td>
                            <td><?php echo $publish_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <button type="" id="approve" class="btn btn-primary mb-2 t-button" name="submit" data-toggle="modal" data-target="#exampleModal2" >APPROVE</button>

                            </td>
                            <td>
                                <button type="" id="reject" class="btn btn-primary mb-2 t-button" name="" data-toggle="modal" data-target="#exampleModal1">REJECT</button>

                            </td>
                            <td>

                                <button type="submit" id="inreview" class="btn btn-primary mb-2 t-button" name="submit" data-toggle="modal" data-target="#exampleModal3">INREVIEW</button>

                            </td>



                        </tr>
                        <!--modal for reject-->

                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="title">
                                            <h4><?php echo $title;?></h4>
                                        </div>

                                        <?php
                                            if(isset($_POST['reject'])){
                                                $remark = $_POST['remark'];
                                                $unpublish = "UPDATE sellernotes SET Status = 'rejected', AdminRemarks = '$remark' WHERE ID = $n_id ";
                                                $unpublish_query = mysqli_query($connection,$unpublish);
                                                if(!unpublish_query){
                                                    die(mysqli_error($connection));
                                                }

                                            }
                                            ?>
                                        <form action="" method="post" id="" class="col-md-12">

                                            <div class="form-row ">
                                                <div class="form-group">
                                                    <label for="title">Remarks<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                                                    <input type="text" class="form-control" id="remark" placeholder="Remarks....." name="remark" required>
                                                </div>

                                            </div>

                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                        <button type="submit" class="btn btn-primary t-button" id="reject" name="reject">REJECT</button>
                                    </div>
                                    </form>

                                </div>
                            </div> 
                        </div>
                        
                        <!--modal for approve-->
                        
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="title">
                                            <h4><?php echo $title;?></h4>
                                            <h4 style="font-size:16px;">Are You Sure You Want to approve this note?</h4>
                                        </div>

                                        <?php
                                            if(isset($_POST['unpublish'])){
                                                $remark = $_POST['remark'];
                                                $unpublish = "UPDATE sellernotes SET Status = 'published' WHERE ID = $n_id ";
                                                $unpublish_query = mysqli_query($connection,$unpublish);
                                                if(!unpublish_query){
                                                    die(mysqli_error($connection));
                                                }

                                            }
                                            ?>
                                        
                                    </div>
                                    <div class="modal-footer">
                                       <form action="" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-primary t-button" id="" name="approve">YES</button>
                                        </form>
                                    </div>

                                </div>
                            </div> 
                        </div>
                         <!--modal for inreview-->
                        
                        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="title">
                                            <h4><?php echo $title;?></h4>
                                            <h4 style="font-size:16px;">Do You Wish to initiate review process?</h4>
                                        </div>

                                        <?php
                                            if(isset($_POST['inreview'])){
                                                $remark = $_POST['remark'];
                                                $unpublish = "UPDATE sellernotes SET Status = 'inreview', AdminRemarks = '$remark' WHERE ID = $n_id ";
                                                $unpublish_query = mysqli_query($connection,$unpublish);
                                                if(!unpublish_query){
                                                    die(mysqli_error($connection));
                                                }

                                            }
                                            ?>
                                        
                                    </div>
                                    <div class="modal-footer">
                                       <form action="" method="post">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-primary t-button" id="" name="inreview">YES</button>
                                        </form>
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