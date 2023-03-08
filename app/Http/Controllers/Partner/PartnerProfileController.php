<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PartnerProfileController extends Controller
{
    public function index()
    {
        $partner = Partner::firstWhere('id', Auth::guard('partners')->user()->id);
        return Inertia::render('Partner/Profile', [
            'profile' => $partner
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|min:10|max:15',
            'pic' => 'required|string|max:100',
            'photo' => 'nullable|image|max:3050|mimes:png,jpg',
            'address' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('partners')->ignore(Auth::guard('partners')->user()->id)],
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed'
            ],
        ]);
        try {
            $partner = Partner::where('code', $id)->first();

            if ($request->password != null) {
                if ($request->file('photo') && $request->file('photo')->isValid()) {

                    $path = storage_path('app/public/uploads/profiles/');
                    $filename = $request->file('photo')->hashName();

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    })->save($path . $filename);
                    $data["photo"] = $filename;
                } else {
                    $data['photo'] = $partner->photo;
                }

                $data['password'] = bcrypt($request->password);
                $partner->update($data);
            } else {
                if ($request->file('photo') && $request->file('photo')->isValid()) {

                    $path = storage_path('app/public/uploads/profiles/');
                    $filename = $request->file('photo')->hashName();

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    })->save($path . $filename);
                    $data["photo"] = $filename;
                } else {
                    $data['photo'] = $partner->photo;
                }
                $partner->update([
                    'name' => $data["name"],
                    'phone' => $data["phone"],
                    'pic' => $data["pic"],
                    'photo' => $data["photo"],
                    'address' => $data["address"],
                    'email' => $data["email"]
                ]);
            }
            \Message::success('Berhasil merubah data');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data');
            return redirect()->back();
        }
    }
}
