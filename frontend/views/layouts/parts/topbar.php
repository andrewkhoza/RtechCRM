 <header id="page-topbar">
     <div class="navbar-header">
         <div class="d-flex">
             <!-- LOGO -->
             <div class="navbar-brand-box">
                 <a href="<?= \Yii::$app->request->baseurl ?>/" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/title-favicon.png" alt="" height="30">
                     </span>
                     <span class="logo-lg">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/Primary-Logo-Black.png" alt="" height="65">
                     </span>
                 </a>

                 <a href="<?= \Yii::$app->request->baseurl ?>/" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/title-favicon.png" alt="" height="30">
                     </span>
                     <span class="logo-lg">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/rtech-logo-1.png" alt="" height="65">
                     </span>
                 </a>
             </div>

             <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                 <i class="fa fa-fw fa-bars"></i>
             </button>

             <!--form class="app-search d-none d-lg-block">
                 <div class="position-relative">
                     <input type="text" class="form-control" placeholder="Search...">
                     <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                 </div>
             </form-->
         </div>

         <div class="d-flex">

             <!--div class="dropdown d-inline-block d-lg-none ms-2">
                 <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i data-feather="search" class="icon-lg"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                     <form class="p-3">
                         <div class="form-group m-0">
                             <div class="input-group">
                                 <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                 <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div-->

             <!--div class="dropdown d-inline-block language-switch">
                 <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="header-lang-img" src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/us.jpg" alt="Header Language" height="16">
                 </button>
                 <div class="dropdown-menu dropdown-menu-end">

                     <a href="?lang=en" class="dropdown-item notify-item language" data-lang="eng">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                     </a>
                     <a href="?lang=es" class="dropdown-item notify-item language" data-lang="sp">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                     </a>

                     <a href="?lang=de" class="dropdown-item notify-item language" data-lang="gr">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                     </a>

                     <a href="?lang=it" class="dropdown-item notify-item language" data-lang="it">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                     </a>

                     <a href="?lang=ru" class="dropdown-item notify-item language" data-lang="ru">
                         <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                     </a>
                 </div>
             </div-->

             <!--div class="dropdown d-none d-sm-inline-block">
                 <button type="button" class="btn header-item" id="mode-setting-btn">
                     <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                     <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                 </button>
             </div-->

             <!--div class="dropdown d-none d-lg-inline-block ms-1">
                 <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i data-feather="grid" class="icon-lg"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <div class="p-2">
                         <div class="row g-0">
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/github.png" alt="Github">
                                     <span><?php //echo $language['GitHub'] ?></span>
                                 </a>
                             </div>
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/bitbucket.png" alt="bitbucket">
                                     <span><?php //echo $language['Bitbucket'] ?></span>
                                 </a>
                             </div>
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/dribbble.png" alt="dribbble">
                                     <span><?php //echo $language['Dribbble'] ?></span>
                                 </a>
                             </div>
                         </div>

                         <div class="row g-0">
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/dropbox.png" alt="dropbox">
                                     <span><?php //echo $language['Dropbox'] ?></span>
                                 </a>
                             </div>
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/mail_chimp.png" alt="mail_chimp">
                                     <span><?php //echo $language['Mail Chimp'] ?></span>
                                 </a>
                             </div>
                             <div class="col">
                                 <a class="dropdown-icon-item" href="#">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/brands/slack.png" alt="slack">
                                     <span><?php //echo $language['Slack'] ?></span>
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div-->

             <!--div class="dropdown d-inline-block">
                 <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i data-feather="bell" class="icon-lg"></i>
                     <span class="badge bg-danger rounded-pill">5</span>
                 </button>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                     <div class="p-3">
                         <div class="row align-items-center">
                             <div class="col">
                                 <h6 class="m-0"> Notifications <?php //echo $language['Notifications'] ?> </h6>
                             </div>
                             <div class="col-auto">
                                 <a href="#!" class="small text-reset text-decoration-underline">
                                     Unread <?php //echo $language['Unread'] ?>(3)</a>
                             </div>
                         </div>
                     </div>
                     <div data-simplebar style="max-height: 230px;">
                         <a href="#!" class="text-reset notification-item">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                 </div>
                                 <div class="flex-grow-1">
                                     <h6 class="mb-1">My Name <?php //echo $language['James_Lemire'] ?> </h6>
                                     <div class="font-size-13 text-muted">
                                         <p class="mb-1">It_will_seem_like_simplified_English <?php //echo $language['It_will_seem_like_simplified_English'] ?>.</p>
                                         <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1
                                            1 hour ago <?php //echo $language['hour_ago'] ?> </span></p>
                                     </div>
                                 </div>
                             </div>
                         </a>
                         <a href="#!" class="text-reset notification-item">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 avatar-sm me-3">
                                     <span class="avatar-title bg-primary rounded-circle font-size-16">
                                         <i class="bx bx-cart"></i>
                                     </span>
                                 </div>
                                 <div class="flex-grow-1">
                                     <h6 class="mb-1">Your_order_is_placed <?php //echo $language['Your_order_is_placed'] ?> </h6>
                                     <div class="font-size-13 text-muted">
                                         <p class="mb-1">If_several_languages_coalesce_the_grammar <?php //echo $language['If_several_languages_coalesce_the_grammar'] ?> </p>
                                         <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3
                                            1 hour ago <?php //echo $language['min_ago'] ?> </span></p>
                                     </div>
                                 </div>
                             </div>
                         </a>
                         <a href="#!" class="text-reset notification-item">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 avatar-sm me-3">
                                     <span class="avatar-title bg-success rounded-circle font-size-16">
                                         <i class="bx bx-badge-check"></i>
                                     </span>
                                 </div>
                                 <div class="flex-grow-1">
                                     <h6 class="mb-1">Your_item_is_shipped <?php //echo $language['Your_item_is_shipped'] ?> </h6>
                                     <div class="font-size-13 text-muted">
                                         <p class="mb-1">If_several_languages_coalesce_the_grammar <?php //echo $language['If_several_languages_coalesce_the_grammar'] ?> </p>
                                         <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3
                                            1 hour ago <?php //echo $language['min_ago'] ?> </span></p>
                                     </div>
                                 </div>
                             </div>
                         </a>

                         <a href="#!" class="text-reset notification-item">
                             <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                     <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                 </div>
                                 <div class="flex-grow-1">
                                     <h6 class="mb-1">Salena_Layfield <?php //echo $language['Salena_Layfield'] ?> </h6>
                                     <div class="font-size-13 text-muted">
                                         <p class="mb-1">
                                             As_a_skeptical_Cambridge_friend_of_mine_occidental <?php //echo $language['As_a_skeptical_Cambridge_friend_of_mine_occidental'] ?>. </p>
                                         <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1
                                            1 hour ago <?php //echo $language['min_ago'] ?> </span></p>
                                     </div>
                                 </div>
                             </div>
                         </a>
                     </div>
                     <div class="p-2 border-top d-grid">
                         <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                             <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View_More <?php //echo $language['View_More'] ?>... </span>
                         </a>
                     </div>
                 </div>
             </div-->

             <!--div class="dropdown d-inline-block">
                 <button type="button" class="btn header-item right-bar-toggle me-2">
                     <i data-feather="settings" class="icon-lg"></i>
                 </button>
             </div-->

             <!--div class="dropdown d-inline-block">
                 <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <div class="rounded-circle header-profile-user user-profile-image d-xl-inline-block" style="height: 30px;width: 30px;">
                         <i class="fa fa-user"></i>
                     </div>
                     <!--<img class="rounded-circle header-profile-user user-profile-image" src="<?= \Yii::$app->request->baseurl ?>/images/admin/users/avatar-1.jpg" alt="Header Avatar" id="user_image">-->
                     <!--span class="d-none d-xl-inline-block ms-1 fw-medium setting_user_name" id="setting_user_name">Paul
                         K.</span->
                     <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-end">
                     <a class="dropdown-item" href="apps-contacts-profile.php"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                     <a class="dropdown-item" href="auth-lock-screen.php"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="<?= \Yii::$app->request->baseurl ?>/site/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                 </div>
             </div-->

         </div>
     </div>
 </header>