<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transaction report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .laporan {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .paper {
            width: 100%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="laporan">
        <h2>Transaction report</h2>
        <div class="paper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Product</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $index => $transaction) :?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $transaction->member_name; ?></td>
                            <td><?= $transaction->product_names ?></td>
                            <td><?= $transaction->total; ?></td>
                            <td><?= $transaction->transaction_date; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>