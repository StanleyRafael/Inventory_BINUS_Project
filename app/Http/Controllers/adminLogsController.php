<?php

namespace App\Http\Controllers;

use App\Exports\LogsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log as userLog;

class adminLogsController extends Controller
{
    public function index(request $request)
    {
        // Get the selected month from the request
        $selectedMonth = $request->query('month');

        // Query logs based on the current user's ID and the selected month
        $query = userLog::query();

        if ($selectedMonth) {
            // Filter logs by the selected month if provided
            $query->whereMonth('created_at', $selectedMonth);
        }

        // Get the logs and order them by creation date in descending order
        $logs = $query->orderBy('created_at', 'desc')->get();

        // Return the view with the filtered logs
        return view('admin-logs', ['logs' => $logs]);
        }

        public function exportLogs()
        {
            $logs = userLog::all(); // Fetch logs data

            $export = new LogsExport($logs);
            $export->export();

            return response()->download('logs.xlsx')->deleteFileAfterSend(true);
        }

}
