<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\BatchCode;
use Illuminate\Http\Request;
use App\Models\RequestQrcode;
use App\Models\HistoryRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QrCode;
use App\Models\TypeQrcode;
use Dflydev\DotAccessData\Data;

class AdminRequestQrcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::request_qrcode_show')->only('index');
        $this->middleware('permission::request_qrcode_create')->only('create', 'store');
        $this->middleware('permission::request_qrcode_update')->only('edit', 'update');
        $this->middleware('permission::request_qrcode_delete')->only('destroy');
        $this->middleware('permission::request_qrcode_detail')->only('show');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $data = RequestQrcode::when($request->input('search') ?? false, function ($query, $search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('amount_price', 'like', "%{$search}%")
                ->orWhere('qty', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        })->with('product:id,name', 'type_qrcode:id,name')
            ->paginate($paginate)
            ->withQueryString()
            ->through(fn ($request) => [
                'id' => $request->id,
                'code' => $request->code,
                'product_name' => $request->product->name,
                'type_qrcode' => $request->type_qrcode->name,
                'amount_price' => $request->amount_price,
                'qty' => $request->qty,
                'status' => $request->status,
            ]);

        return Inertia::render('Admin/Request/RequestQR', [
            'requests' => $data,
            'filters' => $request->only(['search']),
        ]);
    }
    public function show($id)
    {
        $request = RequestQrcode::join('partners', 'request_qrcodes.partner_id', '=', 'partners.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('type_qrcodes', 'request_qrcodes.type_qrcode_id', '=', 'type_qrcodes.id')
            ->select(
                'type_qrcodes.name as jenis_qr',
                'partners.name as nama_partner',
                'partners.email as email_partner',
                'partners.phone as telp_partner',
                'partners.address as alamat_partner',
                'products.name as nama_produk',
                'request_qrcodes.*'
            )
            ->firstWhere('request_qrcodes.id', $id);
        $history = HistoryRequest::where('request_qrcode_id', $id)->get();
        return Inertia::render('Admin/Request/DetailRequestQR', ['Qr' => $request, 'histories' => $history]);
    }
    public function create()
    {
        $product = Product::with('partner')->get();
        $type = TypeQrcode::all();
        $kode_request = $this->generateRandomString(10);
        return Inertia::render('Admin/Request/Create', [
            'code_request' => $kode_request,
            'product' => $product,
            'type' => $type
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $attr = $request->validate([
                'product_id' => 'required|exists:App\Models\Product,id',
                'type_qrcode_id' => 'required|exists:App\Models\TypeQrcode,id',
                'harga_satuan' => 'required|numeric|min:1',
                'qty' => 'required|numeric|min:1',
                'sn_length' => 'required|numeric|min:5|max:10',
                'code' => 'string|required|max:100'
            ]);
            $attr['amount_price'] = $request->harga_satuan * $request->qty;
            $attr['tanggal_request'] = now()->toDateTimeString();
            $attr['status'] = 'Waiting Payment';
            $partner_id = Product::select('partner_id')->where('id', $request->product_id)->first()->toArray();
            $attr['partner_id'] = $partner_id['partner_id'];
            $requestQr = RequestQrcode::create($attr);
            HistoryRequest::create(
                [
                    'status' => $attr['status'],
                    'request_qrcode_id' => $requestQr->id
                ]
            );

            \Message::success('Berhasil menyimpan data!');
            return to_route('admin.request.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $request = RequestQrcode::join('partners', 'request_qrcodes.partner_id', '=', 'partners.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('type_qrcodes', 'request_qrcodes.type_qrcode_id', '=', 'type_qrcodes.id')
            ->select(
                'request_qrcodes.*'
            )
            ->firstWhere('request_qrcodes.id', $id);
        $type = TypeQrcode::all();
        $product = Product::with('partner')->get();
        return Inertia::render('Admin/Request/Edit', [
            'request' => $request,
            'type' => $type,
            'product' => $product
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $attr = $request->validate([
                'product_id' => 'required|exists:App\Models\Product,id',
                'type_qrcode_id' => 'required|exists:App\Models\TypeQrcode,id',
                'harga_satuan' => 'required|numeric|min:1',
                'qty' => 'required|numeric|min:1',
                'sn_length' => 'required|numeric|min:5|max:10',
            ]);
            $attr['amount_price'] = $request->harga_satuan * $request->qty;
            $requestQr = RequestQrcode::findOrFail($id);
            $requestQr->update($attr);
            \Message::success('Berhasil merubah data!');
            return to_route('admin.request.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function download(string $filename)
    {
        $path = storage_path("app/public/uploads/bukti-pembayaran/");
        if (file_exists($path . $filename)) {
            $fullpath = $path . $filename;
            $extension = \File::extension($fullpath);
            $headers = array(
                'Content-Type: application/' . $extension,
            );
            return response()->download($fullpath, $filename, $headers);
        } else {
            \Message::danger('Bukti pembayaran tidak ada!');
            return redirect()->back();
        }
    }
    public function generateQR(Request $request)
    {
        $jml = $request->qty;
        $product = RequestQrcode::select('product_id')->where('id', $request->request_id)->first();
        DB::beginTransaction();
        try {
            for ($i = 1; $i <= $jml; $i++) {

                $sn = $this->generateRandomString($request->sn_length);
                $pin = $this->generateRandomPin();
                // insert ke table qr
                $qrcode = QrCode::create([
                    'request_qrcode_id' => $request->request_id,
                    'serial_number' => $sn,
                    'pin' => $pin,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                // Generate Batch Code
                $this->generateBatchCode($qrcode->id, $request->request_id, $product->product_id);
            }
            // update table request qr
            RequestQrcode::where('id', $request->request_id)
                ->update(['is_generate' => 'Sudah Generate']);

            \Message::success('Berhasil mengenerate Qr Code!');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            \Message::danger('Gagal mengenerate Qr Code!');
            return redirect()->back();
        } finally {
            DB::commit();
        }
    }

    public function upProgress(Request $request)
    {
        try {
            $request_qr_id = $request->request_id;
            // insert ke table qr
            HistoryRequest::insert([
                'request_qrcode_id' => $request_qr_id,
                'status' => 'Proses Cetak QR',
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            RequestQrcode::where('id', $request_qr_id)
                ->update(['status' => 'Proses Cetak QR']);

            \Message::success('Berhasil memproses request!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::success('Gagal memproses request!');
            return redirect()->back();
        }
    }

    public function upResi(Request $request)
    {
        try {
            // insert ke table qr
            HistoryRequest::insert([
                'request_qrcode_id' => $request->request_id,
                'status' => 'Dalam Pengiriman',
                'created_at' => date('Y-m-d H:i:s'),
            ]);


            $affected = RequestQrcode::where('id', $request->request_id)
                ->update([
                    'status' => 'Dalam Pengiriman',
                    'jasa_kirim' => $request->ekspedisi,
                    'no_resi' => $request->no_resi,
                ]);
            \Message::success('Berhasil menyimpan data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::success('Gagal menyimpan data!');
            return redirect()->back();
        }
    }

    function generateRandomString($length)
    {
        $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return str($randomString)->upper();
    }
    function generateRandomPin($length = 6)
    {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return str($randomString)->upper();
    }
    public function generateBatchCode($qr_code_id, $request_id, $product_id)
    {
        $randString = strtoupper($this->randomHruf(2));
        $minNumber = 00000001;
        $maxNumber = 10000000;
        $code = BatchCode::select('batch_code')->where('product_id', $product_id)->orderBy('id', 'desc')->limit(1)->get();
        if (!$code->isEmpty()) {
            $code = $code[0]['batch_code'];
            $kode = (int) substr($code, 2);
            $prefix = substr($code, 0, 2);
            if ($kode < $maxNumber) {
                $kode++;
                $newcode = $prefix . str_pad($kode, 8, '0', STR_PAD_LEFT);
                BatchCode::insert([
                    'product_id' => $product_id,
                    'qr_code_id' => $qr_code_id,
                    'request_qrcode_id' => $request_id,
                    'batch_code' => $newcode,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } else {
            $newcode = $randString . str_pad($minNumber, 8, '0', STR_PAD_LEFT);
            BatchCode::insert([
                'product_id' => $product_id,
                'qr_code_id' => $qr_code_id,
                'request_qrcode_id' => $request_id,
                'batch_code' => $newcode,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    function randomHruf($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return str($randomString)->upper();
    }

    public function destroy($id)
    {
        $requestQr = RequestQrcode::firstWhere('id', $id);
        if (in_array($requestQr->status, ['Dalam Pengiriman'])) {
            \Message::danger('Data gagal dihapus, Qr Code sudah tersebar');
            return redirect()->back();
        }

        try {
            $path = '/public/uploads/bukti-pembayaran/';
            if ($requestQr->bukti_pembayaran != null && file_exists($path . $requestQr->bukti_pembayaran)) {
                unlink($path . $requestQr->bukti_pembayaran);
            }
            BatchCode::where('request_qrcode_id', $requestQr->id)->delete();
            QrCode::where('request_qrcode_id', $requestQr->id)->delete();
            $requestQr->delete();

            \Message::success('Data berhasil dihapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Data gagal dihapus!');
            return redirect()->back();
        }
    }
}
