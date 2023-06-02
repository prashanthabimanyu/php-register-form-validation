<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Sing up</h1>
    <?php
$firstnameErr =$lastnameErr= $emailErr = $mobilenoErr =$jobroleErr= $genderErr = $passwordErr = $confirmpasswordErr=$checkboxErr = "";  
$firstname = $lastname = $email =$mobileno=$jobrole=$gender=$password=$confirmpassword=$checkbox=""; 
  $errors =[$firstnameErr =$lastnameErr= $emailErr = $mobilenoErr =$jobroleErr= $genderErr = $passwordErr = $confirmpasswordErr=$checkboxErr];
//Input fields validation  
if (isset($_POST['submit'])) {  
      
//String Validation  
    if (empty($_POST["firstname"])) {  
         $firstnameErr = "*firstname is required";  
    }
    else if($firstname > 4){
        $firstnameErr ="*First should be in 4 character";
       }
     else {  
        $firstname = input_data($_POST["firstname"]);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {  
                $firstnameErr = "*Only alphabets and white space are allowed";  
            }  
           
    }  
    if (empty($_POST["lastname"])) {  
        $lastnameErr = "*lastname is required";  
   } 
   else  if($lastname > 4){
    $lastnameErr ="*last should be in 4 character";
   }
   else {  
       $lastname = input_data($_POST["lastname"]);  
           // check if name only contains letters and whitespace  
           if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {  
               $lastnameErr = "*Only alphabets and white space are allowed";  
           }  
          
   }  
      
    //Email Validation   
    if (empty($_POST["email"])) {  
            $emailErr = "*Email is required";  
    } else {  
            $email = input_data($_POST["email"]);  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                $emailErr = "*Invalid email format";  
            }  
     }  
    
    //Number Validation  
    if (empty($_POST["mobileno"])) {  
            $mobilenoErr = "*Mobile no is required";  
    } else  if (strlen ($mobileno) > 10) {  
        $mobilenoErr = "*Mobile no must contain 10 digits.";  
        }  
    else {  
            $mobileno = input_data($_POST["mobileno"]);  
            if (!preg_match ("/^[0-9]*$/", $mobileno) ) {  
            $mobilenoErr = "*Only numeric value is allowed.";  
            }  
        
    }  
    if(empty($_POST["jobrole"])){
        $jobroleErr="*Job Role Must be Selected";
    }else{
        $jobrole = input_data($_POST["jobrole"]);
    }
      
    //Empty Field Validation  
    if (empty ($_POST["gender"])) {  
            $genderErr = "*Gender is required";  
    } else {  
            $gender = input_data($_POST["gender"]);  
    }  
    //password and confirm password
    $passwordhash=password_hash($password,PASSWORD_DEFAULT);
    if(empty($_POST["password"])){
        $passwordErr ="*Please enter your password";
    }else{
        $password = input_data($_POST["password"]);
        if (strlen ($password) < 8) {  
            $passwordErr = "*password must contain 8 digits.";  
            }  
       
    }
    if(empty($_POST['confirmpassword'])){
        $confirmpasswordErr="*please enter confirm password";
    }else{
      $confirmpassword = input_data($_POST["confirmpassword"]);
    if($password!==$confirmpassword){
        $confirmpasswordErr="*password and confirm password are miss matching";
    }
}
  
    //Checkbox Validation  
    if (!isset($_POST['checkbox'])){  
            $checkboxErr = "*Accept terms of services before submit.";  
    } else {  
            $checkbox = input_data($_POST["checkbox"]);  
    }  

    // database connection  
        require_once "database.php";
        $sql="INSERT INTO users(FirstName, LastName, Email, MobileNumber, JobRole, Gender, Password)VALUES(?,?,?,?,?,?,?)";
      $stmt  = mysqli_stmt_init($conn);
     $preparestmt = mysqli_stmt_prepare($stmt,$sql);
     if($preparestmt){
        mysqli_stmt_bind_param($stmt,"sssssss",$firstname,$lastname,$email,$mobileno,$jobrole,$gender,$password,);
        mysqli_stmt_execute($stmt);
        // echo " <div class='alter alert-success'> Register successfully</div>";
     }
     else{
        die("somethings wrong!");
     }


}  
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
//   $data = htmlspecialchars($data);  
  return $data;  
}  
?>
    <form method="post" action="singup.php" class=" g-3 border border-success p-2 text-aligin-center mb-2 border-opacity-25 mt-4 " id="form"><br>
  <div class="col-md-3">
    <label  class="form-label">First name</label>
    <input type="text" class="form-control" name="firstname">
    <span class="error"><?php echo $firstnameErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
    <label class="form-label">Last name</label>
    <input type="text" class="form-control" name="lastname">
    <span class="error"><?php echo $lastnameErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
    <label class="form-label">Email</label>
      <input type="text" class="form-control" name="email">
      <span class="error"><?php echo $emailErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
    <label class="form-label">Mobile</label>
    <input type="text" class="form-control" name="mobileno" >
    <span class="error"><?php echo $mobilenoErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
    <label  class="form-label">Job Role</label>
    <select class="form-select" name="jobrole">
      <option selected disabled value="">Choose...</option>
      <option>Full stack developer</option>
      <option>Frontend Developer</option>
      <option>Backend Developer</option>
      <option>Ui/Ux</option>
      <option>Designer</option>
      <option>Video Editer</option>
    </select>
    <span class="error"> <?php echo $jobroleErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
  <label  class="form-label">Gender</label><br>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender">
  <label class="form-check-label" for="inlineRadio1">Male</label>
  </div>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender" >
  <label class="form-check-label" for="inlineRadio1">Female</label>
  </div>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender">
  <label class="form-check-label" for="inlineRadio1">Others</label>
</div>
<span class="error"> <?php echo $genderErr; ?> </span>  

</div><br>
<div class="col-md-3">
    <label class="form-label">Password</label>
    <input type="text" class="form-control" name="password" >
    <span class="error"> <?php echo $passwordErr; ?> </span>  

  </div><br>
  <div class="col-md-3">
    <label class="form-label">Confirm Password</label>
    <input type="text" class="form-control" name="confirmpassword" >
    <span class="error"><?php echo $confirmpasswordErr; ?> </span>  

  </div><br>
  <div class="col-3 mt-4" id="we">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="checkbox" value="">
      <label class="form-check-label">
        Agree to terms and conditions
      </label>
    </div>
    <span class="error"> <?php echo $checkboxErr; ?> </span>  

  </div><br>
  <div class="col-3 mt-4" id="we">
    <button class="btn btn-primary " name="submit" type="submit">Submit form</button>
  </div>
</form>
</body>

</html>
