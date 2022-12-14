<?php
    require "includes/header.php";
    require_once "includes/db.php";
    /**
     * Implemented by Hesham Elokdah B00843961
     */
?>

<body>
    <div id="test4" class="left-align">
    <?php

        if (isset($_GET['search'])) {
            $sql = "SELECT * FROM `login` WHERE `id`!='$_SESSION[id]' AND `username` LIKE '%" . $_GET['search'] . "%'";
        } else {
            $sql = "SELECT * FROM `login` WHERE `id`!='$_SESSION[id]'";
        }

        if (isset($dbconnection)) {
            if($result = $dbconnection->query($sql)){
                while ($user = $result->fetch_assoc()){
                    echo "<ul class='collection hoverable z-depth-5' style='margin: 2% 30%; border-radius: 10px'>
                    <li class='collection-item avatar'>
                    <a href='profile.php?$user[username]'><i class='material-icons tooltipped circle light-blue hoverable' data-position='left' data-tooltip='Followers:<br>Following:'>person</i></a>
                    <span class='title'>$user[username]</span>
                    <a href='#!' class='secondary-content'>
                        <i onclick='follow($user[id])' class='material-icons hoverable' >person</i>
                        <i onclick='block($user[id])' class='material-icons hoverable' >block</i>
                    </a>
                    </li>
                    </ul>";
                }
            }
            
        }
    ?>

</body>

<?php
    require "includes/footer.php";
?>

