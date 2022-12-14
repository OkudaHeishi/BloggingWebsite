<?php
// Code by Emre Kuru B00837309
require_once "includes/db.php";
require_once "includes/header.php";

?>


<div class="row" style="width: 40%; margin: 12% auto">
    <div class="col s12">
        <div class="card light-blue s12 z-depth-5 hoverable" style="border-radius: 10px" >
            <div class="card-content white-text">
                <span class="card-title center-align">Register</span>
                <div class="input-field s12">
                    <form id="post" method="post" action="includes/process_register.php">
                        <input placeholder="First name" class="validate white-text" name="firstname" >
                        <input placeholder="Last name" class="validate white-text" name="lastname">
                        <input placeholder="Username" class="validate white-text" name="username" >
                        <input placeholder="Password" type="password" class="validate white-text" name="password">
                        <div id="submit" style="width: 18%; margin: auto">
                            <button class="btn waves-effect waves-light white blue-text" type="submit" name="action" style="margin-top: 2%">register
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="divider white"></div>
                <div id="submit" style="width: 15%; margin: 2% auto">
                    <button class="btn waves-effect waves-light white blue-text" onclick="window.location.href='login.php'" style="margin-top: 2%">login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
