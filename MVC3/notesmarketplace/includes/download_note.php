<?php
 session_start();
include"../includes/database.php";
?>


<?php
if(!empty($_GET['note_location'])){
    $user_id = $_GET['user_id'];
    $n_id = $_GET['note_id'];
             $query = "SELECT * FROM sellernotes WHERE ID = '{$n_id}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                        $seller_id = $row['SellerID'];
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
                    }
    
    
    
    
     $query = "INSERT INTO downloads(NoteID,Seller,Downloader,IsSellerHasAllowedDownload,IsAttachmentDownloaded,AttachmentDownloadedDate,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,CreatedDate) VALUES({$note_id},$seller_id,{$user_id},1,1,now(),0,0,'{$note_title}','{$note_cat}',now())";
            $insert_query = mysqli_query($connection,$query);
            if(!$insert_query){
                die(mysqli_error($connection));
    }
    
    $location = $_GET['note_location'];
    $note = '../'.$location;
    header("Cache-Control: public");
    header("Content-Description: FIle Transfer");
    header("Content-Disposition: attachment; filename=$note");
    header("Content-Type: application/zip");
    header("Content-Transfer-Emcoding: binary");
    
    readfile($note);
    exit;
}
?>


