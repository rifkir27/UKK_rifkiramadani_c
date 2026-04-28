@extends('layouts.app')

@section('title', 'Proses Peminjaman')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Proses Peminjaman</h1>
    <p class="text-gray-600">Scan QR Code / NIS siswa dan pilih buku</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form action="{{ route('petugas.transactions.borrow.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                <label class="block text-gray-700 font-bold">Barcode / NIS Siswa</label>
                <button type="button" id="toggleScanBtn" onclick="toggleScanner()" class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                    <i class="fas fa-camera mr-1"></i>Scan QR Code
                </button>
            </div>
            <div id="scanner-container" class="mb-3 hidden">
                <div id="reader" class="w-full max-w-sm mx-auto border-2 border-indigo-300 rounded-lg overflow-hidden"></div>
                <p class="text-xs text-gray-500 mt-1 text-center">Arahkan kamera ke QR Code siswa</p>
            </div>
            <input type="text" id="student_barcode" name="student_barcode" required placeholder="Scan atau ketik barcode/NIS" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Pilih Buku</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-64 overflow-y-auto border rounded-lg p-3">
                @foreach($books as $book)
                <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                    <input type="checkbox" name="book_ids[]" value="{{ $book->id }}">
                    <div>
                        <p class="font-medium text-sm">{{ $book->title }}</p>
                        <p class="text-xs text-gray-500">{{ $book->author }} | Stok: {{ $book->stock }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Proses Peminjaman</button>
    </form>
</div>
@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    let html5QrCode = null;
    let isScanning = false;

    function toggleScanner() {
        const scannerContainer = document.getElementById('scanner-container');
        const toggleBtn = document.getElementById('toggleScanBtn');

        if (!isScanning) {
            scannerContainer.classList.remove('hidden');
            toggleBtn.innerHTML = '<i class="fas fa-times mr-1"></i>Tutup Scanner';
            toggleBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            toggleBtn.classList.add('bg-red-600', 'hover:bg-red-700');
            startScanner();
        } else {
            scannerContainer.classList.add('hidden');
            toggleBtn.innerHTML = '<i class="fas fa-camera mr-1"></i>Scan QR Code';
            toggleBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
            toggleBtn.classList.add('bg-green-600', 'hover:bg-green-700');
            stopScanner();
        }
        isScanning = !isScanning;
    }

    function startScanner() {
        html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        html5QrCode.start(
            { facingMode: "environment" },
            config,
            (decodedText, decodedResult) => {
                document.getElementById('student_barcode').value = decodedText;
                stopScanner();
                document.getElementById('scanner-container').classList.add('hidden');
                document.getElementById('toggleScanBtn').innerHTML = '<i class="fas fa-camera mr-1"></i>Scan QR Code';
                document.getElementById('toggleScanBtn').classList.remove('bg-red-600', 'hover:bg-red-700');
                document.getElementById('toggleScanBtn').classList.add('bg-green-600', 'hover:bg-green-700');
                isScanning = false;
                document.getElementById('student_barcode').focus();
                alert('QR Code berhasil discan: ' + decodedText);
            },
            (errorMessage) => {
                // ignore errors saat scanning
            }
        ).catch((err) => {
            console.error("Error starting scanner:", err);
            alert("Gagal membuka kamera. Pastikan kamera tersedia dan izinkan akses kamera.");
        });
    }

    function stopScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                html5QrCode = null;
            }).catch((err) => {
                console.error("Error stopping scanner:", err);
            });
        }
    }
</script>
@endpush
@endsection
