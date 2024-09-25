<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\TimeShedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeScheduleRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        $dayNames = [
            'Sun' => 'M', // Minggu
            'Mon' => 'S', // Senin
            'Tue' => 'S', // Selasa
            'Wed' => 'R', // Rabu
            'Thu' => 'K', // Kamis
            'Fri' => 'J', // Jumat
            'Sat' => 'S', // Sabtu
        ];

        $headers = [];
        $weekends = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::create($currentYear, $currentMonth, $i);
            $dayOfWeek = $date->format('D');
            $headers[] = $dayNames[$dayOfWeek];

            // Mark weekends
            if ($dayOfWeek == 'Sat' || $dayOfWeek == 'Sun') {
                $weekends[] = $i;
            }
        }


        $data = TimeShedule::all();
        return view('admin.marketing.rgb.schedule.index', [
            'data' => $data,
            'daysInMonth' => $daysInMonth,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'headers' => $headers,
            'weekends' => $weekends
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
