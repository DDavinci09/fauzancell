<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order #<?= $order['order_id']; ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f9f9f9;
        color: #333;
    }

    .header {
        text-align: center;
        padding: 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 28px;
    }

    .header p {
        margin: 5px 0;
        font-size: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
    }

    td {
        border-bottom: 1px solid #ddd;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tbody tr:hover {
        background-color: #f2f2f2;
    }

    .btn-print {
        margin-top: 30px;
        text-align: center;
    }

    .btn-print button {
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-print button:hover {
        background-color: #0056b3;
    }

    .order-summary {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .order-summary p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.5;
    }

    .order-summary p strong {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="header">
        <h1>Detail Order</h1>
    </div>

    <div class="order-summary">
        <p><strong>ID Order:</strong> <?= $order['order_id']; ?></p>
        <p><strong>Nama User:</strong> <?= $order['username']; ?></p>
        <p><strong>Tanggal Order:</strong> <?= $order['tanggal_order']; ?></p>
        <p><strong>Total Harga:</strong> Rp <?= number_format($order['total_harga'], 2); ?></p>
    </div>

    <h3 style="margin-top: 20px;">Daftar Item</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order['items'] as $item): ?>
            <tr>
                <td><?= $item['nama_produk']; ?></td>
                <td><?= $item['jumlah']; ?></td>
                <td>Rp <?= number_format($item['harga'], 2); ?></td>
                <td>Rp <?= number_format($item['jumlah'] * $item['harga'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="btn-print">
        <button onclick="window.print();">Cetak Halaman</button>
    </div>
</body>

</html>