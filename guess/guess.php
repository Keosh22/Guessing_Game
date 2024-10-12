<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
</head>
<body>
    <h1>Number Guessing Game</h1>
    <?php
    
    session_start();
    $attempt = 0;
    $secret_number = 9;
    $message = "";
    $istrue = true;


        if(!isset($_SESSION['total_attempts'])){
            $_SESSION['total_attempts'] = 0;
        }

        if(!isset($_SESSION['guess_number'])){
            $_SESSION['guess_number'] = 0;
        }
       
        // FORM
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guess_number'])){
            
            // INPUT
            $guess_number = (int)$_POST['guess_number'];

            // + 1 attempt
            $_SESSION['total_attempts']++;

            // // display attempt
            // $attempt = $_SESSION['total_attempts'];

            // guess number
            $_SESSION['number_storage'][] = $guess_number;
            
            // check if input number is match to the secret number 
            if($guess_number === $secret_number){
                $message= "Congrats you won. UWIAN NA!";
                // clear session
                $istrue = false;
                session_destroy();
            } 
            elseif ($_SESSION['total_attempts'] >= 3){
                $message= "Sorry, you have use all attempts. The secret number is 9";
                //header("location: " . $_SERVER["PHP_SELF"]);
                $istrue = false;
                session_destroy();
               // exit;
            
                
            }
            else {
                $message= "Wrong guess";
            }
        }

        
    
    ?>

    <p><?php echo $message;?></p>
    
    
    <form action="" method="POST">
        <?php
            if($istrue){
                ?>
                <p> Total Number of attempts: <?php echo $_SESSION['total_attempts']; ?></p>
                <label>Enter your guest (1-10): </label>
                <input type="number" name="guess_number" required>
                <button name="submit">Submit</button>
                <?php
            }
        ?>

        <!-- <label>Enter your guest (1-10): </label>
        <input type="number" name="guess_number" required>
        <button name="submit">Submit</button> -->
    </form>
</body>
</html>