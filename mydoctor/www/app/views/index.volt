<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Phalcon PHP Framework</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="css/sidebar.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">
        <!--<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
            </div>
        </nav>-->
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        GROS PD
                    </a>
                </li>
                <li>
                    <a href="#">Il</a>
                </li>
                <li>
                    <a href="#">va</a>
                </li>
                <li>
                    <a href="#">dire</a>
                </li>
                <li>
                    <a href="#">que</a>
                </li>
                <li>
                    <a href="#">c'est</a>
                </li>
                <li>
                    <a href="#">moche</a>
                </li>
                <li {{ page == 'session' ? 'class="active"' : '' }}>{{ link_to("session", "<span class='glyphicon glyphicon-log-in'></span> Login") }}</li>
                <li {{ page == 'register' ? 'class="active"' : '' }}>{{ link_to("register", "<span class='glyphicon glyphicon-user'></span> Register") }}</li>
                <li>{{ link_to("session/logout", "<span class='glyphicon glyphicon-log-out'></span> Logout") }}</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container">
                <a href="#menu-toggle" class="btn btn-primary" id="menu-toggle"><span class="glyphicon glyphicon-align-justify"></span></a>
                {{ content() }}
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
