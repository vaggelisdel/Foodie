<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-success">10</span>
            </a>
            <ul class="dropdown-menu">
                <li class="header">Έχετε 10 ειδοποιήσεις</li>
                <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                        <li><!-- start notification -->
                            <a href="#">
                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                        </li>
                        <!-- end notification -->
                    </ul>
                </li>
                <li class="footer"><a href="#">Προβολή όλων</a></li>
            </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../../images/user_logo.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= $user['Name'].' '.$user['Surname']?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                    <img src="../../images/user_logo.png" class="img-circle" alt="User Image">

                    <p>
                        <?= $user['Name'].' '.$user['Surname']?>
                        <small>Μέλος από: <?= date("d-m-Y",strtotime($user['RegisterBy']))?></small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-right">
                        <a href="../login/logout.php" class="btn btn-default btn-flat">Αποσύνδεση</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>