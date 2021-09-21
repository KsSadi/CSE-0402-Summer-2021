<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html>
<?php include('includes/head.php');?>
<body>
   <!-- Preloader Part Start -->
   <div class="preload-main">
    <div class='preloader'>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- Preloader Part End -->
<!--start body wrap-->
<div id="body-wrap">
    
	<?php include('includes/header.php');?>
	
	
    <!--start hero area-->

    <!--end hero area-->
</br>
</br>
</br>
</br>
    <!--start about area-->
    <section id="about-area" class="bg-gray">
        <div class="container">
            <div class="row">
                <!--start about image-->
                <div class="col-md-6">
                    <div class="about-image">
                        <img src="assets/images/about-img.jpg" class="img-responsive" alt="Image">
                    </div>
                </div>
                <!--end about image-->
                <!--start about content-->
                <div class="col-md-6">
                    <div class="about-content">
					 <div class="col-md-offset-1">
					<div class="contact-content row">
                <div class="section-heading text-center">
                    <h2 class="font-700 text-capitalize">Find <span>Doner</span></h2>
                    <p>SUB Blood Bank</p>
                </div>
				
       
		   <div class="contact-form">
                            <form name="donar" method="post">
                                <div class="form-group row">
									<div class="col-sm-6">
                                        <p>Department</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="department" class="form-control" id="department" >
											<option value="">Select</option>
											<?php department_options() ?>
										</select>
                                    </div>
									<div class="col-sm-6">
                                        <p>Batch </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="batch" id="batch" class="form-control" >
											<option value="">Select</option>
											<?php batch_options() ?>
										</select>
                                    </div>
									<div class="col-sm-6">
                                        <p>Blood Group </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="bloodgroup" class="form-control" required>
<?php $sql = "SELECT * from  tblbloodgroup ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
<?php }} ?>
</select>
                                    </div>
                                </div>
                               
                               
                               <center> <button type="submit" name="submit" >Find Doner</button> </center>
                            </form>
							
							
							
                            <div id="form-messages"></div>
                        </div>
							</div>
							    </div>

                    </div>
                </div>
                <!--end about content-->
            </div>
        </div>
    </section>
    <!--end about area-->
	<!--start team area-->
<section id="team-area">
    <div class="container">
        <div class="row">
          
        </div>
        <div class="owl-carousel">
            <!--start team single-->
              <?php 
if(isset($_POST['submit']))
{
$status=1;
$bloodgroup=$_POST['bloodgroup'];


if(isset($_POST['department']) && $_POST['department'] != '' ){
	$department = $_POST['department'];
	$where_dept = " AND department=:department";
}
if(isset($_POST['batch']) && $_POST['batch'] != ''){
	$batch = $_POST['batch'];
	$where_batch = " AND batch=:batch";
}

$sql = "SELECT * from tblblooddonars where (status=:status and BloodGroup=:bloodgroup) $where_dept $where_batch ";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
if(isset($_POST['department'])  && $_POST['department'] != ''){
	$query->bindParam(':department',$department,PDO::PARAM_STR);
}
if(isset($_POST['batch']) && $_POST['batch'] != ''){
	$query->bindParam(':batch',$batch,PDO::PARAM_STR);
}
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

           	
			<div class="item">
                <div class="team-single text-center">
                    <img src="assets/images/profile.png" class="img-responsive" alt="Image">
                    <div class="team-member-info">
                        <h5 class="font-600 m-0"><?php echo htmlentities($result->FullName);?></h5>
						
					</div>
					
					<div class="team-social-icons" style="text-align:left; margin-left:10px;">
					<?php 
					$view_data = (array) $result;
					//to see available values, uncomment the next line
					//print_r($view_data);
					?>
						<p class="card-text"><b>Blood Group :</b> <?php echo htmlentities($result->BloodGroup);?></p>
						<p class="card-text"><b>Department :</b> <?php echo htmlentities($result->department);?></p>
						<p class="card-text"><b>Batch :</b> <?php echo htmlentities($result->batch);?></p>
						<p class="card-text"><b>  ID :</b> <?php echo htmlentities($result->Age);?></p>
						<p class="card-text"><b>Address :</b>                  
						<?php if($result->Address=="")
						{
						echo htmlentities('N/A');
						} else {
						echo htmlentities($result->Address);
						}
						?></p>
						<p class="card-text">For Mobile Number, call CR: <?php echo htmlentities($result->Message);?></p>
                    </div>                 
				</div>
            <!--end team single-->       
			</div>

            <?php }}
else
{
echo htmlentities("No Record Found");

}


            } ?>
          
	
		
</div>
</section>
<!--end team area-->
<?php include('includes/footer.php');?>


</div>
</div>
<!--end body wrap-->

<?php include('includes/foot.php');?>

<script>
	$(function(){
		$("#batch").chained("#department");
	});
	
	$('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
</body>

</html>
