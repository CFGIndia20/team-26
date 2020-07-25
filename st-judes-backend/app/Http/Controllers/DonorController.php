<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function getVerifiedDonor() {
        $donor = Donor::where('is_verified', '=',Donor::DONOR_IN_REVIEW)
            ->orWhere('is_verified', '=',Donor::DONOR_VERIFIED)
            ->with('user')
        ->get();
        return response()->json([
            "message"    => "Successfully fetched",
            "data"       => $donor
        ], 200);
    }

    public function getRejectedDonor() {
            $donor = Donor::where('is_verified', '=',Donor::DONOR_REJECTED)
                ->get();
            if ($donor) {
                return ResponseHelper::success($donor);
            } else {
                return  ResponseHelper::badRequest();
            }

    }

    public function changeDonorVerification(Request $request) {
        $donorId = $request->input('donor_id');
        $verificationId = $request->input('is_verified');
        $donor = Donor::find($donorId);

        $updatedDonor = Donor::where('id','=',$donor->id)->update(['is_verified'=> $verificationId]);

        return ResponseHelper::updated($updatedDonor);
    }
}
