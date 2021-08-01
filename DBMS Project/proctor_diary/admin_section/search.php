<?php include('partials/menu.php');?>
<div class="main-content">

    <div class="wrapper">
        <h1>
            search 
        </h1>
        <form action="<?php echo SITEURL;?>student-search.php?proctor_id=<?php echo $proctor_id;?>" method="POST" class="fff">
            <input type="search" name="search" placeholder="search for student">
            <input type="submit" name="submit" class="btn-primary" >
        </form>
    </div>
</div>
<?php include('partials/footer.php');?>