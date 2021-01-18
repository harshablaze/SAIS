      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if($cur_page=='profile') echo 'class="active"'; ?>>
                        <a href="dashboard.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
					<li <?php if($cur_page=='marklists') echo 'class="active"'; ?> >
                        <a href="marklists.php"><i class="fa fa-fw fa-file-text-o"></i> Mark Lists</a>
                    </li>
					<li <?php if($cur_page=='attendance') echo 'class="active"'; ?> >
                        <a href="attendance.php"><i class="fa fa-fw  fa-file-code-o"></i> Attendance</a>
                    </li>
					<li <?php if($cur_page=='fee') echo 'class="active"'; ?> >
                        <a href="fee_details.php"><i class="fa fa-fw  fa-users"></i> Fee details</a>
                    </li>
					<li  <?php if($cur_page=='certificate') echo 'class="active"'; ?> >
                        <a href="certificates.php"><i class="fa fa-fw  fa-cloud-upload"></i> E-books</a>
                    </li>
					<li  <?php if($cur_page=='employee_notification') echo 'class="active"'; ?> >
                        <a href="employee_notification.php"><i class="glyphicon glyphicon-alert"></i> Notifications</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>