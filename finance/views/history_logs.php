<table class="table table-striped">
    <thead>
    <tr>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
        <th>Transacted</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($logs as $transaction): ?>
        <tr>
            <td><?= $transaction["symbol"] ?></td>
            <td><?= $transaction["shares"] ?></td>
            <td>$<?= number_format($transaction["price"],3) ?></td>
            <td><?= $transaction["transacted"] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>