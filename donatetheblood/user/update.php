<?php 
include ('include/header.php');


if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    // Fetch donor data
    

    // Error messages
    // $nameError = $genderError = $termError = '';

    if (isset($_POST['submit'])) { // Check if form is submitted
        // Name validation
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            if (preg_match('/^[A-Za-z ]+$/', $_POST['name'])) {
                $name = $_POST['name'];
            } else {
                $nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Only letters and spaces are allowed.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $nameError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please fill the name field.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Gender validation
        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $gender = $_POST['gender'];
        } else {
            $genderError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Select your gender.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Date of birth validation
        if (isset($_POST['day']) && !empty($_POST['day'])) {
            $day = $_POST['day'];
        } else {
            $dayError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please select day input.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        if (isset($_POST['month']) && !empty($_POST['month'])) {
            $month = $_POST['month'];
        } else {
            $monthError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please select month input.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        if (isset($_POST['year']) && !empty($_POST['year'])) {
            $year = $_POST['year'];
        } else {
            $yearError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please select year input.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Blood group validation
        if (isset($_POST['blood_group']) && !empty($_POST['blood_group'])) {
            $blood_group = $_POST['blood_group'];
        } else {
            $blood_groupError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Select your blood group.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // City validation
        if (isset($_POST['city']) && !empty($_POST['city'])) {
            if (preg_match('/^[A-Za-z ]+$/', $_POST['city'])) {
                $city = $_POST['city'];
            } else {
                $cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Only letters and spaces are allowed.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $cityError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please fill the city.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Contact number validation
        if (isset($_POST['contact_no']) && !empty($_POST['contact_no'])) {
            if (preg_match('/\d{10}/', $_POST['contact_no'])) {
                $contact_no = $_POST['contact_no'];
            } else {
                $contact_noError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Contact should consist of 10 characters.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $contact_noError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please fill contact field.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Email validation
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $pattern = '/^[_a-z0-9-]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (preg_match($pattern, $_POST['email'])) {
                $Check_email = $_POST['email'];
                $sql = "SELECT email FROM donor WHERE email='$Check_email'";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Sorry, this email already exists.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $email = $_POST['email'];
                }
            } else {
                $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please enter a valid email address.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        } else {
            $emailError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please fill email field.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // Insert data into database
        if (isset($name) && isset($blood_group) && isset($gender) && isset($day) && isset($month) && isset($year) && isset($email) && isset($contact_no) && isset($city)) {
            $DonorDOB = $year . "-" . $month . "-" . $day;
            $sql = "UPDATE donor SET name='$name', gender='$gender', email='$email', city='$city', dob='$DonorDOB', contact_no='$contact_no', blood_group='$blood_group' WHERE id=" . $_SESSION['user_id'];

            if (mysqli_query($connection, $sql)) {
                 $updateSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data update successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';


                ?>

                    <script>
                        function myfunction()
                        {
                            location.reload();
                        }
                    </script>

                <?php
            } else {
                $updateError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data not updated, try again.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }

$sql = "SELECT * FROM donor WHERE id=" . $_SESSION['user_id'];
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           $userID = $row['id']; 
            $name = $row['name'];
            $blood_group = $row['blood_group'];
            $gender = $row['gender'];
            $email = $row['email'];
            $contact_no = $row['contact_no'];
            $city = $row['city'];
            $dob = $row['dob'];
            $dbPassword = $row['password'];

            // Separating value based on "-"
            $date = explode("-", $dob);
        }
    }

}
        
        // // Password update handling
        // if (isset($_POST['update'])) {
        //     if (isset($_POST['old_password']) && !empty($_POST['old_password']) && 
        //         isset($_POST['new_password']) && !empty($_POST['new_password']) &&
        //         isset($_POST['c_password']) && !empty($_POST['c_password']) ){

        //         $oldpassword = md5($_POST['old_password']);
        //         if ($oldpassword == $dbPassword) {
        //             if (strlen($_POST['new_password']) >= 6) {
        //                 if ($_POST['new_password'] == $_POST['c_password']) {
        //                     $password = $_POST['new_password'];
        //                     // Update password in the database
        //                     $sql = "UPDATE donor SET password='$password' WHERE id=" . $_SESSION['user_id'];
        //                     mysqli_query($connection, $sql);
        //                 } else {
        //                     $PasswordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //                         <strong>Passwords do not match.</strong>
        //                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                             <span aria-hidden="true">&times;</span>
        //                         </button>
        //                     </div>';
        //                 }
        //             } else {
        //                 $PasswordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //                     <strong>The password should consist of at least 6 characters.</strong>
        //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                         <span aria-hidden="true">&times;</span>
        //                     </button>
        //                 </div>';
        //             }
        //         } else {
        //             $PasswordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //                 <strong>Please enter a valid password.</strong>
        //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                     <span aria-hidden="true">&times;</span>
        //                 </button>
        //             </div>';
        //         }
        //     } else {
        //         $PasswordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //             <strong>Please fill in all password fields.</strong>
        //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                 <span aria-hidden="true">&times;</span>
        //             </button>
        //         </div>';
        //     }
        // }

        // if(isset($password))
        // {
        //     $sql = "UPDATE donor SET password='$password' WHERE id='$userID' ";

        //     if(mysqli_query($connection,$sql))
        //     {
        //         $updatePasswordSuccess = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //         <strong>Password update successfully</strong>
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //         </button>
        //     </div>';
        //         ?>

        //             <script>
        //                 function myfunction()
        //                 {
        //                     location.reload();
        //                 }
        //             </script>

        //         <?php 

        //     }
        //     else
        //     {
        //          $passwordError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //         <strong>Data not inserted try again.</strong>
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //         </button>
        //     </div>';
        //     }
        // }
    

    if(isset($_POST['delete_account']))
    {

        if(isset($_POST['account_password']) && !empty($_POST['account_password']))
        {
        
            $showForm ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Are you sure to delete your record?</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form target="" method="post">
                <br>
                <input type="hidden" name="userID" value="'.$_SESSION['user_id'].'">
                <button type="submit" name="updateSave" class="btn btn-danger">Yes</button>

                <button type="button" class="btn btn-info" data-dismiss="alert">
                <span aria-hidden="true">Oops! No </span>
                </button>      
            </form>
            </div>';
        }
        else
        {
         $deleteAccountError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Please enter your password</strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>';
        }
     }   
    
  if(isset($_POST['userID']))
        {
            $userID = $_POST['userID'];

            $sql = "DELETE FROM donor WHERE id=".$userID;

            if(mysqli_query($connection,$sql))
            {
                header("Location: logout.php");
            }
            else
            {
                 $deletesubmitError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Account not deleted.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            }
        }


    include ('include/sidebar.php');
?>

<style>
    .form-group {
        text-align: left;
    }
    .form-container {
        padding: 20px 10px 20px 30px;
    }
</style>

<div class="container" style="padding: 60px 0;">
    <div class="row">
        <div class="card col-md-6 offset-md-3">
            <div class="panel panel-default" style="padding: 20px;">
                <!-- Error Messages -->    
                <?php 
                    if(isset($showForm)) echo $showForm;
                    if(isset($deletesubmitError)) echo $deletesubmitError;
                    if(isset($updateError)) echo $updateError; 
                    if(isset($updateSuccess)) echo $updateSuccess;
                ?>

                <form class="form-group" action="" method="post">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" name="name" id="fullname" placeholder="Full Name" required pattern="[A-Za-z/\s]+" title="Only lower and upper case and space" class="form-control" value="<?php if (isset($name)) echo $name; ?>">
                        <?php if (isset($nameError)) echo $nameError; ?>
                    </div><!--full name-->
                    <div class="form-group">
                        <label for="name">Blood Group</label><br>
                        <select class="form-control demo-default" id="blood_group" name="blood_group" required>
                            <option value="">---Select Your Blood Group---</option>
                            <?php if (isset($blood_group)) echo '<option selected="" value="'.$blood_group.'">'.$blood_group.'</option>'; ?>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <?php if (isset($blood_groupError)) echo $blood_groupError; ?>
                    </div><!--End form-group-->
                    <div class="form-group">
                        <label for="gender">Gender</label><br>
                        Male<input type="radio" name="gender" id="gender" value="Male" style="margin-left:10px; margin-right:10px;" <?php if (isset($gender) && $gender == "Male") echo "checked"; ?>>
                        Female<input type="radio" name="gender" id="gender" value="Female" style="margin-left:10px;" <?php if (isset($gender) && $gender == "Female") echo "checked"; ?>>
                        <?php if (isset($genderError)) echo $genderError; ?>
                    </div><!--gender-->
                    <div class="form-inline">
                        <label for="name">Date of Birth</label><br>
                        <select class="form-control demo-default" id="date" name="day" style="margin-bottom:10px;" required>
                            <option value="">---Date---</option>
                            <?php if (isset($date[2])) echo '<option selected="" value="'.$date[2].'">'.$date[2].'</option>'; ?>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                            <?php endfor; ?>
                        </select>
                        <select class="form-control demo-default" name="month" id="month" style="margin-bottom:10px;" required>
                            <option value="">---Month---</option>
                            <?php if (isset($date[1])) echo '<option selected="" value="'.$date[1].'">'.$date[1].'</option>'; ?>
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo date("F", mktime(0, 0, 0, $i, 1)); ?></option>
                            <?php endfor; ?>
                        </select>
                        <select class="form-control demo-default" id="year" name="year" style="margin-bottom:10px;" required>
                            <option value="">---Year---</option>
                            <?php if (isset($date[0])) echo '<option selected="" value="'.$date[0].'">'.$date[0].'</option>'; ?>
                            <?php for ($i = 1950; $i <= date("Y"); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div><!--End form-group-->
                    <?php if (isset($dayError)) echo $dayError; ?>
                    <?php if (isset($monthError)) echo $monthError; ?>
                    <?php if (isset($yearError)) echo $yearError; ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please write correct email" class="form-control" value="<?php if (isset($email)) echo $email; ?>">
                        <?php if (isset($emailError)) echo $emailError; ?>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact No</label>
                        <input type="text" name="contact_no" placeholder="03********" class="form-control" required pattern="^\d{10}$" title="10 numeric characters only" maxlength="10" value="<?php if (isset($contact_no)) echo $contact_no; ?>">
                        <?php if (isset($contact_noError)) echo $contact_noError; ?>
                    </div><!--End form-group-->
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control demo-default" required>
                            <option value="">-- Select --</option>
                            <?php if (isset($city)) echo '<option selected="" value="'.$city.'">'.$city.'</option>'; ?>
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
                        <?php if (isset($cityError)) echo $cityError; ?>
                    </div><!--city end-->
                    <div class="form-group">
                        <button id="submit" name="submit" type="submit" class="btn btn-lg btn-danger center-aligned" style="margin-top: 20px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
<!-- 
        <div class="card col-md-6 offset-md-3">
            
            <div class="panel panel-default" style="padding: 20px;">
                <form action="" method="post" class="form-group form-container">
                    <?php if (isset($PasswordError)) echo $PasswordError; 
                            if(isset($updatePasswordSuccess)) echo $updatePasswordSuccess;
                    ?>
                    <div class="form-group">
                        <label for="oldpassword">Current Password</label>
                        <input type="password" required name="old_password" placeholder="Current Password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="newpassword">New Password</label>
                        <input type="password" required name="new_password" placeholder="New Password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="c_password">Confirm Password</label>
                        <input type="password" required name="c_password" placeholder="Confirm Password" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-danger center-aligned" type="submit" name="update">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div> -->

        <div class="card col-md-6 offset-md-3">
            <?php if(isset($deleteAccountError)) echo $deleteAccountError;
                  
            ?>
            <div class="panel panel-default" style="padding: 20px;">
                <!-- Delete Account Form -->
                <form action="" method="post" class="form-group form-container">
                    <div class="form-group">
                        <label for="oldpassword">Password</label>
                        <input type="password" required name="account_password" placeholder="Password" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-danger center-aligned" type="submit" name="delete_account">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php
} else {
    header("Location: ../index.php");
}

include 'include/footer.php';
?>