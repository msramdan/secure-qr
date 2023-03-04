<?php

namespace App\Http\Controllers\Admin;

use \Message;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Partner;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\PartnerStoreRequest;
use App\Http\Requests\Admin\PartnerUpdateRequest;

class AdminPartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::partner_show')->only('index');
        $this->middleware('permission::partner_create')->only('create', 'store');
        $this->middleware('permission::partner_update')->only('edit', 'update');
        $this->middleware('permission::partner_delete')->only('destroy');
        $this->middleware('permission::partner_detail')->only('show');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $partner = Partner::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('pic', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        })
            ->paginate($paginate)
            ->withQueryString()
            ->through(fn ($partner) => [
                'code' => $partner->code,
                'name' => $partner->name,
                'email' => $partner->email,
                'pic' => $partner->pic,
                'address' => $partner->address
            ]);
        return Inertia::render('Admin/Partner/Partner', [
            'partners' => $partner,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/Partner/Create');
    }
    public function show($id)
    {
        $partner = Partner::firstWhere('code', $id);
        return Inertia::render('Admin/Partner/Detail', [
            'partner' => $partner
        ]);
    }
    public function store(PartnerStoreRequest $request)
    {
        try {
            $attr = $request->validated();
            $attr['password'] = bcrypt($request->password);
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
                $attr["photo"] = $filename;
            }
            Partner::create([
                'code' => fake()->numberBetween(5),
                'name' => $attr["name"],
                'phone' => $attr["phone"],
                'pic' => $attr["pic"],
                'photo' => $attr["photo"],
                'address' => $attr["alamat"],
                'email' => $attr["email"],
                'password' => $attr["password"]
            ]);
            \Message::success('Berhasil menyimpan data!');
            return to_route('admin.partner.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $partner = Partner::firstWhere('code', $id);
        return Inertia::render('Admin/Partner/Edit', ['partner' => $partner]);
    }
    public function update(Request $request, $id)
    {
        try {
            $attr = $request->validate([
                'name' => 'required|min:1|max:50|string',
                'email' => 'required|email|unique:partners,email,' . $id,
                'phone' => 'required|min:1|max:15',
                'password' => 'confirmed',
                'pic' => 'required|min:5|max:100',
                'photo' => 'mimes:png,jpg,jpeg|max:3040',
                'alamat' => 'required|min:10|string'
            ]);
            $partner = Partner::findOrFail($id);
            switch (is_null($request->password)) {
                case true:
                    unset($attr['password']);
                    break;
                default:
                    $attr['password'] = bcrypt($request->password);
                    break;
            }

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

                // delete old photo from storage
                if ($partner->photo != null && file_exists($path . $partner->photo)) {
                    unlink($path . $partner->photo);
                }

                $attr['photo'] = $filename;
            }
            $partner->update($attr);
            return to_route('admin.partner.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $partner = Partner::firstWhere('code', $id);
            $path = storage_path('app/public/uploads/profiles/');
            if ($partner->photo != null && file_exists($path . $partner->photo)) {
                unlink($path . $partner->photo);
            }
            $partner->delete();
            \Message::success('Data berhasil dihapus!');
            return to_route('admin.partner.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return to_route('admin.partner.index');
        }
    }
    public function list($id)
    {
        $partner = Partner::firstWhere('code', $id);
        $bisnis = Business::where('partner_id', $partner->id)->get();
        return Inertia::render('Admin/Partner/ListBisnis', ['Bisnis' => $bisnis]);
    }
}
