<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
{
    $setting = Setting::first();
    return view('admin.settings.edit', compact('setting'));
}

public function update(Request $request)
{
    $request->validate([
        'cv_url' => 'nullable|url',
    ]);

    $setting = Setting::first();
    $setting->update($request->only('cv_url'));
    return redirect()->route('admin.settings.edit')->with('success', 'Settings updated');
}

}
