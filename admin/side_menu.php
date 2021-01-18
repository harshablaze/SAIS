      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if($cur_page=='students') echo 'class="active"'; ?>>
                        <a href="students.php"><i class="fa fa-fw fa-user"></i> Students</a>
                    </li>		
					<li  <?php if($cur_page=='ebooks') echo 'class="active"'; ?> >
						<a href="ebooks.php"><i class="fa fa-fw  fa-cloud-upload"></i> E-books</a>
                    </li>
					<li  <?php if($cur_page=='notifications') echo 'class="active"'; ?> >
						<a href="notifications.php"><i class="glyphicon glyphicon-alert"></i> Notifications</a>
                    </li>
					<!--<li <?php //if($cur_page=='attendance') echo 'class="active"'; ?> >
                        <a href="attendance.php"><i class="fa fa-fw  fa-file-code-o"></i> Attendance</a>
                    </li>    -->                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>