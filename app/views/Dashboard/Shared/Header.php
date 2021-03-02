<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HOTEL-Management</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <!-- Custom styles for this template -->
    <link href="<?php echo URLROOT?>/public/dashboard/Content/css/simple-sidebar.css" rel="stylesheet" />
    <!--<script src="~/Scripts/kit.fontawesome.js"></script>-->

    <!--Font awesome-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!--Sweet alert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
    <!--Jquery UI
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
            integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
            crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="//code.jquery.com/ui/1.11.4/themes/ui-darkness/jquery-ui.css" />
-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="d-flex " id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading h-25"><i class="fas fa-hotel fa-4x"></i> RM</div>
            <div class="list-group list-group-flush">
                <a href="<?php echo URLROOT?>/AccommodationType" class="list-group-item list-group-item-action bg-light"><i class="fas fa-building fa-2x"></i> Accommodation Type</a>
                <a href="../AccommodationGadget/" class="list-group-item list-group-item-action bg-light"><i class="fas fa-archive fa-2x"></i> Accommodation Gadgets</a>
                <a href="" class="list-group-item list-group-item-action bg-light"><i class="fas fa-bed fa-2x"></i> Accommodations</a>
                <a href="" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users-cog fa-2x"></i> Roles</a>
                <a href="" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users fa-2x"></i> Users</a>
                <a href="" class="list-group-item list-group-item-action bg-light"><i class="fas fa-concierge-bell fa-2x"></i> Bookings</a>
                

            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="nav navbar navbar-expand-lg navbar-light bg-light border-bottom" id="">
            <div class="btn_Tagolle " id="menu-toggle">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>                
                <div class="nav navbar-nav ml-auto mt-2 mt-lg-0">
                  <!--  @if (Request.IsAuthenticated)
                    {
                        using (Html.BeginForm("LogOff", "Account", new { area = "" }, FormMethod.Post, new { id = "logoutForm", @class = "d-flex align-items-center" }))
                        {
                            @Html.AntiForgeryToken()
                            @Html.ActionLink("Hello " + User.Identity.GetUserName() + "!", "Index", "Manage", routeValues: new { area="" }, htmlAttributes: new { title = "Manage", @class="text-secondary" })-->
                    <a class="navbar-brand d-flex flex-column ml-5"  href="javascript:document.getElementById('logoutForm').submit()"><i class="fas fa-sign-out-alt fa-1x ml-1"></i>Logout</a>

                </div>

            </nav>

           