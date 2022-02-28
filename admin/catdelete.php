<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $cat = new category();
    if(!isset($_GET['delid']) || $_GET['delid'] == NULL){
        echo "<script>windown.location = 'catlist.php'</script>";
        
    }else{
        $id = $_GET['delid'];
        $deleteCat = $cat -> delete_category($id);
    }
   

?>