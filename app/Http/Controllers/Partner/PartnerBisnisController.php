<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BisnisPartnerRequest;
use App\Models\BusinessVideo;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PartnerBisnisController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::guard('partners')->user()->id);
        $paginate = $request->get('paginate') ?? 10;
        $business = Business::when($request->input('search'), function ($query, $search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%")
                ->orWhere('manufacture', 'like', "%{$search}%");
        })
            ->where('partner_id', Auth::guard('partners')->user()->id)
            ->paginate($paginate)
            ->withQueryString()
            ->through(fn ($partner) => [
                'id' => $partner->id,
                'code' => $partner->code,
                'name' => $partner->name,
                'brand' => $partner->brand,
                'manufacture' => $partner->manufacture
            ]);
        // dd($business);
        return Inertia::render('Partner/Business/Business', [
            'business' => $business,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create(Request $request)
    {
        return Inertia::render('Partner/Business/Create');
    }
    public function show(Business $business)
    {
        return Inertia::render('Partner/Business/Detail', [
            'business' => $business
        ]);
    }
    public function store(Request $request)
    {
        try {
            $attr = $request->validate([
                'code' => 'required|string|min:1|max:20|unique:businesses,code',
                'name' => 'required|string|min:1|max:100',
                'brand' => 'required|string|min:1|max:100',
                'logo' => 'required|image|max:1024|mimes:png',
                'manufacture' => 'required|string|min:1|max:255',
                'video' => 'nullable|max:3050|mimes:mp4'
            ]);
            if ($request->file('logo') && $request->file('logo')->isValid()) {

                $path = storage_path('app/public/uploads/logos/');
                $filename = $request->file('logo')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                Image::make($request->file('logo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);

                $attr['logo'] = $filename;
            }
            $attr['partner_id'] = Auth::guard('partners')->user()->id;
            $bis = Business::create($attr);
            if ($request->file('video') && $request->file('video')->isValid()) {

                $path = storage_path('app/public/uploads/videos/');
                $filename = $request->file('video')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $request->file('video')->move($path, $filename);

                $video = new BusinessVideo();
                $video->business_id = $bis->id;
                $video->video = $filename;
                $video->save();
            }

            \Message::success('Berhasil menyimpan data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit(Business $business)
    {
        return Inertia::render('Partner/Business/Edit', [
            'business' => $business,
            'videos' => BusinessVideo::firstWhere('business_id', $business->id) ?? ''
        ]);
    }
    public function update(Business $business, Request $request)
    {
        // dd($request->all(), $business);
        try {
            $attr = $request->validate([
                'code' => 'required|string|min:1|unique:businesses,code,' . $business->id,
                'name' => 'required|string|min:1|max:100',
                'brand' => 'required|string|min:1|max:100',
                'manufacture' => 'required|string|min:1|max:255',
                'logo' => 'nullable|image|max:1024|mimes:png',
                'video' => 'nullable|max:3050|mimes:mp4',
            ]);
            if ($request->file('logo') && $request->file('logo')->isValid()) {

                $path = storage_path('app/public/uploads/logos/');
                $filename = $request->file('logo')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                Image::make($request->file('logo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);

                // delete old logo from storage
                if ($business->logo != null && file_exists($path . $business->logo)) {
                    unlink($path . $business->logo);
                }

                $attr['logo'] = $filename;
            } else {
                $attr['logo'] = $business->logo;
            }
            $attr['partner_id'] = Auth::guard('partners')->user()->id;
            $business->update($attr);

            if ($request->file('video') && $request->file('video')->isValid()) {

                $path = storage_path('app/public/uploads/videos/');
                $filename = $request->file('video')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $request->file('video')->move($path, $filename);

                // delete old video from storage
                $video = BusinessVideo::firstWhere('business_id', $business->id);
                if ($video != null && file_exists($path . $video->video)) {
                    unlink($path . $video->video);
                    $video->video = $filename;
                    $video->save();
                } else {
                    $SaveVid = new BusinessVideo();
                    $SaveVid->business_id = $business->id;
                    $SaveVid->video = $filename;
                    $SaveVid->save();
                }
            }
            \Message::success('Berhasil merubah data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy(Business $business)
    {
        try {
            // dd($business);
            $business->delete();
            \Message::success('Berhasil menghapus data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return redirect()->back();
        }
    }
}
