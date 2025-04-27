<?php 

	//include header file
	include ('include/header.php');

?>
<style>
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;

	}
	.loader{
		display:none;
		width:69px;
		height:89px;
		position:absolute;
		top:25%;
		left:50%;
		padding:2px;
		z-index: 1;
	}
	.loader .fa{
		color: #e74c3c;
		font-size: 52px !important;
	}
	.form-group{
		text-align: left;
	}
	h1{
		color: white;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	span{
		display: block;
	}
	.name{
		color: #e74c3c;
		font-size: 22px;
		font-weight: 700;
	}
	.donors_data{
		background-color: white;
		border-radius: 5px;
		margin: 25px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		padding: 20px 10px 20px 30px;
	}
</style>
<div class="container-fluid red-background size">
	<div class="row">
		<div class="ccol-md-6 offset-md-3">
			<h1 class="text-center">Search Donors</h1>
			<hr class="white-bar">
			<br>
			<div class="form-inline text-center" style="padding: 40px 0px 0px 5px;">
							<div class="form-group text-center center-aligned">
								<select style="width: 220px; height: 45px;" name="city" id="city" class="form-control demo-default" required>
	
	<option value="">-- Select --</option>
<optgroup title="Indian States" label="&raquo; Indian States"></optgroup>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
<optgroup title="Union Territories" label="&raquo; Union Territories"></optgroup>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Delhi">Delhi</option>
<option value="Puducherry">Puducherry</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Ladakh">Ladakh</option>
</select>
							</div>
							<div class="form-group center-aligned">
								<select name="blood_group" id="blood_group" style="padding: 0 20px; width: 220px; height: 45px;" class="form-control demo-default text-center margin10px">

									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
 
								</select>
							</div>
							<div class="form-group center-aligned">
								<button type="button" class="btn btn-lg btn-default" id="search">Search</button>
							</div>
						</div>
		</div>
	</div>
</div>
<div class="container" style="padding: 60px 0 60px 0;">
	<div class="row " id="data">

		<!-- Display The Search Result -->

<?php 
 
	// require('include/config.php');

	if (!empty($_GET['city']) && !empty($_GET['blood_group'])) 
	{
		$city = $_GET['city'];
		$blood_group = $_GET['blood_group'];
	
		// SQL Query
		$sql = "SELECT * FROM donor WHERE city='$city' AND blood_group='$blood_group'";
	

    	$result = mysqli_query($connection,$sql);

    	if(mysqli_num_rows($result)>0)
    	{
    		while ($row = mysqli_fetch_assoc($result)) 
    		{
    		   if($row['save_life_date'] == '0')
    		   {
    		   		echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
    		   		      <span class="name">'.$row['name'].'</span>
    		   		      <span>'.$row['city'].'</span>
    		   		      <span>'.$row['blood_group'].'</span>
    		   		      <span>'.$row['gender'].'</span>
    		   		      <span>'.$row['email'].'</span>
    		   		      <span>'.$row['contact_no'].'</span>
    		   		      </div>' ;
    		   }
    		   else
    		   {
    		   		echo '<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
    		   		      <span class="name">'.$row['name'].'</span>
    		   		      <span>'.$row['city'].'</span>
    		   		      <span>'.$row['blood_group'].'</span>
    		   		      <span>'.$row['gender'].'</span>
    		   		      <h4 class="name text-center">Donated</h4>
    		   		      </div>' ;
    		   		      
    		   }
    		}
    	}
    	else
    	{
    		echo '<div class="alert alert-success alert-dismissible fade show" 			 role="alert">
  				   <strong>Data not found</strong>
  				   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			   <span aria-hidden="true">&times;</span>
  			    </button>
				   </div>' ;
    	}
	}

?>

</div>
</div>
<div class="loader" id="wait">
	<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
</div>
<?php 

	//include footer file
	include ('include/footer.php');

?>
//ajax
<script type="text/javascript">
	$(function () {
		// body...

		$("#search").on('click',function(){

			var city =$("#city").val();
			var blood_group =$("#blood_group").val();

			$.ajax({
				      type: 'GET',
				      url : 'ajaxsearch.php',
				      data : {city:city,blood_group,blood_group},
				      success:function(data){

				      	if(!data.error){
				      		$("#data").html(data);
				      	}
				      }
			})
		});
	});

</script>