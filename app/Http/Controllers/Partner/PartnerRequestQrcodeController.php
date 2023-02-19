<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use App\Http\Controllers\Controller;
use App\Models\HistoryRequest;
use App\Models\RequestQrcode;
use Illuminate\Support\Facades\Auth;

class PartnerRequestQrcodeController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $requestQR = RequestQrcode::select('products.name as nama_produk', 'type_qrcodes.name as type_qr', 'request_qrcodes.*')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('type_qrcodes', 'request_qrcodes.type_qrcode_id', '=', 'type_qrcodes.id')
            ->where('request_qrcodes.partner_id', Auth::guard('partners')->user()->id)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('production_code', 'like', "%{$search}%")
                    ->orWhere('products.name', 'like', "%{$search}%")
                    ->orWhere('bpom', 'like', "%{$search}%")
                    ->orWhere('partners.name', 'like', "%{$search}%")
                    ->orWhere('categories.name', 'like', "%{$search}%")
                    ->orWhere('businesses.name', 'like', "%{$search}%");
            })->paginate($paginate)
            ->withQueryString()
            ->through(fn ($requestQR) => [
                'id' => $requestQR->id,
                'code' => $requestQR->code,
                'product' => $requestQR->nama_produk,
                'type' => $requestQR->type_qr,
                'qty' => $requestQR->qty,
                'amount_price' => $requestQR->amount_price,
                'status' => $requestQR->status,
                'is_generate' => $requestQR->is_generate,
                'bukti_bayar' => $requestQR->bukti_pembayaran,
            ]);
        return Inertia::render('Partner/Request/RequestQR', [
            'requestQr' => $requestQR,
            'filters' => $request->only(['search'])
        ]);
    }
    public function show(RequestQrcode $requestQr)
    {
        return Inertia::render('Partner/Request/Detail', [
            'request' => $requestQr->load('product:id,name', 'type_qrcode:id,name,price', 'histories:id,request_qrcode_id,status,created_at')
        ]);
    }
    public function download(string $filename)
    {
        $path = storage_path("app/public/uploads/bukti-pembayaran/");
        if (file_exists($path . $filename)) {
            $fullpath = $path . $filename;
            $extension = \File::extension($fullpath);
            $headers = array(
                // type sesuai extension file
                'Content-Type: application/' . $extension,
            );

            /**
             * params
             * 1: document file,
             * 2: nama file ketika didownload,
             * 3:header(optional, default: pdf)
             */
            return response()->download($fullpath, $filename, $headers);
        } else {
            \Message::danger('Bukti pembayaran tidak ada!');
            return redirect()->back();
        }
    }
    public function upload(int $id, Request $request)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        // abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);
        $requestQr = RequestQrcode::findOrFail($id);
        if (!in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])) {
            \Message::danger('Tidak dapat upload bukti pembayaran');
            return redirect()->back();
        }
        $attr = $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg,jpeg,pdf,docx,doc|max:1024',
        ]);
        if (
            $request->file('bukti_pembayaran') &&
            $request->file('bukti_pembayaran')->isValid() &&
            in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])
        ) {
            $path = '/public/uploads/bukti-pembayaran/';
            $filename = $request->file('bukti_pembayaran')->hashName();

            // if (!file_exists($path)) {
            //     mkdir($path, 0777, true);
            // }

            // delete old bukti_pembayaran from storage
            if ($requestQr->bukti_pembayaran != null && file_exists($path . $requestQr->bukti_pembayaran)) {
                unlink($path . $requestQr->bukti_pembayaran);
            }
            $request->bukti_pembayaran->storeAs($path, $filename);
            $attr['bukti_pembayaran'] = $filename;
            $attr['tgl_upload_bukti_bayar'] = now()->toDateTimeString();
            $attr['status'] = 'Pending Payment';
            $attr['tgl_upload_bukti_bayar'] = date('Y-m-d H:i:s');
            $requestQr->update($attr);

            HistoryRequest::create(
                [
                    'status' => $attr['status'],
                    'request_qrcode_id' => $requestQr->id
                ]
            );

            \Message::success('Bukti pembayaran berhasil diupload');

            return redirect()->back();
        }

        \Message::danger('Bukti pembayaran gagal diupload');

        return redirect()->back();
    }
}
