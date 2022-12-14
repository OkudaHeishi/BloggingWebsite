<?php
// Code by Emre Kuru B00837309
require_once "includes/db.php";
require_once "includes/header.php";

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>


<div class="row" style="width: 40%; margin: 12% auto">
    <div class="col s12">
        <?php
        if ($_SERVER['QUERY_STRING'] == "pswd") {
            echo '<p style="color:red; text-align: center">Username or Password is incorrect</p>';

        } else if ($_SERVER['QUERY_STRING'] == "register") {
            echo '<p style="color:blue; text-align: center">Registered Successfully</p>';
        }
        ?>
        <div class="card light-blue s12 z-depth-5 hoverable" style="border-radius: 10px" >
            <div class="card-content white-text">
                <span class="card-title center-align">Login</span>
                <div class="input-field s12">
                    <form id="post" method="post" action="includes/process_login.php">
                        <input placeholder="Username" class="validate white-text" name="username" >
                        <input placeholder="Password" type="password" class="validate white-text" name="password">
                        <div id="submit" style="width: 15%; margin: auto">
                            <button class="btn waves-effect waves-light white blue-text" type="submit" name="action" style="margin-top: 2%">Login
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="divider white"></div>
                <div id="submit" style="width: 18%; margin: 2% auto">
                    <button class="btn waves-effect waves-light white blue-text" onclick="window.location.href='register.php'" style="margin-top: 2%">register
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


