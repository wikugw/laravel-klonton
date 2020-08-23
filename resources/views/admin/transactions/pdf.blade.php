<head>
<style>
    table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  height: 50px;
}
td {
    padding-left: 10px;
}
</style>
</head>

<body>
    <div align="center">
        <h2>Data Transaksi Aplikasi Klontong</h2>
        @if (Auth::user()->role_id == '2')
            <h3>Toko {{ Auth::user()->store->name }}</h3>
        @else
            <h3>Admin</h3>
        @endif
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                @if (Auth::user()->role_id == '1')
                <th>Nama Toko</th>
                @endif
                <th>Nama Produk</th>
                <th>Nama Pembeli</th>
                <th>Alamat</th>
                <th>Kurir</th>
                <th>Subtotal</th>
                <th>Ongkir</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Tanggal Transfer</th>
            </tr>

            <tbody>
                @forelse ($transaction_details as $transaction_detail)
                <tr>
                    <td>{{ $transaction_detail->transaction->code }}</td>
                    @if (Auth::user()->role_id == '1')
                    <td>{{ $transaction_detail->transaction->store->name }}</td>
                    @endif
                    <td>{{ $transaction_detail->product->name }}</td>
                    <td>{{ $transaction_detail->transaction->user->name }}</td>
                    <td>{{ $transaction_detail->transaction->address->adrress }},
                        {{ $transaction_detail->transaction->address->city->city_name }},
                        {{ $transaction_detail->transaction->address->province->province }},
                        {{ $transaction_detail->transaction->address->postal_code }}
                    </td>
                    <td>{{ $transaction_detail->transaction->service }}</td>
                    <td>Rp. {{ $transaction_detail->transaction->subtotal }}</td>
                    <td>Rp. {{ $transaction_detail->transaction->ongkir }}</td>
                    <td>
                        @if ($transaction_detail->transaction->resi)
                        {{ $transaction_detail->transaction->resi }}
                        @else
                        -
                        @endif
                    </td>
                    <td @if ($transaction_detail->transaction->status == '1')
                        style="color: red;"> Menunggu Konfirmasi
                        @elseif($transaction_detail->transaction->status == '2')
                        style="color: orange;"> Menunggu Resi
                        @elseif($transaction_detail->transaction->status == '3')
                        style="color: green;"> Barang Telah dikirim
                        @elseif($transaction_detail->transaction->status == '4')
                        style="color: green;"> Barang Telah diterima
                        @endif
                    </td>
                    <td>{{ $transaction_detail->transaction->created_at }}</td>
                </tr>
                @empty
                <td class="text-center" colspan="11"> Produk tidak ditemukan </td>
                @endforelse
            </tbody>
        </thead>
    </table>
</body>
