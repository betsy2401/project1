<?php

    $page_title = 'WordsWorth BookStore - Collections';   
    include('includes/header.html');
    require('mysqli_connect.php');

    session_start();
    
   
    echo '<h1>The books available for purchase are:</h1>';

    $q1 = "SELECT * FROM bookinventory 
           INNER JOIN author ON author.author_id = bookinventory.book_AuthorID 
           INNER JOIN genre ON genre.genre_id = bookinventory.book_GenreID 
           ORDER BY book_name";
    $r1 = @mysqli_query ($dbc, $q1);
    $tot = mysqli_num_rows($r1);

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            margin-top: 50px;
            font-family: sans-serif;
        }

        th {
            background-color: darkcyan;
            font-size: 18px;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .cartDiv {
            padding-left: 980px;
            font-weight: bold;
            font-size: 18px;
            color: darkblue;
        }

    </style>
</head>

<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php 
        if ($tot > 0) {

        echo '<table>
        <thead>
        <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Price</th>            
        </tr>
        </thead>
        <tbody>';

            while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {                            
            echo '<tr>
                  <td> <a href="checkout.php?bookid='.$row['book_id'].'">' . $row['book_Name'] . '</a></td><td>' . $row['firstname'] . ' ' .$row['lastname'] .'</td><td>' .$row['genre_name']. '</td><td>'. '$' .$row['price']. '</td>               
                  </tr>
            ';
        }

        echo '</tbody></table>'; 

        mysqli_free_result ($r1); 
        } 
        else { 
            echo '<p class="error">There are no books in the DB</p>';
        }

        mysqli_close($dbc);
        echo '<br><br><br>   
        Please click on the book title to checkout
        ';
        include('includes/footer.html');
            ?>
    </form>

</body>

</html>
