<?php

namespace App\Http\Controllers;

use App\Models\ClaimedLoyalty;
use App\Models\LoyaltyProgram;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoyaltyProgramController extends Controller
{
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:15|min:10',
            'nik' => 'required|min:16|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }
        try {
            $loyaltyProgram = QrCode::select('loyalty_programs.end_program', 'loyalty_programs.id')
                ->join('loyalty_programs', 'loyalty_programs.qr_code_id', '=', 'qr_codes.id')
                ->where('qr_codes.serial_number', $id)
                ->where('loyalty_programs.end_program', '>=', date('Y-m-d'))
                ->first();
            if ($loyaltyProgram != null) {
                if (date('Y-m-d') < $loyaltyProgram->end_program) {
                    $cliamed = ClaimedLoyalty::firstWhere('loyalty_program_id', $loyaltyProgram->id);
                    if ($cliamed == null) {
                        ClaimedLoyalty::create([
                            'loyalty_program_id' => $loyaltyProgram->id,
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'nik' => $request->nik
                        ]);
                    } else {
                        return response()->json([
                            'message' => 'Program ini sudah berakhir.'
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'message' => 'Program ini sudah berakhir.'
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => 'Tidak ada program saat ini.'
                ], 200);
            }
            return response([
                'message' => 'Terimakasih telah berkontribusi dengan kami.'
            ], 200)->header('X-Inertia', true);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 200);
        }
    }
}
