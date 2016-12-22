<!DOCTYPE HTML>  
<html>
    <head>
        <title>LOG IN PAGE</title>
        <style>
            .error 
                {
                    color: #FF0000;
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
             .button2
          {
                background-color: #f44336; 
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                padding-right: 50px;
                position:relative;
                left:45%;

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
        
        $name = $pass = "";
        $nameErr = $passErr = "";
        $count = 0;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if(empty($_POST["username"]))
            {
                $nameErr = "Name is required";
            }
            else
            {
                $name = test_input($_POST["username"]);
                $query = "SELECT Username  FROM user";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result)>0)
                {
                    while($row = mysqli_fetch_assoc($result))
                        {
                            $use = $row['Username'];
                            if($use==$name)
                            {
                              $count++;
                            }
                        }
                    if($count==0)
                    {
                        $nameErr = "Enter a Valid User name";
                        $name = " ";
                    }
                }
                     
            }
            if(empty($_POST["password"]))
            {
                $passErr = "A password is required";
            }
            else
            {
                 $pass = test_input($_POST["password"]);
                $query = "SELECT Password FROM user WHERE Username = '$name' ";
                $result = mysqli_query($conn,$query);
                
                if(mysqli_num_rows($result)>0)
                {
                    while($row = mysqli_fetch_assoc($result))
                        {
                            $pa = $row['Password'];
                            if($pa == $pass)
                                {
                                    $count++;
                                }
                             if($count!=2)
                             {
                                 $passErr = "Enter a Valid password for the account ";
                                 $pass = "";
                             }
                             else
                             {
                                 $count=0;
                                 echo '<script language="javascript">';
                                 echo 'alert("Logging In into Sanjay")';
                                 echo '</script>';
                                 if(isset($_POST['submit']))
                                   {
                                    header('Location: http://www.facebook.com');
                                   }
                             }
                        }
                    
                }
                
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
            <p class="heading"><b><i>LOGIN PAGE OF SANJAY</i></b></p>
            <p><span class="error">* required field.</span></p><br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            User Name : <input type="text" name="username" value="<?php echo $name;?>">
            <span class="error">*<?php echo $nameErr;?></span>
            <br><br>
            Password : <input type="password" name="password" value="<?php echo $pass;?>">
            <span class="error">*<?php echo $passErr;?></span>
            <br><br>
            <input type="submit" name="submit" class="button2">
            </form>
        </div>
      

     </body>
</html>