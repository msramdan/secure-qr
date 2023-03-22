<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Support\Facades\Auth;

class PartnerSosmedController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $links = Sosmed::where('partner_id', Auth::guard('partners')->user()->id)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            })
            ->paginate($paginate)
            ->withQueryString()
            ->through(fn ($link) => [
                'code' => $link->code,
                'name' => $link->name,
                'link' => $link->link_sosmed,
            ]);
        return Inertia::render('Partner/CustomLink/CustomLink', [
            'filters' => $request->only(['search']),
            'links' => $links
        ]);
    }
    public function create()
    {
        return Inertia::render('Partner/CustomLink/Create');
    }
    public function store(Request $request)
    {
        try {
            $attr = $request->validate([
                'name' => 'required',
                'link' => 'required|url'
            ]);
            $attr['partner_id'] = Auth::guard('partners')->user()->id;
            $attr['link_sosmed'] = $request->link;
            Sosmed::create($attr);
            \Message::success('Berhasil menyimpan data!');
            return to_route('partner.links.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $link = Sosmed::firstWhere('code', $id);
        return Inertia::render('Partner/CustomLink/Edit', [
            'link' => $link
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $attr = $request->validate([
                'name' => 'required',
                'link' => 'required|url'
            ]);
            $attr['partner_id'] = Auth::guard('partners')->user()->id;
            $attr['link_sosmed'] = $request->link;
            $sosmed = Sosmed::firstWhere('code', $id);
            $sosmed->update($attr);
            \Message::success('Berhasil merubah data!');
            return to_route('partner.links.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $sosmed = Sosmed::firstWhere('code', $id);
            $sosmed->delete();
            \Message::success('Berhasil menghapus data!');
            return to_route('partner.links.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return redirect()->back();
        }
    }
}
