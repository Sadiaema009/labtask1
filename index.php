<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$fnameErr=$lnameErr=$emailErr=$ageErr=$designationErr=$passErr=$languageErr="";
$fname=$lname=$age=$designation=$language=$email=$password="";
$alphas= array_merge(range('a','z'),range('A','Z'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //first name validation
    if (empty($_POST["fname"])) {
      $fnameErr = "First Name is required";
    } 
    else{
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z\s\-]/",$fname)) {
            $fnameErr = "Only alphabets are allowed";
            $fname="";
        }
    }
    //last name validation
    if (empty($_POST["lname"])) {
        $lnameErr = "Last Name is required";
    } 
    else{
        $lname = test_input($_POST["lname"]);
            if (!preg_match("/^[a-zA-Z\s\-]/",$lname)) {
                $lnameErr = "Only alphabets are allowed";
                $lname="";
            }
    }
    //email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    }
    else{
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    } 

    //age validation
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } 
    else {
        $age = test_input($_POST["age"]);
    }

    //designation validation
    if (empty($_POST["designation"])) {
        $designationErr = "Designation is required";
    } 
    else {
        echo "Designation: ";
        foreach($_POST["designation"] as $d){
            echo $d;
        }
    }
    //language validation
    if (empty($_POST["language"])) {
        $languageErr = "Please select at least one language";
    } 
    else {
        echo "Language: ";
        foreach($_POST["language"] as $language){
            echo $language;
        }
    }
    //password validation
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
    } 
    else {
        $password = test_input($_POST["password"]);
        if(strlen($password)<8){
            $passErr="password should be at least 8 characters";
            $password="";
        }
    }



}

function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

?>

<h2>Php form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 First Name: <input type="text" name="fname">
 <span class="error">*<?php echo $fnameErr;?></span>
 <br><br>
 Last Name: <input type="text" name="lname">
 <span class="error">*<?php echo $lnameErr;?></span>
 <br><br>
 Age: <input type="text" name="age">
 <span class="error">*<?php echo $ageErr;?></span>
 <br><br>
 Designation:
<input type="checkbox" name="designation[]" value="JuniorProgrammer">
<label for="JuniorProgrammer"> Junior Programmer</label><br>
<input type="checkbox" name="designation[]" value="SeniorProgrammer">
<label for="SeniorProgrammer"> Senior Programmer</label><br>
<input type="checkbox" name="designation[]" value="TeamLead">
<label for="TeamLead">Team Lead</label><br>
<span class="error">*<?php echo $designationErr;?></span>
 <br><br>
 Preffered Language:
<input type="checkbox" name="language[]" value="Java">
<label for="Java">Java</label><br>
<input type="checkbox" name="language[]" value="PHP">
<label for="PHP">PHP</label><br>
<input type="checkbox" name="language[]" value="C#">
<label for="C#">C#</label><br>
<span class="error">*<?php echo $languageErr;?></span>
 <br><br>
 Email: <input type="text" name="email">
 <span class="error">*<?php echo $emailErr;?></span>
 <br><br>
 Password: <input type="password" name="password">
 <span class="error">*<?php echo $passErr;?></span>
 <br><br>

 <input type="submit" name="submit" value="submit"><br>


</form>

<?php
echo "First name :$fname";
echo "Last name : $lname";
echo "Email : $email";
echo "Age : $age";

?>


</body>
</html>