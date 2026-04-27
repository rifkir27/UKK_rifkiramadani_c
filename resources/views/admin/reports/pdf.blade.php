<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan {{ ucfirst($type) }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PERPUSTAKAAN DIGITAL</h2>
        <p>Jenis: {{ ucfirst($type) }}</p>
        <p>Periode: {{ $start }} s/d {{ $end }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Siswa</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->transaction_code ?? '-' }}</td>
                <td>{{ $item->student->name ?? ($item->name ?? '-') }}</td>
                <td>
                    @if(isset($item->details))
                        @foreach($item->details as $d){{ $d->book->title }}@if(!$loop->last), @endif @endforeach
                    @else - @endif
                </td>
                <td>{{ isset($item->borrow_date) ? $item->borrow_date->format('d/m/Y') : '-' }}</td>
                <td>{{ ucfirst($item->status ?? '-') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
