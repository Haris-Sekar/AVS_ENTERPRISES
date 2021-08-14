<?php
include('frd.php');
?>

<form method="post" enctype="multipart/form-data" class="pricelist-update-form">
    <label>Price List File Name:</label>
    <input type="text" name="title" class="text-feild"><br><br>
    <label>File Upload</label>
    <input type="File" name="file"><br><br>
    <input type="submit" name="submit" class="btn-update-pricelist-submit">
 
 
</form>
<?php  
if (isset($_POST["submit"]))
 {
     #retrieve file title
        $title = $_POST["title"];
     
    #file name with a random number so that similar dont get replaced
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
 
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
   
     #upload directory path
$uploads_dir = 'pdf';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
 
    #sql query to insert into database
    $sql = "INSERT INTO price_list( `file_name`, `pdf_file`) VALUES ('$title','$pname');";
    $result=mysqli_query($conn,$sql);
    if($result){
 
    echo "File Sucessfully uploaded";
    }
    else{
        echo "Error";
    }
    
}
 
 ?>