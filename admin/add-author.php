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
$author=$_POST['author'];
$sql="INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
$query = $dbh->prepare($sql);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Uspjesno dodan autor";
header('location:manage-authors.php');
}
else 
{
$_SESSION['error']="Nesto nije uredu.Pokusajte ponovo";
header('location:manage-authors.php');
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
    <title>Sistem za upravljanje bibliotekom | Dodaj autora</title>
    <!-- BOOTSTRAP   -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME   -->
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
                <h4 class="header-line">Dodaj autora</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Podaci o autoru
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Ime autora</label>
<input class="form-control" type="text" name="author" autocomplete="off"  required />
</div>

<button type="submit" name="create" class="btn btn-info">Dodaj </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- footer-->
  <?php include('includes/footer.php');?>
      <!-- footer kraj-->
    <!-- JAVASCRIPT   -->
    <!--  JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP   -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- javascript  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
