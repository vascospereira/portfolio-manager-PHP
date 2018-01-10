        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="/finance/public/buy.php">Buy</a></li>
                <li><a href="/finance/public/sell.php">Sell</a></li>
                <li><a href="/finance/public/history.php">History</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="quote.php" method="post">
                <div class="form-group">
                    <input autocomplete="off" class="form-control" name="symbol" placeholder="Symbol">
                </div>
                <button class="btn btn-default">Quote</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?=$_SESSION["username"]?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/finance/public">View profile</a></li>
                        <li><a href="/finance/public/chg_pwd.php">Change password</a></li>
                        <li class="divider"></li>
                        <li><a href="/finance/public/logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main>

