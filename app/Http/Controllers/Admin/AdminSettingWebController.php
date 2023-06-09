<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingWeb;
use Illuminate\Support\Facades\Storage;

class AdminSettingWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::setting_web_show')->only('index');
        $this->middleware('permission::setting_web_update')->only('update');
    }
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
                'url_wa_gateway' => 'required',
                'session_wa_gateway' => 'required',
            ]);
            $setting_web = SettingWeb::findOrFail($id);
            if ($request->file('logo_dark') != null || $request->file('logo_dark') != '') {
                Storage::disk('local')->delete('public/uploads/setting_web/' . $setting_web->logo_dark);
                $logo = $request->file('logo_dark');
                $logo->storeAs('public/uploads/setting_web/', $logo->hashName());
                $setting_web->update([
                    'logo_dark'     => $logo->hashName(),
                ]);
            }
            if ($request->file('logo_light') != "" || $request->file('logo_light') != null) {
                Storage::disk('local')->delete('public/uploads/setting_web/' . $setting_web->logo_light);
                $banner = $request->file('logo_light');
                $banner->storeAs('public/uploads/setting_web/', $banner->hashName());
                $setting_web->update([
                    'logo_light'     => $banner->hashName(),
                ]);
            }

            $data = [
                'nama_website' => $request->nama_website,
                'telpon' => $request->telpon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'is_aktif' => $request->is_aktif,
                'url_wa_gateway' => $request->url_wa_gateway,
                'session_wa_gateway' => $request->session_wa_gateway,
            ];

            $setting_web->update($data);
            \Message::success('Berhasil merubah data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
}
