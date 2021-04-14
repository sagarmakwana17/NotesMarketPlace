 
                   
                   
                   
                   
 <?php
 session_start();
include"includes/database.php";
?>          
                   
                   
    <!--Displaying the notes from search bar-->               
       <?php

                if(isset($_POST['input'])){
                    
                    $input = $_POST['input'];
                    $query = "SELECT * FROM sellernotes WHERE Title LIKE '{$input}%' OR Category LIKE '{$input}%' OR UniversityName LIKE '{$input}%' OR Course LIKE '{$input}%' ";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="<?php if(!empty($note_pic)){echo $note_pic ;}else {echo 'img/Search/1.jpg'; }?>" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                     
                                                       
   <!--Displaying the notes from dropdown filters-->                
         <?php

                if(isset($_POST['type'])){
                    
                    $type = $_POST['type'];
                    $query = "SELECT * FROM sellernotes WHERE NoteType = '{$type}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                
                 <?php

                if(isset($_POST['category'])){
                    
                    $category = $_POST['category'];
                    $query = "SELECT * FROM sellernotes WHERE Category  = '{$category}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>







                <?php         
                    }
                }
                ?>

  <?php

                if(isset($_POST['university'])){
                    
                    $university= $_POST['university'];
                    $query = "SELECT * FROM sellernotes WHERE UniversityName = '{$university}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                
                <?php

                if(isset($_POST['course'])){
                    
                    $course= $_POST['course'];
                    $query = "SELECT * FROM sellernotes WHERE Course = '{$course}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                
                  <?php

                if(isset($_POST['country'])){
                    
                    $country= $_POST['country'];
                    $query = "SELECT * FROM sellernotes WHERE Country = '{$country}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                
                  <?php

                if(isset($_POST['rating'])){
                    
                    $rating= $_POST['rating'];
                   
                    
                    
                    $query = "SELECT u.* , r.* FROM sellernotes AS u JOIN sellernotesreviews AS r ON u.ID = r.NoteID  WHERE r.Ratings = '{$rating}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                    ?>
                            <a href="<?php echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;?>">
                                <div class="col-md-4">
                                    <div class="note-wrapper">
                                        <img src="img/Search/1.jpg" class="img-responsive">
                                        <div class="details">

                                            <div class="note-title">
                                                <p><?php echo $note_title ;?></p>
                                            </div>
                                            <table class="note-info table-borderless">
                                                <tr>
                                                    <td><img src="img/images/university.png"></td>
                                                    <td><?php echo $note_university ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/pages.png"></td>
                                                    <td><?php echo $note_page ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/calendar.png"></td>
                                                    <td><?php echo $note_date ;?></td>
                                                </tr>
                                                <tr>
                                                    <td><img src="img/images/flag.png"></td>
                                                    <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                                </tr>

                                            </table>
                                            <div class="bottom">
                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                                <div class="reviews">
                                                    <p>500 Reviews</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                <?php         
                    }
                }
                ?>
                
                
                
                
                
                
                
