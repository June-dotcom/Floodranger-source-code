   

  <div class="nav-header">
        <a href="#" class="brand-logo">
            <img class="logo-abbr" src="images/logo.png" alt="">
            <img class="logo-compact" src="images/logo-text.png" alt="">
            <img class="brand-title" src="images/logo-text.png" alt="">
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <?php echo ($section == 'Alerts_hist') ? 'Alert history' : $section; ?>
                            </div>
                        </div>
                        
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span class="text-black"><strong>Cloud admin&nbsp;</strong></span>
                                    </div>
                                    <img src="images/user (4).png" width="10" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">                    
                                    <a href="logout.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>