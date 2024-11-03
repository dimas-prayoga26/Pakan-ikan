<?php

namespace App\Http\Controllers;

use App\Models\SettingData;
use Illuminate\Http\Request;

class SettingDataController extends Controller
{
    public function index()
    {
        $settingDatas = SettingData::all();
        return view('admin.settings.index', compact('settingDatas'));
    }

    public function edit($id)
    {
        $settingDatas = SettingData::findOrFail($id);
        return view('admin.settings.editSettings', compact('settingDatas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tempMin' => 'required|numeric',
            'tempMax' => 'required|numeric',
            'phMin' => 'required|numeric',
            'phMax' => 'required|numeric',
            'feedMax' => 'required|numeric',
        ]);

        $settingTool = SettingData::findOrFail($id);
        $settingTool->update($request->all());

        return redirect()->route('settings.index')->with('success', 'Data updated successfully');
    }
}

