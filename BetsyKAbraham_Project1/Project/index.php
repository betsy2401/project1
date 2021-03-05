<?php

$page_title = 'WordsWorth BookStore - Welcome';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	header("Location: store.php");
}
?>

<style>
    body {
        background-color: lightgoldenrodyellow;
    }

</style>
<div class="page-header">
    <h1>Welcome to WordsWorth BookStore</h1>
</div>
<h4><i>"A reader lives a thousand lives before he dies." - George R.R Martin</i></h4>
<br>
<form action="store.php" method="post">
    <br>
    <p><input type="submit" name="submit" value="Explore Collections"></p>
</form>

<?php

include('includes/footer.html');
?>
