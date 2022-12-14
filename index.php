<?php
// Code by Emre Kuru B00837309
    require "includes/header.php";
    require_once "includes/db.php";
?>

<body>
    <?php

    echo '<form id="post" method="post" action="includes/process-tweep.php" hidden>
            <div class="row" style="width: 50%; margin: 4% auto">
                <div class="col s12">
                    <div class="card light-blue s12" style="border-radius: 10px" >
                        <div class="card-content white-text">
                            <span class="card-title center-align">Post a Tweep</span>
                            <div class="input-field s12">
                                <input id="icon_telephone" type="tel" class="validate white-text" 
                                name="textarea" style="width: 82%">
                                <label for="icon_telephone" class="white-text">Text area</label>
                                <button class="btn waves-effect waves-light white blue-text" type="submit" 
                                name="action" style="float: right; margin-top: 2%">Submit
                                <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>';

    if(isset($_SESSION['id'])) {

         if($_SERVER['QUERY_STRING'] == "tweep_deleted") {
            echo "<div class='container'>
                  <h5 class='center-align blue-text'>Tweep Deleted Successfully!</h5>
                  </div>";
            
        }



        echo '<section id = "results" class="space-above-below">';

        //Following database retirval by Kaushik Dhamodaran (B00855259)
        /*This code to implement blog data retrieval, display and search has been used with
        some modification from my submission for Assignment 2 by Kaushik Dhamodaran in CSCI 2170 (Winter 2021).
        Kaushik Dhamodaran,Assignment2: CSCI 2170 (Winter 2021), Faculty of Computer Science, Dalhousie University.
        Available online on Gitlab at [URL]:
        https://git.cs.dal.ca/courses/2021-winter/csci-2170/a2/dhamodaran/-/blob/master/A2/index.php.Date
        accessed: 18/03/21.*/

            if (isset($_GET['search'])) {
                $sql = "SELECT * FROM `tweeps` WHERE `post_content` LIKE '%" . $_GET['search'] . "%' OR `author` LIKE '%"
                    . $_GET['search'] . "%' ";

            } else {
                $sql = "SELECT * FROM `tweeps`";
            }


            if (isset($dbconnection)) {
                //Code written by Hesham Elokdah to query following accounts and blockers
                $queryID=$_SESSION['id'];
                $sql2 = "SELECT `blocker_id` FROM `block` WHERE `blocking_id`= '$queryID'";
                $sql3 = "SELECT `following_id` FROM `follow` WHERE `follower_id`= '$queryID'";

                $result = $dbconnection->query($sql);
                $result2 = $dbconnection->query($sql2);
                $result3 = $dbconnection->query($sql3);

                $blockings = array();
                $followings = array();
                //saving followings IDs in array
                $i=0;
                while($fetch = $result3->fetch_assoc()){
                    $followings[$i]=$fetch['following_id'];
                    $i++;
                    }

                //saving blockers IDs in array
                $i=0;
                while($fetch = $result2->fetch_assoc()){
                    $blockings[$i]=$fetch['blocker_id'];
                    $i++;
                }

                if (isset($result)) {
                    while ($row = $result->fetch_assoc()) {
                        if($row['author_id']==$_SESSION['id'] ||
                            (!in_array($row['author_id'], $blockings ,false) && in_array($row['author_id'],
                                $followings ,false))){
                            echo "<ul class='collection hoverable z-depth-5' style='margin: 2% 20%; border-radius: 10px'>
                                    <li class='collection-item avatar'>
                                          <a href='profile.php?$row[username]'><i class='material-icons tooltipped circle
                                           light-blue hoverable' data-position='left' data-tooltip='Followers:
                                           <br>Following:'>person</i></a>
                                          <span class='title'>$row[author]</span>
                                          <p>Posted by $row[author] on $row[post_date]</p>
                                          <hr>
                                          <p>$row[post_content]</p>
                                          <p id=$row[id]> Likes: $row[likes]</p>
                                          <p> Shares: $row[shared]</p>
                                          <a href='tweep.php?id=$row[id]' role='button''>More details &raquo;</a>
                                          <a href='#!' class='secondary-content'>
                                            <i onclick='addLike($row[id])' class='material-icons hoverable'>thumb_up</i>
                                          </a>
                                        </li>
                                      </ul>";

                        }
                    }
                }

                //End of results
                echo "<div position='flex' align='center'>";
                echo '<br><h5 style="color:#37B6B3;">
                    Follow more users to see more tweeps</h5>';
                echo "</div>";
            }
        echo '</section>';

    } else {
        header("Location: login.php");
    }

    ?>

</body>

<?php
    require "includes/footer.php";
?>

