<nav id="nav">
    <div id="centernav">
    <a href="index.php" id="logo-top">IMDstagram</a>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" placeholder="Search" id="search">
        <input type="hidden" name="action" value="zoeken">
        <div id="profile"><a href="profile.php" ><?php echo $_SESSION['username']; ?></a></div>

    </form>

    </div>
</nav>
