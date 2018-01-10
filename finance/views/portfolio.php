<?php  if (isset($_SESSION['sell'])): ?>
<header>
    <div class="alert alert-info" role="alert">
        Sold!
    </div>
</header>
<?php elseif(isset($_SESSION['buy'])): ?>
<header>
    <div class="alert alert-info" role="alert">
        Bought!
    </div>
</header>
<?php elseif(isset($_SESSION['pw'])): ?>
<header>
    <div class="alert alert-info" role="alert">
        You changed password!
    </div>
</header>
<?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Price</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0,$n=count($stocks);$i<$n;$i++){?>
            <tr>
                <td><?=$stocks[$i]['symbol']?></td>
                <td><?=$stocks[$i]['name']?></td>
                <td><?=$stocks[$i]['share']?></td>
                <td>$<?=number_format($stocks[$i]['price'],3)?></td>
                <td>$<?=number_format($stocks[$i]['price']*$stocks[$i]['share'],3)?></td>
            </tr>
        <?php }?>
            <tr>
                <td colspan="4">CASH</td>
                <td>$<?= number_format($account['cash'], 3) ?></td>
            </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4"></td>
            <td>$<?= number_format($total, 3) ?></td>
        </tr>
        </tfoot>
    </table>
<?php
if (isset($_SESSION['sell']))
    unset($_SESSION['sell']);
else if(isset($_SESSION['buy']))
    unset($_SESSION['buy']);
else if(isset($_SESSION['pw']))
    unset($_SESSION['pw']);
