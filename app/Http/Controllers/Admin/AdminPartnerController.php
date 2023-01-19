<?php

namespace App\Http\Controllers\Admin;

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
                'id' => $partner->id,
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
        return Inertia::render('Admin/Partner/Detail');
    }
    public function store(PartnerStoreRequest $request)
    {
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
        return to_route('admin.partner.index')->with(['message' => 'Data successfully added!', 'type' => 'success']);
    }
    public function edit($id)
    {
        $partner = Partner::find($id);
        return Inertia::render('Admin/Partner/Edit', ['partner' => $partner]);
    }
    public function update(PartnerUpdateRequest $request, $id)
    {
        // dd($request->all());
        $attr = $request->validated();
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

        return to_route('admin.partner.index')->with(['message' => 'Data hasbeen updated!', 'type' => 'success']);
    }
    public function destroy($id)
    {
        try {
            $partner = Partner::findOrFail($id);
            $path = storage_path('app/public/uploads/profiles/');
            if ($partner->photo != null && file_exists($path . $partner->photo)) {
                unlink($path . $partner->photo);
            }
            $partner->delete();
            return to_route('admin.partner.index')->with(['message' => 'Data hasbeen deleted!', 'type' => 'danger']);
        } catch (\Throwable $th) {
            return to_route('admin.partner.index')->with(['message' => "Data can't deleted!", 'type' => 'danger']);
        }
    }
    public function list($id)
    {
        $bisnis = Business::where('id', $id)->get();
        return Inertia::render('Admin/Partner/ListBisnis', ['Bisnis' => $bisnis]);
    }
}
