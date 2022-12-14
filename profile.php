<!-- Coded By: Raunak Singh
Bannerd ID: B00831843 -->
 
<?php
	require_once "includes/header.php";
	require_once "includes/db.php";
?>
	<main>
        <!-- Alert Message -->
		<?php
			// Message when the profile information is updated successfully
        if(isset($_SESSION['edit-success'])) {
            if ($_SESSION['edit-success'] == 1) {
                echo "<div class=\"container\">";
                echo "<h5 class='center-align blue-text'>Profile information updated successfully!</h5>";
                echo "</div>";
            }
            $_SESSION['edit-success'] = 0;
        }

		?>

        <?php
            if ($_SERVER['QUERY_STRING'] != null) {
                $sql = "SELECT * FROM `login` WHERE `username` = '$_SERVER[QUERY_STRING]'";
            } else {
                $sql = "SELECT * FROM `login` WHERE `id`='$_SESSION[id]'";
            }

            if (isset($dbconnection)) {
                $result = $dbconnection->query($sql);

                $userRecord = $result->fetch_assoc();
                $fullName = $userRecord['firstname'] . " " . $userRecord['lastname'];
                $username = $userRecord['username'];
                $password = $userRecord['password'];
        ?>

        <div class="card light-blue" style="width: 50%; margin: 4% auto" >
            <div class="card-content white-text">
                <h1 class="center-align"><?php echo $fullName?></h1>
                <div class="row container">
                    <div class="input-field col s12">
                        <input disabled value=<?php echo $username?> id="disabled" type="text" class="validate white-text">
                        <label for="disabled" class="white-text">Username </label>
                    </div>
                </div>
                <div class="row container">
                    <div class="input-field col s12">
                        <input disabled value=<?php echo $password?> id="disabled" type="password" class="validate white-text">
                        <label for="disabled" class="white-text">Password </label>
                    </div>
                </div>
            </div>
            

            <?php
                $ID = 0;
                $parts = explode("?", $_SERVER['REQUEST_URI']);
                $partUsername = $parts[0];
                $s = "SELECT * FROM `login` WHERE `username`='$partUsername'";
                $res = $dbconnection->query($s);
                $row = $res->fetch_assoc();
                if (isset($row['id'])) {
                    $ID = $row['id'];
                }


                // The user cannot edit other users profile information
                if ($ID == $_SESSION['id'] || $ID == 0){
                    echo "<div class='center-align'>
                    <i class=\"material-icons white-text\">edit</i>
                    <u><a href=\"edit-profile.php\" class='text-primary large'>Click here to edit profile information</a></u>
                    <br>
                    </div>";
                }
            ?>

            <br>

            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width tabs-transparent">
                    <li class="tab"><a class="active" href="#test4">Followers</a></li>
                    <li class="tab"><a href="#test5">Following</a></li>
                    <li class="tab"><a href="#test6">Blocked</a></li>
                </ul>
            </div>
            
            <div class="card-content blue lighten-5">

                <!-- Displaying users followers list -->
                <div id="test4" class="left-align">
                    <?php 
                        $sql = "SELECT * FROM `follow` WHERE `following_id`='$_SESSION[id]'";
                        if ($ID != 0){
                            $sql = "SELECT * FROM `follow` WHERE `following_id`='$ID'"; 
                        }

                        $result = $dbconnection->query($sql);

                        while ($followerRecord = $result->fetch_assoc()){

                            $idFollower = $followerRecord['follower_id'];

                            $sql2 = "SELECT * FROM `login` WHERE `id`='$idFollower'";

                            $result2 = $dbconnection->query($sql2);
                            while ($followerName = $result2->fetch_assoc()){

                                $fullName = $followerName['firstname'] . " " . $followerName['lastname'];
                                echo "<ul class='collection hoverable z-depth-5' style='margin: 2% 20%; border-radius: 10px'>
                                <li class='collection-item avatar'>
                                <a href='profile.php?$followerName[username]'><i class='material-icons tooltipped circle light-blue hoverable' data-position='left' data-tooltip='Followers:<br>Following:'>person</i></a>
                                <span class='title'>$fullName</span>
                                <hr>
                                <a href='#!' class='secondary-content'>
                                    <i onclick='follow($followerRecord[id])' class='material-icons hoverable' >person</i>
                                    <i onclick='block($followerRecord[id])' class='material-icons hoverable' >block</i>
                                </a>
                                </li>
                                </ul>";
                            }
                        }

                    ?>
                </div>
                
                <!-- Displaying users following list -->
                <div id="test5" class="center-align">
                    <?php 
                        $sql = "SELECT * FROM `follow` WHERE `follower_id`='$_SESSION[id]'";
                        if ($ID != 0){
                            $sql = "SELECT * FROM `follow` WHERE `follower_id`='$ID'";
                        }

                        $result = $dbconnection->query($sql);
                        while ($followingRecord = $result->fetch_assoc()){
                            $idFollowing = $followingRecord['following_id'];

                            $sql2 = "SELECT * FROM `login` WHERE `id`='$idFollowing'";

                            $result2 = $dbconnection->query($sql2);
                            while ($followingName = $result2->fetch_assoc()){
                                $fullName = $followingName['firstname'] . " " . $followingName['lastname'];

                                echo "<ul class='collection hoverable z-depth-5' style='margin: 2% 20%; border-radius: 10px'>
                                <li class='collection-item avatar'>
                                <a href='profile.php?$followingName[username]'><i class='material-icons tooltipped circle light-blue hoverable' data-position='left' data-tooltip='Followers:<br>Following:'>person</i></a>
                                <span class='title'>$fullName</span>
                                <hr>
                                <a href='#!' class='secondary-content'>
                                    <i onclick='block($followingName[id])' class='material-icons hoverable' >block</i>
                                </a>
                                </li>
                                </ul>";
                            }

                        }

                    ?>
                </div>
                
                <!-- Displaying blocked users -->
                <div id="test6" class="right-align">
                    <?php 
                        $sql = "SELECT * FROM `block` WHERE `blocker_id`='$_SESSION[id]'";
                        if ($ID != 0){
                            $sql = "SELECT * FROM `block` WHERE `blocker_id`='$ID'";
                        }

                        $result = $dbconnection->query($sql);
                        while ($blockingRecord = $result->fetch_assoc()) {
                            $idBlock = $blockingRecord['blocking_id'];

                            $sql2 = "SELECT * FROM `login` WHERE `id`='$idBlock'";

                            $result2 = $dbconnection->query($sql2);
                            while ($blockedName = $result2->fetch_assoc()) {
                                $fullName = $blockedName['firstname'] . " " . $blockedName['lastname'];

                                echo "<ul class='collection hoverable z-depth-5' style='margin: 2% 20%; border-radius: 10px'>
                                <li class='collection-item avatar'>
                                <a href='profile.php?$blockedName[username]'><i class='material-icons tooltipped circle
                                 light-blue hoverable' data-position='left' data-tooltip='Followers:<br>Following:'>person</i></a>
                                <span class='title'>$fullName</span>
                                <hr>
                                </li>
                                </ul>";
                            }
                        }
                    ?>
                </div>
            </div>
		</main>

<?php
}
	require_once "includes/footer.php";
?>
