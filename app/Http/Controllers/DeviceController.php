<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use ImageResize;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{

    public function allDevices() {
        $devices = Device::orderby('updated_at', 'desc')->get();
        return view('all-devices', compact('devices'));
    }
}
