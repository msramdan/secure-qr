<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingWeb;
use Illuminate\Support\Facades\Storage;

class AdminSettingWebController extends Controller
{
    public function index()
    {
        $setting = SettingWeb::first();
        return Inertia::render('Admin/Utilities/Setting', ['setting' => $setting]);
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_website' => 'required|string',
                'telpon' => 'required|string',
                'email' => 'required|email',
                'deskripsi' => 'required|string',
                'is_aktif' => 'required',
            ]);
            $setting_web = SettingWeb::findOrFail($id);
            if ($request->file('logo_dark') != null || $request->file('logo_dark') != '') {
                Storage::disk('local')->delete('public/img/setting_web/' . $setting_web->logo_dark);
                $logo = $request->file('logo_dark');
                $logo->storeAs('public/img/setting_web', $logo->hashName());
                $setting_web->update([
                    'logo_dark'     => $logo->hashName(),
                ]);
            }
            if ($request->file('logo_light') != "" || $request->file('logo_light') != null) {
                Storage::disk('local')->delete('public/img/setting_web/' . $setting_web->logo_light);
                $banner = $request->file('logo_light');
                $banner->storeAs('public/img/setting_web', $banner->hashName());
                $setting_web->update([
                    'logo_light'     => $banner->hashName(),
                ]);
            }
            $setting_web->update([
                'nama_website' => $request->nama_website,
                'telpon' => $request->telpon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'is_aktif_website' => $request->is_aktif_website,
            ]);
            \Message::success('Berhasil merubah data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
}
