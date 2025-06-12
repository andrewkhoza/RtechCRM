<?php
$user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
$userInfo = \app\models\UserInfo::findOne(['id' => Yii::$app->user->id]);
    
?>
<div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                            

                        <?php if(Yii::$app->user->identity->role == 10){ ?>

                            <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/admin/dashboard">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Admin Dashboard </span>
                                </a>
                            </li>                         
                            <li>
                                <a  href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                    <span data-key="t-dashboard">Accounts</span>
                                </a>
                                
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/managers-index" key="t-admin-admin">Managers </a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/technicians-index" key="t-admin-administration">Technicians </a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/front-desk-index" key="t-admin-operations">Front Desk </a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/sales-index" key="t-admin-operations">Sales</a></li>
                                </ul>
                            </li>    
                             <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/admin/admin-create">
                                    <i data-feather="user"></i>
                                    <span data-key="t-dashboard">Add User </span>
                                </a>
                            </li>  
                            <li>
                                <a href="<?= \Yii::$app->request->baseUrl ?>/write-off/index">
                                    <i data-feather="alert-triangle"></i>
                                    <span data-key="t-written-off">Written Off</span>
                                </a>
                            </li>  
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-dashboard">Profile Settings </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/admin-profile" key="t-admin-admin">Profile</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/change-password" key="t-admin-admin">Reset Password </a></li>
                                </ul>
                            </li>                                               
                        <?php }else if(Yii::$app->user->identity->role == 20){ ?>
                            <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/managers/dashboard">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Manager Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a  href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                    <span data-key="t-dashboard">Accounts</span>
                                </a>
                                
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/managers/technicians-index" key="t-admin-administration">Technicians </a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/managers/front-desk-index" key="t-admin-operations">Front Desk </a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/managers/sales-index" key="t-admin-operations">Sales</a></li>
                                </ul>
                            </li> 
                            <li>
                                <a href="<?= \Yii::$app->request->baseUrl ?>/write-off/index">
                                    <i data-feather="alert-triangle"></i>
                                    <span data-key="t-written-off">Written Off</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-dashboard">Profile Settings </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/user/profile" key="t-admin-admin">Profile</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/user/change-password" key="t-admin-admin">Reset Password </a></li>
                                </ul>
                            </li>                            

                        <?php }else if(Yii::$app->user->identity->role == 30){ ?>
                            <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/technicians/dashboard">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Technician Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="book-open"></i>
                                <span data-key="t-dashboard">Device Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/technicians/diagnosis" key="t-admin-admin">Diagnosis</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/technicians/quoted" key="t-admin-admin">Quoted</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/technicians/approved" key="t-admin-admin">Approved/Under Repairs</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/technicians/awaiting-parts" key="t-admin-admin">Awaiting Parts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= \Yii::$app->request->baseUrl ?>/write-off/index">
                                    <i data-feather="alert-triangle"></i>
                                    <span data-key="t-written-off">Written Off</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-dashboard">Profile Settings </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/user/profile" key="t-admin-admin">Profile</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/change-password" key="t-admin-admin">Reset Password </a></li>
                                </ul>
                            </li>                            
                        <?php }else if(Yii::$app->user->identity->role == 40){ ?>
                            <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/front-desk/dashboard">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Front Desk Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="book-open"></i>
                                <span data-key="t-dashboard">Device Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="<?= \Yii::$app->request->baseurl ?>/front-desk/booking-device" key="t-admin-admin">Book a device</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/front-desk/diagnosis" key="t-admin-admin">Diagnosis</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/front-desk/quoted" key="t-admin-admin">Quoted</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/front-desk/approved" key="t-admin-admin">Approved/Under Repairs</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/front-desk/awaiting-parts" key="t-admin-admin">Awaiting Parts</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/device-ready/ready-index" key="t-admin-admin">Ready for Collection</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= \Yii::$app->request->baseUrl ?>/write-off/index">
                                    <i data-feather="alert-triangle"></i>
                                    <span data-key="t-written-off">Written Off</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-dashboard">Profile Settings </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/user/profile" key="t-admin-admin">Profile</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/change-password" key="t-admin-admin">Reset Password </a></li>
                                </ul>
                            </li>                            
                        <?php }else if(Yii::$app->user->identity->role == 50){ ?>
                            <li>
                                <a href="<?= \Yii::$app->request->baseurl ?>/sales/index">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Sales Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-dashboard">Profile Settings </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/user/profile" key="t-admin-admin">Profile</a></li>
                                    <li><a href="<?= \Yii::$app->request->baseurl ?>/admin/change-password" key="t-admin-admin">Reset Password </a></li>
                                </ul>
                            </li>  
                        <?php }?>                        
                        <li>
                            <a href="<?= \Yii::$app->request->baseurl ?>/site/logout">
                                <i data-feather="log-out"></i>
                                <span data-key="t-logout">Logout </span>
                            </a>
                        </li>
                        

                    </ul>

                    <!--div class="card sidebar-alert shadow-none text-center mx-4 mb-0 mt-5">
                        <div class="card-body">
                            <img src="<?= \Yii::$app->request->baseurl ?>/images/admin/giftbox.png" alt="">
                            <div class="mt-4">
                                <h5 class="alertcard-title font-size-16"><?php echo 'Unlimited_Access' ?> </h5>
                                <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.
                                </p>
                                <a href="#!" class="btn btn-primary mt-2"><?php echo 'Upgrade_Now' ?> </a>
                            </div>
                        </div>
                    </div-->
                </div>
                
            </div>
        </div>