<!doctype html>
<html  lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>Admin End</title>
<link rel="icon" href="./images/titanvault.jpeg" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="./admin_assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="./admin_assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="./admin_assets/plugins/fullcalendar/fullcalendar.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="./admin_assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="./images/titanvault.jpeg" width="48" height="48" alt="uto"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

            
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a><img src="./images/titanvault.jpeg" width="25" alt="uto"><span class="m-l-10">Bulls</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image"><img src="./images/titanvault.jpeg" alt=""></a>
                    <div class="detail">
                        <h4>BullsTrades</h4>
                        <small>Super Admin</small>                        
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>

<section class="content">
    <div class="body_scroll">
        <div class="block-header mb-3">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Admin Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(120, 120, 120);">NxtEvnt-Trades</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row">

                <div class="input-group mb-8 container-fluid" style="margin-bottom: 10px; ">

                    <textarea type="text" class="form-control" placeholder="message" style="width: 100%; border:2px solid grey;" id="writeUp" required></textarea>
                    <br>
                    <input type="email" class="form-control" placeholder="Users Email" id="Uemail" required>

                    <input type="text" class="form-control" placeholder="Subject" id="emailSub" required>

                    <input type="submit" class="btn btn-success"  id="writeUpSend" onclick="sendMail()" value="Send" />

                </div>
                
                <span id="lamb" style="margin: auto;"></span>
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <h4 class="m-t-10">'.$customerName.'</h4>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-muted">'.$bitcoinWalletAddress.'</p>
                                    <p class="text-muted">'.$email.'</p>

                                 
                                   <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Total Balance" id="'.$user_id.'_valueInput" value="'.$accountBalance.'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeBalance('.$user_id.')">change balance</a></span>
                                        </div>
                                        <div id = "resultPlace_'.$user_id.'"></div>

                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Total Deposit" id="'.$user_id.'_TotalDeposit_valueInput" value="'.$total_deposit.'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeTotalDeposit('.$user_id.')">change total deposit</a></span>
                                        </div>
                                        <div id = "TotalDepositresultPlace_'.$user_id.'"></div>

                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Total profit" id="'.$user_id.'_TotalProfit_valueInput" value="'.$total_profit.'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeTotalProfit('.$user_id.')">change total profit</a></span>
                                        </div>
                                        <div id = "TotalProfitresultPlace_'.$user_id.'"></div>

                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Total profit" id="'.$user_id.'_TotalReferenceBonus_valueInput" value="'.$total_withdrawals.'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeTotalReferenceBonus('.$user_id.')">change total Withdrawals</a></span>
                                        </div>
                                        <div id = "TotalReferenceBonusresultPlace_'.$user_id.'"></div>

                                    </div>

                                     <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Wallet ID" id="'.$user_id.'_personalWalletAddressInput" value="'.$bitcoinWalletAddress.'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="DeleteUser('.$user_id.')">Delete User</a></span>
                                        </div>
                                        <div id = "personalWalletAddressResultPlace_'.$user_id.'"></div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Jquery Core Js --> 
<script src="./admin_assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="./admin_assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="./admin_assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="./admin_assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="./admin_assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="./admin_assets/js/pages/medias/image-gallery.js"></script>
<script src="./admin_assets/js/pages/calendar/calendar.js"></script>
</body>

</html>