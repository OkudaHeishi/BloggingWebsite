<?php
	require "includes/header.php";
    require_once "includes/db.php";

    //Implemented by Sabiha Khan - B00842047

 /**
 * This code to implement the displaying of individual posts in more detail has been used with some modification from my submission for Assignment 3 in CSCI 2170 (Winter 2021).
 * Sabiha Khan,Assignment 3: CSCI 2170 (Winter 2021), Faculty of Computer Science, Dalhousie University.
 * Available online on Gitlab at [URL]: https://git.cs.dal.ca/courses/2021-winter/csci-2170/a2/sabiha.
 * Date accessed: April 4, 2021.
 * */
    
    
    $tweeps_id = $_GET['id'];

    $query = "SELECT * FROM `tweeps` WHERE `id` = '$tweeps_id' ";
    $query2 = "SELECT `admin` FROM `login` WHERE `id` = '$_SESSION[id]'";
    $sql = $dbconnection->query($query);
    $result = $dbconnection->query($query2);


    if (!$sql) {
        die("Error in executing the query: ($dbconnection->errno) $dbconnection->error<br>SQL = $query");
    }

    else{
        foreach($sql as $row){

?>
<main>
    <div class="py-5 text-center container">
        <div  style="margin:10% ;" >
        <?php echo "
            <a href='profile.php?$row[username]'><i style ='font-size: 5em'class='material-icons tooltipped circle light-blue hoverable' data-position='left' data-tooltip='Followers:<br>Following:'>person</i></a>
        
            <span style = 'font-size: 2em; margin-bottom: 20px;' class='title'>$row[author]</span>
            <p>Posted by $row[author] on $row[post_date]</p>
            <hr>
            <p>$row[post_content]</p>
            <p id=$row[id]> Likes: $row[likes]</p>
            <p> Shares: $row[shared]</p>
            <a href='#!' class='secondary-content'><i onclick='addLike($row[id])' class='material-icons hoverable'>thumb_up</i></a>
            <a href ='includes/process_share.php?id=$row[id]' role='button' class='btn btn-primary' style='background-color:#08A0E9; border:none; width: 12%;'>share</a>";

            //Delete function only used by admins.
            foreach($result as $row2){
                if($row2['admin'] == "yes"){
                    echo "
                        <a href='includes/process_delete.php?id=$row[id]' role='button' class='btn btn-primary' style='background-color:#08A0E9; border:none; width: 12%;'>Delete</a>";
                    break;
                    }
                }
            }
        }
          ?>
        </div>
    </div>

</main>

<?php
    require "includes/footer.php";
?>