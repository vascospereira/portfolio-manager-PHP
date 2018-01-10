<!DOCTYPE html>
<head>
    <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta -->
    <meta charset="utf-8"/>
    <meta content="initial-scale=1, width=device-width" name="viewport"/>
    <!-- documentation at http://getbootstrap.com/, alternative themes at https://www.bootstrapcdn.com/bootswatch/ -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/finance/public/css/styles.css" rel="stylesheet"/>
    <title>Finance: Portfolio</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/finance/public"><span class="red">Finance</span></a>
                </div>
                <?php
                if (isset($_SESSION['id']))
                    include ('portfolio_head.php');
                else
                    include ('login_head.php');
