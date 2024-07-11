<?php
    $conn = mysqli_connect('localhost','root','','CMRL');
    if(isset($_POST['submit'])){
        $card = mysqli_escape_string($conn,$_POST['card']);
        $amount = mysqli_escape_string($conn,$_POST['amount']);
        $debit = mysqli_escape_string($conn,$_POST['debit']);
        $cvc = mysqli_escape_string($conn,$_POST['cvc']);
        $name = mysqli_escape_string($conn,$_POST['name']);

        $select = "SELECT * FROM public where cardnumber = '$card'";

        $result = mysqli_query($conn,$select);
        $row = mysqli_fetch_array($result);
        
        $error = array();
        if(mysqli_num_rows($result) == 0){
            $error[] = "Check Your Card Number";
        }
        else if($debit != $row['debit']){
            $error[] = "Check your Debit Card Number";
        }
        else if($cvc != $row['cvc']){
            $error[] = 'Check your CVC/CVV Number';
        }
        else if($name != $row['name']){
            $error[] = "Check your Name";
        }
        else{
            $newbalance = intval($amount) + intval($row['balance']); 
            $update = "UPDATE public SET balance = $newbalance WHERE cardnumber = '$card'";
            mysqli_query($conn,$update);
            $meg = "Payment Make Successfully";
    }}
?>
<html>
    <head>
        <title>
            Recharge
        </title>
        <style>
            form{
                background: white;
                border: 1px solid black;
                box-shadow:15px 15px 15px 15px gray ;
                line-height: 3rem;
                font-size: 1.2rem;
                font-weight: normal;
                width: 40%;
                margin: 50px auto;
                padding-left: 50px;
            }
            input{
                border: 3px solid black;
            }
            span{
                color: red;
            }
            input[type='submit']{
                padding: 10px 100px;
                display: block;
                margin: auto;
                font-size: 1rem;
                background-color: orangered;
                margin-bottom: 20px;
            }
            h2{
                padding-bottom: 15px;
                border-bottom:4px solid orangered;
            }
            #error{
                color: red;
            }
            label,input{
                margin-left: 40px;
            }
            button{
                padding: 10px 140px;
                display: block;
                margin: auto;
                font-size: 1rem;
                background-color: gray; 
                border: 2px solid black; 
            }
            button a{
                color: black;
                text-decoration: none;
            }
            #meg{
                color: green;
            }
            body{
                background: grey;
            }
        </style>        
    </head>
    <body>
        
        <form action="" method="post">
            <h2>Debit Card</h2>
            <h3 id="error"> 
                <?php if(isset($error)){
                    foreach($error as $er){
                        echo $er;
                    }
                }
             ?>
             </h3>
             <h3 id="meg">
                <?php    
                   if(isset($meg)){
                        echo "$meg";
                     }
                ?>
            </h3>
            <label for="card">Metro Card Number <span>*</span></label><br>
            <input type="number" name="card" id="card"><br>

            <label for="amount">Recharge Amount <span>*</span></label><br>
            <input type="number" name="amount" id="amount"><br>

            <label for="debit">Debit Card Number <span>*</span></label><br>
            <input type="number" name="debit" id="debit" ><br>

            <label for="date">Expiration Date (MM/YY) <span>*</span></label><br>
            <input type="month" name="date" id='date' min="2024"><br>

            <label for="cvc">CVC/CVV <span>*</span></label><br>
            <input type="number" name="cvc" id="cvc" min="0" max="999"><br>

            <label for="name">Card Holder Name <span>*</span></label><br>
            <input type="text" name="name" id="name"><br><br>
            
            <input type="submit" value="Make Payment" name="submit">
            
            <button type="button"><a href="home_page.html">Back</a></button><br>
        </form>
    </body>
</html>
