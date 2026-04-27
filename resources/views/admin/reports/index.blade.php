@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Laporan</h1>
    <p class="text-gray-600">Generate laporan perpustakaan</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php $types = ['borrowed'=>'Barang Dipinjam','returned'=>'Barang Kembali','lost'=>'Barang Hilang','damaged'=>'Barang Rusak','fines'=>'Denda','students'=>'Siswa','rayon'=>'Per Rayon','rombel'=>'Per Rombel']; @endphp
    @foreach($types as $key => $label)
    <a href="{{ route('admin.reports.pdf', ['type'=>$key]) }}" class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <i class="fas fa-file-pdf text-indigo-600"></i>
        </div>
        <h3 class="font-bold text-gray-800">{{ $label }}</h3>
        <p class="text-sm text-gray-500 mt-1">Download PDF</p>
    </a>
    @endforeach
</div>
@endsection
