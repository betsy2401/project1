<?php 

$page_title = 'WordsWorth BookStore - Checkout';
    include('includes/header.html');
	require('mysqli_connect.php');

    include('includes/footer.html');
    $bid = 0;
    $id = 0;
    $bname = "";

    session_start();

    if (isset($_GET['bookid']))
    {
        $bid = intval($_GET['bookid']);   
    }

   
    $qry3 = "SELECT * FROM bookinventory WHERE book_id = ".$bid;
    $r3 = @mysqli_query($dbc, $qry3); 
    $row = mysqli_fetch_array($r3, MYSQLI_ASSOC);

    if (isset($row))
    {
        $bname = $row['book_Name'];

        $_SESSION["orderid"] = $row['book_id'];
        $id = intval($_SESSION["orderid"]);
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];

		if (empty($_POST['firstname']))
        {        
            $fnameError = "Enter First Name!";
            $errors = "Enter First Name!";
        }
        else {
            $fname = $_POST['firstname'];            
        }
        
        if (empty($_POST["lastname"]))
        {        
            $lnameError =  "Enter Last Name!";
            $errors = "Enter Last Name!";
        }
        else {
            $lname = $_POST["lastname"];
        }
        
        if (!isset($_POST["newsletter"])) {
            $radioError =  "Select payment option!";
        }
        else {
            $news = $_POST["newsletter"];
        }
    
        if (empty($_POST["cardnum"]))
        {        
            $cardnumError =  "Enter Card Number!";
            $errors = "Enter Card Number!";
        }
        else {
            $cardnum = $_POST["cardnum"];
        }
    
        if (empty($_POST["cvv"]))
        {        
            $cvvError =  "Enter CVV!";
            $errors = "Enter CVV!";
        }
        else {
            $cvv = $_POST["cvv"];
        }
           
        if (empty($errors)){
            $qry = "INSERT INTO bookinventoryorder (book_id, order_count) VALUES ($bid, '1');";
            $qry2 = "UPDATE bookinventory SET quantity = quantity-1";
            $r1 = @mysqli_query($dbc, $qry);      
            $r2 = @mysqli_query($dbc, $qry2);                   
            echo '<div class="result">Order has been successfully placed.</div>';           
        }
         else {
            echo '<h3 class="error">Please provide the data!</h3>';
        }      

	mysqli_close($dbc);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            padding-left: 100px;
        }

        .error {
            color: red;
        }

        .cart {
            border: 1px solid;
            padding-left: 3px;
            width: 650px;
            border-radius: 7px;
        }

        .result {
            position: absolute;
            bottom: 190px;
            color: green;
            font-size: 18px;
        }

    </style>
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="cart">
            <p style="font-size:20px; background-color:skyblue;">Cart details</p>
            <p><label>Book title: </label>&nbsp; <?php echo $bname ?></p>
            <p><label>Count:</label>&nbsp; 1</p>
        </div>
        <div>
            <br>
            <h3>Please enter the billing & payment details to place the order</h3>
            <br>
        </div>

        <p><label>First Name: <input type="text" name="firstname" size="20" maxlength="40" value="<?php if (isset($fname)) echo $fname; ?>"></label>
            <span class="error"><?php if (isset($fnameError)) echo $fnameError ?></span>
        </p>


        <p><label>Last Name: <input type="text" name="lastname" size="20" maxlength="40" value="<?php if (isset($lname)) echo $lname; ?>"></label>
            <span class="error"><?php if (isset($lnameError)) echo $lnameError ?></span>
        </p>

        <p><label for="newsletter">Payment Mode: </label>
            <input type="radio" name="newsletter" value="Y" <?php if (isset($news) && $news=="Y") echo "checked";?>> Credit Card
            <input type="radio" name="newsletter" value="N" <?php if (isset($news) && $news=="N") echo "checked";?>> Net Banking
            <span class="error"><?php if (isset($radioError)) echo $radioError ?></span>
        </p>
        <p><label>Card #: <input type="text" name="cardnum" size="20" maxlength="16" value="<?php if (isset($cardnum)) echo $cardnum; ?>"></label>
            <span class="error"><?php if (isset($cardnumError)) echo $cardnumError ?></span>
        </p>
        <p><label>CVV: <input type="text" name="cvv" size="20" maxlength="3" value="<?php if (isset($cvv)) echo $cvv; ?>"></label>
            <span class="error"><?php if (isset($cvvError)) echo $cvvError ?></span>
        </p>

        <input type="submit" class="button" id="btnPlaceOrder" value="Place Order" />
    </form>
</body>

</html>
