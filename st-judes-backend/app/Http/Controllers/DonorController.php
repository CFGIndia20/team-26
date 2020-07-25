<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Donor;
use App\Helper\ResponseHelper;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function getVerifiedDonor() {
        $donor = Donor::where('is_verified', '=',Donor::DONOR_IN_REVIEW)
            ->orWhere('is_verified', '=',Donor::DONOR_VERIFIED)
            ->with('user')
        ->get();
        return ResponseHelper::success($donor);
    }

    public function getAllDonors() {
        $donors = Donor::with('user')->get();
        $data = collect();
        foreach ($donors as $donor) {
            $data->push(
                [
                    'id' => $donor->id,
                    'name' => $donor->user->name,
                    'mobile' => $donor->user->phone_number,
                    'email' => $donor->user->email,
                ]
            );
        }

        return ResponseHelper::success($data);
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

    /*
 * Number of donations
 * highest donation top 3 [user_name, amount]
 * avg donation of all the donations
 * frequency of the donor
 * top 3 centres with maxium number of donors
 *
 */
    public function getDonorReport() {
        $data = collect();
        $contributions = Contribution::with('donor')->orderBy('amount', 'desc')->take(3)->get();
        $top3Contribution = array();
        foreach ($contributions as $contribution) {
            array_push($top3Contribution, [
                "name" => $contribution->donor->user->name,
                "amount" => $contribution->amount,
            ]);
        }

        $data->push([
            "number_of_donations"=> Contribution::all()->count(),
            "top_3_donation" => $top3Contribution,
            "avg_donation" => Contribution::selectRaw("avg(amount) avg_amount")->get()->all()[0]->avg_amount,
        ]);
        return ResponseHelper::success($data);
    }
}
