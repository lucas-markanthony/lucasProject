<?php

namespace App\Http\Controllers;

use App\Models\Logging;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoggingController extends Controller
{

    public function storeHistory($user, $action, $externaldata)
    {
        $newLogging = new Logging;

        $newLogging->user = $user;
        $newLogging->action = $action;
        $newLogging->externaldata = $externaldata;
        $newLogging->save();
    }

}
