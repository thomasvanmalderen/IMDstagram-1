<nav>
    <a href="index.php">IMDstagram</a>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" placeholder="Search">
        <input type="hidden" name="action" value="zoeken">
        <button type="submit"><img src="images/search-icon.png" alt="Search"></button>
    </form>
    <a href="profile.php"><?php echo $_SESSION['username']; ?></a>
    <a href="logout.php">Log out</a>
</nav>