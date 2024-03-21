<body>
    <h2>Cafe Nisaa</h2>
    <h5>Jl. Seoul No. 32, 65464</h5>
    <hr>
        <h5>No.Faktur : {{ $transaksi->id }}</h5>
        <h5>{{ $transaksi->tanggal }}</h5>
        <table border="0">
            <thead>
                <tr>
                    <td>Qty</td>
                    <td>Item</td>
                    <td>Harga</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $item)
             <tr>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->nama_menu }}</td>
                <td>{{ number_format($item->menu->harga, 0,",",".") }}</td>
                <td>{{ number_format($item->subtotal, 0,",",".") }}</td>
             </tr>
             @andforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($transaksi->total_harga, 0,",",".") }}</td>
                </tr>
            </tfoot>
        </table>
    </body>