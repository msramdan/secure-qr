<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\UserPartner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\PartnerStoreRequest;
use App\Http\Requests\Admin\PartnerUpdateRequest;
use App\Models\Business;
use App\Models\User;

class AdminPartnerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission::partner_show')->only('index');
        // $this->middleware('permission::partner_create')->only('create', 'store');
        // $this->middleware('permission::partner_update')->only('edit', 'update');
        // $this->middleware('permission::partner_delete')->only('destroy');
        // $this->middleware('permission::partner_detail')->only('show');
    }
    public function index()
    {
        $user_partner = UserPartner::join('users', 'user_partners.user_id', '=', 'users.id')
            ->get([
                'users.id', 'users.name', 'users.email', 'user_partners.pic',
                'user_partners.address', 'user_partners.id as id_partner'
            ]);
        return Inertia::render('Admin/Partner/Partner', ['partners' => $user_partner]);
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
        $user = User::create([
            'name' => $attr["name"],
            'email' => $attr["email"],
            'password' => $attr["password"]
        ]);
        UserPartner::create([
            'user_id' => $user->id,
            'code' => fake()->numberBetween(5),
            'phone' => $attr["phone"],
            'pic' => $attr["pic"],
            'photo' => $attr["photo"],
            'address' => $attr["alamat"]
        ]);
        return to_route('admin.partner.index');
    }
    public function edit($id)
    {
        $partner = UserPartner::join('users', 'user_partners.user_id', '=', 'users.id')
            ->where('user_partners.id', $id)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.password',
                'user_partners.id as id_partner',
                'user_partners.phone',
                'user_partners.pic',
                'user_partners.photo',
                'user_partners.address',
            )
            ->first();
        return Inertia::render('Admin/Partner/Edit', ['partner' => $partner]);
    }
    public function update(PartnerUpdateRequest $request, $id)
    {
        // dd($request->all());
        $attr = $request->validated();
        $partner = UserPartner::findOrFail($id);
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
        $partner->update([
            'phone' => $attr['phone'],
            'pic' => $attr['pic'],
            'photo' => 'default.jpg',
            'address' => $attr['alamat'],
        ]);
        User::find($partner->user_id)->update($attr);

        return to_route('admin.partner.index');
    }
    public function destroy($id)
    {
        try {
            $partner = UserPartner::findOrFail($id);
            User::where('id', $partner->user_id)->delete();
            $path = storage_path('app/public/uploads/profiles/');
            if ($partner->photo != null && file_exists($path . $partner->photo)) {
                unlink($path . $partner->photo);
            }
            $partner->delete();
            return to_route('admin.partner.index');
        } catch (\Throwable $th) {
            return to_route('admin.partner.index');
        }
    }
    public function list($id)
    {
        $bisnis = Business::where('id', $id)->get();
        return Inertia::render('Admin/Partner/ListBisnis', ['Bisnis' => $bisnis]);
    }
}
