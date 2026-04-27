<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function data(Request $request)
    {
        $type = $request->query('type', 'borrowed');
        $data = $this->getReportData($request, $type);

        return response()->json($data);
    }

    public function pdf(Request $request)
    {
        $type = $request->query('type', 'borrowed');
        $start = $request->query('start', now()->startOfMonth()->format('Y-m-d'));
        $end = $request->query('end', now()->endOfMonth()->format('Y-m-d'));

        $data = $this->getReportData($request, $type);

        return view('admin.reports.pdf', [
            'type' => $type,
            'start' => Carbon::parse($start)->format('d/m/Y'),
            'end' => Carbon::parse($end)->format('d/m/Y'),
            'data' => $data,
        ]);
    }

    private function getReportData(Request $request, string $type)
    {
        $start = $request->query('start', now()->startOfMonth()->format('Y-m-d'));
        $end = $request->query('end', now()->endOfMonth()->format('Y-m-d'));

        $startDate = Carbon::parse($start)->startOfDay();
        $endDate = Carbon::parse($end)->endOfDay();

        switch ($type) {
            case 'borrowed':
            case 'returned':
            case 'lost':
            case 'damaged':
                return Transaction::with('student', 'details.book')
                    ->where('status', $type)
                    ->whereBetween('borrow_date', [$startDate, $endDate])
                    ->get();

            case 'fines':
                return Transaction::has('fines')
                    ->with('student', 'details.book', 'fines')
                    ->whereBetween('borrow_date', [$startDate, $endDate])
                    ->get();

            case 'students':
                return Student::with('user', 'rayon', 'rombel')->get();

            case 'rayon':
                return Rayon::withCount('students')->get();

            case 'rombel':
                return Rombel::withCount('students')->get();

            default:
                return collect();
        }
    }
}

