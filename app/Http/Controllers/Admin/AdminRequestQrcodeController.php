<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\BatchCode;
use Illuminate\Http\Request;
use App\Models\RequestQrcode;
use App\Models\HistoryRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\QrCode;

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
        $request = RequestQrcode::with('product:id,name', 'type_qrcode:id,name')->paginate($paginate);
        return Inertia::render('Admin/Request/RequestQR', ['requests' => $request]);
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
    public function generateQR(Request $request)
    {
        $jml = $request->qty;
        $product = RequestQrcode::select('product_id')->where('id', $request->request_id)->first();
        // dd($this->generateBatchCode($product->product_id));
        DB::beginTransaction();
        try {
            for ($i = 1; $i <= $jml; $i++) {
                // Generate Batch Code

                $sn = $this->generateRandomString($request->sn_length);
                $pin = $this->generateRandomPin();
                // insert ke table qr
                $qrcode = QrCode::create([
                    'request_qrcode_id' => $request->request_id,
                    'serial_number' => $sn,
                    'pin' => $pin,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                // dd($qrcode);
                $this->generateBatchCode($qrcode->id, $request->request_id);
            }
            // update table request qr
            $affected = RequestQrcode::where('id', $request->request_id)
                ->update(['is_generate' => 'Sudah Generate']);
            if ($affected) {
                echo "success";
            } else {
                echo "error";
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            echo "error";
        } finally {
            DB::commit();
        }
    }

    public function upProgress(Request $request)
    {
        $request_qr_id = $request->request_id;
        // insert ke table qr
        HistoryRequest::insert([
            'request_qrcode_id' => $request_qr_id,
            'status' => 'Proses Cetak QR',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $affected = RequestQrcode::where('id', $request_qr_id)
            ->update(['status' => 'Proses Cetak QR']);
        if ($affected) {
            return redirect()->back()->with(['message' => 'Success to update data', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Failed to update data', 'type' => 'danger']);
        }
    }

    public function upResi(Request $request)
    {
        // insert ke table qr
        HistoryRequest::insert([
            'request_qr_id' => $request->request_qr_id,
            'status' => 'Dalam Pengiriman',
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        $affected = RequestQrcode::where('id', $request->request_qr_id)
            ->update([
                'status' => 'Dalam Pengiriman',
                'jasa_kirim' => $request->jasa_kirim,
                'no_resi' => $request->resi,
            ]);
        return redirect()->back();
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
    public function generateBatchCode($qr_code_id, $request_id)
    {
        $randString = strtoupper($this->randomHruf(2));
        $minNumber = 00000001;
        $maxNumber = 10000000;
        $code = BatchCode::select('batch_code')->where('request_qrcode_id', $request_id)->orderBy('id', 'desc')->limit(1)->get();
        if (!$code->isEmpty()) {
            $code = $code[0]['batch_code'];
            $kode = (int) substr($code, 2);
            $prefix = substr($code, 0, 2);
            if ($kode < $maxNumber) {
                $kode++;
                $newcode = $prefix . str_pad($kode, 8, '0', STR_PAD_LEFT);
                BatchCode::insert([
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
}
