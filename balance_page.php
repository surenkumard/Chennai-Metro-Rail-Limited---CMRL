<?php
    $conn = mysqli_connect('localhost','root','','CMRL');
    if(isset($_POST['submit'])){
        $card = mysqli_escape_string($conn,$_POST['card_no']);
        $select = "SELECT balance FROM travel_card where cardnumber = '$card'";
        $result = mysqli_query($conn,$select);
}
?>
<html>
    <head>
        <title>
            Balance Amount
        </title>
        <style>
            form{
                width: 30%;
                height: 450px;
                margin:75px 15%;
                border-radius: 50px;
                box-shadow: 10px 10px 10px 10px;
                opacity: 0.9;
                border: 1px solid rgb(6, 6, 7);
                background-color: white;
            }
            ul{
                color: rgb(101, 99, 99);
                text-align: justify;
                transform: translateX(-20px);
            }
            span{
                color: rgb(255, 6, 6);
            }
            input[type=number]{
                font-size: 0.9rem;
                font-weight: normal;
                width: 80%;
                border: 3px solid black;
            }
            input[type=number]:hover{
                border: 4px solid green;
            }
            #card, #step{
                margin:20px 20px ;
            }
            label{
                font-size: 1.3rem;
                font-weight: bold;
            }
            input[type=submit]{
                width: 100%;
                border: 1px solid black;
                background-color: rgb(5, 212, 5);
                font-size: 1rem;
            }
            body{
                background-repeat: no-repeat;
                height:460px;
                background-image: url('bg_balancepage.jpg');
                background-size: 100%;
            }
            #result,#error{
                color: green;
                font-size: 1.2rem;
                font-weight: bold;
            }
            #error{
                color: red;
            }
            button a{
                font-size: 1.2rem;
                font-weight: bold;
                color: black;
                text-decoration: none; 
                background-color:gray; 
                padding: 0px 100px;  
            }
            button{
                background-color: grey;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <form action="" method="post">
                <div id="card">
                    <label for="number">Card Number <span>*</span> </label><br><br>
                    <input type="number" id="number" name="card_no"><br>
                </div>

                <?php 
                    if (isset($result)){
                        if (mysqli_num_rows($result) > 0){
                        $row = $result->fetch_assoc();
                        echo "<div id='result'>"."The card Balance is ₹". $row['balance']."</div><br>";
                        }
                    else{
                        echo "<div id='error'>Enter a valid card number</div><br>";
                    }
                }?>
                    <input type="submit" name="submit" value="Cheak Balance"></input><br><br>
                    <button type="button"><a href="home_page.html">Back</a></button>

                <div id="step">
                    <ul>
                        <li>The online recharge fauility is only available for the store Value card and isnot applicable for Trip Card.</li><br>
                        <li>After completion of online payment, visit the Ticket Vending Machine installed at metro stations, insert smart card on TVM, and press the "Webtop up" button on the screen to complete the recharge process.</li><br>
                    </ul>
                </div>
       </form>
       
    </body>
</html>