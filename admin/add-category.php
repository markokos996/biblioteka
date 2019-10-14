<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['create']))
{
$category=$_POST['category'];
$status=$_POST['status'];
$sql="INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Kategorija dodana uspjesno";
header('location:manage-categories.php');
}
else 
{
$_SESSION['error']="Nesto nije u redu. Pokusajte ponovo";
header('location:manage-categories.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem za upravljanje bibliotekom | Dodaj kategoriju</title>
    <!-- BOOTSTRAP -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CSS  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------header-->
<?php include('includes/header.php');?>
<!-- kraj header-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Dodaj kategoriju</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Informacije o kategoriji
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Ime kategorije</label>
<input class="form-control" type="text" name="category" autocomplete="off" required />
</div>
<div class="form-group">
<label>Status</label>
 <div class="radio">
<label>
<input type="radio" name="status" id="status" value="1" checked="checked">Aktivan
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="status" id="status" value="0">Neaktivan
</label>
</div>

</div>
<button type="submit" name="create" class="btn btn-info">Kreiraj </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- footer-->
  <?php include('includes/footer.php');?>
      <!-- kraj footer-->
    <!-- JAVASCRIPT  -->
    <!-- JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- javascript  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
