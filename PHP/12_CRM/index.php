<?php include 'functions.php'?>
<? $page = $_GET['page'] ?? 'home'; ?>

<?php include 'inc/header.php'?>
<?php include 'views/'.$page.'.php'?>
<?php include 'inc/footer.php'?>