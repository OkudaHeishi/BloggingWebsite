<!-- Coded By: Raunak Singh
Bannerd ID: B00831843 -->

<?php
	require_once "includes/header.php";
	require_once "includes/db.php";
?>
	<main>
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

        <div class="row" style="width: 40%; margin: 5% auto">
            <div class="col s12">
                <div class="card light-blue s12 z-depth-5 hoverable" style="border-radius: 10px" >
                    <div class="card-content white-text">
                        <span class="card-title center-align">Edit Your Profile</span>
                        <div class="input-field s12">
                            <form id="post" method="post" action="includes/process_edit.php">
                                <div class="container">
                                    <label class="white-text">First Name</label>
                                    <input placeholder="First name" class="validate white-text" name="firstname" value="<?php echo $userRecord['firstname'] ?>" > 
                                </div>

                                <div class="container">
                                    <label class="white-text">Last Name</label>
                                    <input placeholder="Last name" class="validate white-text" name="lastname" value="<?php echo $userRecord['lastname'] ?>">
                                </div>

                                <div class="container">
                                    <label class="white-text">Username</label>
                                    <input placeholder="Username" class="validate white-text" name="username" value="<?php echo $username ?>">
                                </div>

                                <div class="container">
                                    <label class="white-text">Password</label>
                                    <input placeholder="Password" type="password" class="validate white-text" name="password" value="<?php echo $password ?>">
                                </div>

                                <br>
                                                                
                                <div id="submit" style="width: 18%; margin: auto">
                                    <button class="btn waves-effect waves-light white blue-text" type="submit" name="action" style="margin-top: 2%">U P D A T E
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

	</main>

<?php
}
	require_once "includes/footer.php";
?>
