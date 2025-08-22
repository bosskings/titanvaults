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

<meta name="csrf-token" content="{{ csrf_token() }}">
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
        <a><img src="./images/titanvault.jpeg" width="25" alt="uto"><span class="m-l-10">Titan</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image"><img src="./images/titanvault.jpeg" alt=""></a>
                    <div class="detail">
                        <h4>TitanVaults</h4>
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
                        <li class="breadcrumb-item"><a href="#" style="color: rgb(120, 120, 120);">Titan-admin</a></li>
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
                
                @foreach ($usersWithAccounts as $user)
                    {{-- <pre>{{ print_r($user, true) }}</pre> --}}

                    @php
                        // The controller sets $user['accounts'] to either an array of accounts or the string "NO Transaction"
                        $accounts = $user['accounts'] ?? [];
                    @endphp

                    <div class="col-lg-4 col-md-12">
                        <div class="card mcard_3 ">
                            @php
                                // Determine border color based on user status
                                $status = strtolower($user['status'] ?? '');
                                $borderColor = '';
                                if ($status === 'unverified') {
                                    $borderColor = 'border: 2px solid #dc3545;'; // red
                                } elseif ($status === 'pending') {
                                    $borderColor = 'border: 2px solid orange;'; // orange
                                } elseif ($status === 'verified') {
                                    $borderColor = 'border: 2px solid #28a745;'; // green
                                }
                            @endphp
                            <div class="body" style="{{ $borderColor }}">
                                <h4 class="m-t-10">{{ $user['first_name'].' '.$user['last_name']}}</h4>
                                <div class="row">
                                    <div class="col-12">
                                    
                                    <p class="text-muted">{{ $user['email']}}</p>


                                  
                                    @php
                                        // Find the latest record with an unseen status
                                        $latestUnseen = null;
                                        if (is_array($accounts)) {
                                            foreach ($accounts as $acc) {
                                                if (isset($acc['status']) && strtolower($acc['status']) === 'unseen') {
                                                    if ($latestUnseen === null || strtotime($acc['created_at']) > strtotime($latestUnseen['created_at'])) {
                                                        $latestUnseen = $acc;
                                                    }
                                                }
                                            }
                                        }
                                    @endphp

                                    @if($latestUnseen)
                                    <div class="row justify-content-center mb-3" id="statusArea">
                                        <div class="col-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="w-100 d-flex justify-content-between align-items-center px-4 py-3" style="background: #fff6f6; border-radius: 12px; box-shadow: 0 2px 12px 0 rgba(220,53,69,0.15); border: 1px solid #f8d7da;">
                                                    <span class="font-weight-bold" style="color: #b71c1c; font-size: 1.2rem; letter-spacing: 1px;">
                                                        {{ ucfirst($latestUnseen['purpose'] ?? 'Deposit') }}
                                                    </span>
                                                    <span class="font-weight-bold" style="color: #dc3545; font-size: 1.2rem;">
                                                        ${{ number_format($latestUnseen['amount'] ?? 0, 2) }}
                                                    </span>

                                                    <small>
                                                        {{$latestUnseen['coin']}}
                                                    </small>
                                                </div>
                                                <button onclick="makeSeen({{$latestUnseen['id']}})" class="btn btn-sm btn-outline-danger mt-2" style="min-width: 60px;">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="input-group mb-3" >
                                        <input type="text" class="form-control" placeholder="Total Balance" id="balance{{$user['id']}}" value="{{$user['balance']}}">

                                        <div  class="input-group-append">
                                            <span class="input-group-text">
                                                <a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeBalance({{$user['id']}})">change balance</a>
                                            </span>
                                        </div>
                                            <br>
                                            <div id="resultBalance{{$user['id']}}"></div>
                                        </div>

                                        {{-- change status --}}

                                        <div class="input-group mb-3 " >

                                            <select id="status{{$user['id']}}" class="form-control">
                                                <option value="status{{$user['status']}}" disabled selected>{{$user['status']}}</option>
                                                <option value="verified">Verified</option>
                                                <option value="unverified">Unverified</option>
                                                <option value="pending">Pending</option>
                                                <option value="Approved ">Approved </option>
                                                <option value="Unapproved">Unapproved</option>
                                                <option value="Upgrading">Upgrading</option>
                                                <option value="Upgraded">Upgraded</option>
                                                <option value="suspended">suspended</option>

                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeStatus({{$user['id']}})">Update Status</a></span>
                                            </div>
                                            <br>
                                            <div id="resultStatus{{$user['id']}}"></div>

                                        </div>


                                        {{-- to upgrade users --}}
                                        <div class="input-group mb-3 " >

                                            <select id="upgraded{{$user['id']}}" class="form-control">
                                                <option value="upgraded{{$user['upgraded']}}" disabled selected>{{$user['upgraded']}}</option>
                                                <option value="NO">NO</option>
                                                <option value="YES">YES</option>
                                            </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="changeUpgraded({{$user['id']}})">Upgraded</a></span>
                                            </div>
                                            <br>
                                            <div id="resultUpgraded{{$user['id']}}"></div>

                                        </div>



                                        {{-- section for suspending using --}}

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="NO" id="suspend{{$user['id']}}" value="{{$user['deleted']}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a style="color: blue; font-size: 12px; font-weight: bold;" onclick="suspend_user( {{$user['id']}} )">suspend User</a></span>
                                            </div>
                                            <div id="resultSuspend{{$user['id']}}"></div>
                                            
                                        </div>


                                        {{-- area for account actions --}}
                                        <div style="max-height: 200px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 15px;">
                                            <table class="table table-striped mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Coin</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Pic</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(is_string($accounts) && $accounts === "NO Transaction")
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">No transactions found.</td>
                                                        </tr>
                                                    @elseif(is_array($accounts) && count($accounts) > 0)
                                                        @foreach($accounts as $transaction)
                                                            <tr>
                                                                <td>{{ $transaction['purpose'] ?? '-' }}</td>
                                                                <td>{{ $transaction['amount'] ?? '-' }}</td>
                                                                <td>{{ $transaction['coin'] ?? '-' }}</td>
                                                                <td>
                                                                    @if(isset($transaction['status']) && $transaction['status'] === 'SEEN')
                                                                        <span class="badge badge-success">Seen</span>
                                                                    @else
                                                                        <span class="badge badge-warning">Unseen</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(!empty($transaction['payment_proof']))
                                                                        <a href="{{ asset($transaction['payment_proof']) }}" target="_blank">
                                                                            <img src="{{ asset($transaction['payment_proof']) }}" alt="pic" width="50" height="50" class="rounded-circle">
                                                                        </a>
                                                                    @else
                                                                        <span class="text-muted">No Pic</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">No transactions found.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                @endforeach


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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

{{-- js to handle admiin activities --}}
<script src="./js/adminDash.js"></script>
</body>

</html>