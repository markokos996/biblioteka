<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Vasa sifra je uspjesno promjenjena');</script>";
}
else {
echo "<script>alert('Email i/ili telefon nije validan');</script>"; 
}
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
    <title>Sistem za upravljanje bibliotekom | Obnavljanje sifre </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert(" Sifre se ne podudaraju  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>
<body>
    <!------footer-->
<?php include('includes/header.php');?>
<!-- kraj footer-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">Obnavljanje sifre korisnika:</h4>
</div>
</div>
             
<!--Panel za prijavu-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 Forma za prijavu
</div>
<div class="panel-body">
<form role="form" name="chngpwd" method="post" onSubmit="return valid();">

<div class="form-group">
<label> Unesite email adresu </label>
<input class="form-control" type="email" name="email" required autocomplete="off" />
</div>

<div class="form-group">
<label> Unesite broj telefona</label>
<input class="form-control" type="text" name="mobile" required autocomplete="off" />
</div>

<div class="form-group">
<label> Sifra </label>
<input class="form-control" type="password" name="newpassword" required autocomplete="off"  />
</div>

<div class="form-group">
<label> Potvrdi sifru </label>
<input class="form-control" type="password" name="confirmpassword" required autocomplete="off"  />
</div>

 <div class="form-group">
<label>Verifikacioni kod : </label>
<input type="text" class="form-control1"  name="vercode" maxlength="5" autocomplete="off" required  style="height:25px;" />&nbsp;<img src="captcha.php">
</div> 

 <button type="submit" name="change" class="btn btn-info">Promjeni sifru </button> | <a href="index.php">Prijava</a>
</form>
 </div>
</div>
</div>
</div>  
<!---Kraj panela za prijavu-->            
             
 
    </div>
    </div>
     <!-- footer -->
 <?php include('includes/footer.php');?>
      <!-- footer kraj-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- javascript  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
