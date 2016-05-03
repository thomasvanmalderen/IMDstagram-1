<?php
include_once("classes/db.class.php");
if(isSet($_POST['getLastContentId'])) {
    $getLastContentId=$_POST['getLastContentId'];
    $result=mysql_query("select id, content, url from table_name where id <".$getLastContentId." order by id desc limit 10");
    $count=mysql_num_rows($result); if($count>0){
        while($row=mysql_fetch_array($result)) { $id=$row['id']; $message=$row['content']; ?>
            <li> <a href="<?=$row['url']?>.htm"><?php echo $message; ?></a> </li>
        <?php } ?> <a href="#"><div id="load_more_<?php echo $id; ?>" class="more_tab"><div id="<?php echo $id; ?>" class="more_button">Load More Content</div></a>
        </div> <?php } else{ echo "<div class='all_loaded'>No More Content to Load</div>"; } } ?>