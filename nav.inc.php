<?php

    if(!empty($_POST)) {
        if (!empty($_POST["zoeken"]) == "search") {
            $_SESSION['search'] = $_POST['search'];
            header('Location: search.php');
        }
    }

?>

<nav id="nav">
    <div id="centernav">
    <a href="index.php" id="logo-top">IMDstagram</a>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="search" placeholder="Search" id="search">
        <input type="hidden" name="zoeken" value="search" placeholder="zoeken">
        <div id="profile"><a href="profile.php" ><?php echo $_SESSION['username']; ?></a></div>
    </form>
    </div>
</nav>
