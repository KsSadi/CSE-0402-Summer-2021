<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
  {
$name=$_POST['fullname'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$message=$_POST['message'];
$sql="INSERT INTO  tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Messege Sent. We will contact you shortly";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="zxx">
<?php include('includes/head.php');?>

<div id="body-wrap">
    
	<?php include('includes/header.php');?>
	
	
   
<!--start contact area-->
<section id="contact-area">
    <div class="container">
        <div class="row">
            <!--start section heading-->
            <div class="col-md-8 col-md-offset-2">
                <div class="section-heading text-center">
                    <h2 class="font-700 text-capitalize">GET IN <span>TOUCH</span></h2>
                    <p> <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong style="color:green;">SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?></p>
                </div>
            </div>
            <!--end section heading-->
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="contact-content row">
                    <!--start contact form-->
                    <div class="col-sm-8">
                        <div class="contact-form">
                            <form name="sentMessage"  method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="name" name="fullname" placeholder="Name*" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="phone" name="contactno" placeholder="Phone*" required>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email*">
                                    </div>
                                </div>
								
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" cols="30" rows="10" id="message" name="message" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <button type="submit" name="send" >Submit</button>
                            </form>
                            <div id="form-messages"></div>
                        </div>
                    </div>
                    <!--end contact form-->

                    <!--start contact info-->
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <!--start contact info single-->
                            <div class="contact-info-single">
                                <h6 class="font-600"><span><i class="icon-envelope"></i></span> Our Email :</h6>
                                <p>info@sub.edu.bd <br> blood@sub.edu.bd</p>
                            </div>
                            <!--end contact info single-->
                            <!--start contact info single-->
                            <div class="contact-info-single">
                                <h6 class="font-600"><span><i class="icon-phone"></i></span> Our Phone :</h6>
                                <p>+0880 1235 636363 <br> +0880 3322 585858 </p>
                            </div>
                            <!--end contact info single-->
                            <!--start contact info single-->
                            <div class="contact-info-single">
                                <h6 class="font-600"><span><i class="icon-map"></i></span> Our Address :</h6>
                                <p>Shat Masjid Road <br>Dhanmondi,Dhaka</p>
                            </div>
                            <!--end contact info single-->
                        </div>
                    </div>
                    <!--end contact info-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--end contact area-->
	<?php include('includes/footer.php');?>
<!--end footer-->
</div>
<!--end body wrap-->
<?php include('includes/foot.php');?>
</body>

</html>
