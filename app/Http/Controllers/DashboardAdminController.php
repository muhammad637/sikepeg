<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\STR;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardAdminController extends Controller
{
    //
    public function index()
    {
        $bulan6 = now()->subMonth(6)->toDateString();
        return view(
            'pages.dashboard.index',
            [
                'reminderSTR' => 0,
                'reminderSIP' => 0,
            ]
        );
    }
}
