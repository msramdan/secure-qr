<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\TypeQrcode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestQrcode;
use Intervention\Image\Facades\Image;

class AdminTyperQrcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::type_qrcode_show')->only('index');
        $this->middleware('permission::type_qrcode_create')->only('create', 'store');
        $this->middleware('permission::type_qrcode_update')->only('edit', 'update');
        $this->middleware('permission::type_qrcode_delete')->only('destroy');
        $this->middleware('permission::type_qrcode_detail')->only('show');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $type = TypeQrcode::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('price', 'like', "%{$search}%");
        })->paginate($paginate)
            ->withQueryString()->through(fn ($type) => [
                'code' => $type->code,
                'name' => $type->name,
                'price' => $type->price
            ]);
        return Inertia::render('Admin/Master/TypeQRCode/TypeQR', [
            'type' => $type,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/Master/TypeQRCode/CreateTypeQR');
    }
    public function show($id)
    {
        $type = TypeQrcode::firstWhere('code', $id);
        return Inertia::render('Admin/Master/TypeQRCode/DetailTypeQR', ['type' => $type]);
    }
    public function store(Request $request)
    {
        try {
            $attr = $request->validate([
                'name' => 'required|string|min:1|max:100',
                'price' => 'required|numeric',
                'photo' => 'required|image|max:1024',
            ]);
            if ($request->file('photo') && $request->file('photo')->isValid()) {

                $path = storage_path('app/public/uploads/type_qr/');
                $filename = $request->file('photo')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);

                $attr['photo'] = $filename;
            }
            TypeQrcode::create($attr);

            \Message::success('Berhasil menyimpan data!');
            return to_route('admin.type.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $type = TypeQrcode::firstWhere('code', $id);
        return Inertia::render('Admin/Master/TypeQRCode/EditTypeQR', ['type' => $type]);
    }
    public function update(Request $request, $id)
    {
        try {
            $typeQr = TypeQrcode::firstWhere('code', $id);
            $attr = $request->validate([
                'name' => 'required|string|min:1|max:100',
                'price' => 'required|numeric',
                'photo' => 'max:1024',
            ]);
            if ($request->file('photo') && $request->file('photo')->isValid()) {

                $path = storage_path('app/public/uploads/type_qr/');
                $filename = $request->file('photo')->hashName();

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);

                // delete old photo from storage
                if ($typeQr->photo != null && file_exists($path . $typeQr->photo)) {
                    unlink($path . $typeQr->photo);
                }

                $attr['photo'] = $filename;
            }
            $typeQr->update($attr);

            \Message::success('Berhasil merubah data!');
            return to_route('admin.type.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $type = TypeQrcode::firstWhere('code', $id);
            $request_qr = RequestQrcode::where('type_qrcode_id', $id)->get();
            if ($request_qr->isEmpty()) {
                $path = storage_path('app/public/uploads/type_qr/');

                if ($type->photo != null && file_exists($path . $type->photo)) {
                    unlink($path . $type->photo);
                }
                $type->delete();

                \Message::success('Berhasil menghapus data!');
                return to_route('admin.type.index');
            }
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return redirect()->back();
        }
    }
}
