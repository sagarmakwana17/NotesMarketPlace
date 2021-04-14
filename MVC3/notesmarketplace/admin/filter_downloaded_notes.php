 
                   
                   
                   
                   
 <?php
 session_start();
include"../includes/database.php";
?>          
                   
                   
              
      
                     
                                                       
   <!--Displaying the notes from dropdown filters-->                
         <?php

                if(isset($_POST['note'])){
                    
                   echo $note = $_POST['note'];
                   
                ?>   
                
                <div class="table-title row">
                    <div class="col-6">
                        <p>Downloaded Notes</p>
                        <form class="form-inline" method="post" id="filters">


                            <select id="note" class="form-control" name="university">
                                <option value="" disabled selected>Select Note</option>
                                <?php
                                        $query = "SELECT DISTINCT Title FROM sellernotes";
                                        $title = mysqli_query($connection,$query);
                                        if(!$title){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($title)){
                                            $t = $row['Title'];
                                            echo"<option value='$t'>$t</option>";
                                        }
                                    ?>


                            </select>
                            <select id="seller" class="form-control" name="university">
                                <option value="" disabled selected>Select Seller</option>
                                <?php
                                        $query = "SELECT DISTINCT FirstName FROM users";
                                        $universities = mysqli_query($connection,$query);
                                        if(!$universities){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($universities)){
                                            $s = $row['FirstName'];
                                            echo"<option value='$s'>$s</option>";
                                        }
                                    ?>


                            </select>
                            <select id="buyer" class="form-control" name="university">
                                <option value="" disabled selected>Select Buyer</option>
                                <?php
                                        $query = "SELECT DISTINCT FirstName FROM users";
                                        $universities = mysqli_query($connection,$query);
                                        if(!$universities){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($universities)){
                                            $s = $row['FirstName'];
                                            echo"<option value='$s'>$s</option>";
                                        }
                                    ?>


                            </select>
                        </form>

                    </div>
                    <div class="col-6">

                        <form class="form-inline" method="post" id="search_data">

                            <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search" name="search">

                            <button type="submit" class="btn btn-primary mb-2" name="submit">Submit</button>

                        </form>

                    </div>
                </div>

                <div class="table-responsive">
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
                                 $query = "SELECT * FROM sellernotes WHERE Status = 'published' AND Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID WHERE s.Title = '{$note}'";
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
                            $file = "SELECT FilePath FROM sellernotesattachements WHERE NoteID = $n_id";
                            $file_query = mysqli_query($connection,$file);
                            if(!$file_query){
                                 die(mysqli_error($connection));
                             }
                            $file = mysqli_fetch_assoc($file_query);
                            $file_path = $file['FilePath'];
                           
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
                </div>
                <?php
                if($total_records==0){
                    echo" <p class='text-center' style= 'font-size:26px; margin-top : 20px; color:#6255a5; font-weight:600'>No Records Found !</p>";
                }
                ?>
                <nav aria-label="Page navigation example" id="pagination" style="margin-top : 20px;">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="download_notes.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="download_notes.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="download_notes.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>


                <?php
                }
                ?>
                
                
                
                
                
                
                
                
                 <?php

                if(isset($_POST['seller'])){
                    
                   echo $seller = $_POST['seller'];
                   
                ?>   
                
                <div class="table-title row">
                    <div class="col-6">
                        <p>Downloaded Notes</p>
                        <form class="form-inline" method="post" id="filters">


                            <select id="note" class="form-control" name="university">
                                <option value="" disabled selected>Select Note</option>
                                <?php
                                        $query = "SELECT DISTINCT Title FROM sellernotes";
                                        $title = mysqli_query($connection,$query);
                                        if(!$title){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($title)){
                                            $t = $row['Title'];
                                            echo"<option value='$t'>$t</option>";
                                        }
                                    ?>


                            </select>
                            <select id="seller" class="form-control" name="university">
                                <option value="" disabled selected>Select Seller</option>
                                <?php
                                        $query = "SELECT DISTINCT FirstName FROM users";
                                        $universities = mysqli_query($connection,$query);
                                        if(!$universities){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($universities)){
                                            $s = $row['FirstName'];
                                            echo"<option value='$s'>$s</option>";
                                        }
                                    ?>


                            </select>
                            <select id="buyer" class="form-control" name="university">
                                <option value="" disabled selected>Select Buyer</option>
                                <?php
                                        $query = "SELECT DISTINCT FirstName FROM users";
                                        $universities = mysqli_query($connection,$query);
                                        if(!$universities){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($universities)){
                                            $s = $row['FirstName'];
                                            echo"<option value='$s'>$s</option>";
                                        }
                                    ?>


                            </select>
                        </form>

                    </div>
                    <div class="col-6">

                        <form class="form-inline" method="post" id="search_data">

                            <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search" name="search">

                            <button type="submit" class="btn btn-primary mb-2" name="submit">Submit</button>

                        </form>

                    </div>
                </div>

                <div class="table-responsive">
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
                                 $query = "SELECT * FROM sellernotes WHERE Status = 'published' AND Title LIKE '{$search}%' OR Category LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM downloads AS d JOIN sellernotes AS s ON s.ID = d.NoteID JOIN users AS u ON s.SellerID = u.ID WHERE u.FirstName = '{$seller}'";
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
                            $file = "SELECT FilePath FROM sellernotesattachements WHERE NoteID = $n_id";
                            $file_query = mysqli_query($connection,$file);
                            if(!$file_query){
                                 die(mysqli_error($connection));
                             }
                            $file = mysqli_fetch_assoc($file_query);
                            $file_path = $file['FilePath'];
                           
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
                </div>
                <?php
                if($total_records==0){
                    echo" <p class='text-center' style= 'font-size:26px; margin-top : 20px; color:#6255a5; font-weight:600'>No Records Found !</p>";
                }
                ?>
                <nav aria-label="Page navigation example" id="pagination" style="margin-top : 20px;">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="download_notes.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="download_notes.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="download_notes.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>


                <?php
                }
                ?>
                
                
                
                
                
             
                
                    
                        
                       
                        
                        
                        
                    

            
                
                
                
                
                
                
                
                
                
                
                