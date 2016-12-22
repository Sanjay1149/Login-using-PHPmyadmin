<!DOCTYPE HTML>  
<html>
    <head>
        <title>SIGN UP PAGE</title>
        <style>
            .error 
                {
                    color: #008CBA;
                }
            .span
            {
                border: 2px solid black;
                margin: 0px;
                padding: 40px;
                
            }
            .heading
            {
                text-align: center;
                color: grey;
                
            }
            .button1
          {
                background-color: #008CBA; 
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                padding-right: 50px;
                position: relative;
                left:35%;
          }
             a
          {
              text-decoration: none;
              color: white;
          }
        </style>
    </head>
    <body>
         <?php
        $username = "root";
        $password = "";
        $servername = "localhost";
        $dbname = "first_database";

        $conn = mysqli_connect($servername,$username,$password,$dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        
        $name = $pass = $phone = "";
        $nameErr = $passErr = $phoneErr = "";
        $count =0;
        
         if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
              if(empty($_POST["username"]))
            {
                $nameErr = "Name is required";
            }
            else
            {
                $name = test_input($_POST["username"]);
                $count ++;
             }
             
             if(empty($_POST["password"]))
            {
                $passErr = "Password is required";
            }
            else
            {
                $pass = test_input($_POST["password"]);
                $count ++;
             }
             
              if(empty($_POST["phone"]))
            {
                $phoneErr = "Phone number is required";
            }
            else
            {
                $phone = test_input($_POST["phone"]);
                $count ++;
             }
             
             if($count==3)
             {
                 $query = "INSERT INTO user(Username , Password , Phone ) VALUES ('$name','$pass','$phone')";
                 $result = mysqli_query($conn,$query);
                 
                 $count = 0;
             }
         }
        
        function test_input($data)
        {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        ?>
        
     <div class="span">
            <p class="heading"><b><i>SIGN UP PAGE FOR SANJAY</i></b></p>
            <p><span class="error">* required field.</span></p><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            User Name : <input type="text" name="username" value="<?php echo $name;?>">
            <span class="error">*<?php echo $nameErr;?></span>
            <br><br>
            Password : <input type="password" name="password" value="<?php echo $pass;?>">
            <span class="error">*<?php echo $passErr;?></span>
            <br><br>
            Phone No : <input type="text" name="phone" value="<?php echo $phone;?>">
                <span class="error">*<?php echo $phoneErr;?></span>
            <br><br>
                <button type="submit" name="submit" class="button1"><a href="http://localhost/New_login.php">Submit</a></button>
            </form>
    </div>
      
    </body>
</html>