<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Donor;
use App\Helper\ResponseHelper;
use App\User;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

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
        $contributions = DB::table('contributions')
            ->join('donors', 'donors.id', '=','contributions.donor_id')
            ->join('users', 'users.id', '=','donors.user_id' )
            ->select([
                DB::raw("SUM(contributions.amount) as amt"),
                "contributions.donor_id",
                "donors.user_id",
                "users.name",
            ])
            ->groupBy('users.name')
            ->groupBy('contributions.donor_id')
            ->groupBy('donors.user_id')
            ->orderBy('amt', 'desc')
            ->take(3)
            ->get();

        $top3CentreMax =  DB::table('contributions')
            ->join('donors', 'donors.id', '=','contributions.donor_id')
            ->join('users', 'users.id', '=','donors.user_id')
            ->join('donor_units', 'donors.id', '=','donor_units.donor_id')
            ->join('centres', 'centres.id', '=','donor_units.centre_id')
            ->select([
                DB::raw("max(contributions.donor_id) as max_donors"),
                "centres.name",
            ])
            ->groupBy('centres.id')
            ->orderBy('max_donors', 'desc')
            ->take(3)
            ->get();

        $data->push([
            "number_of_donations"=> Contribution::all()->count(),
            "top_3_donation" => $contributions,
            "avg_donation" => Contribution::selectRaw("avg(amount) avg_amount")->get()->all()[0]->avg_amount,
            "top_3_frequent_donors" => DB::select("SELECT COUNT(contributions.donor_id) as contri_count  , contributions.donor_id, users.name, contributions.amount FROM contributions INNER JOIN donors ON donors.id= contributions.donor_id INNER JOIN users on users.id = donors.user_id GROUP BY contributions.donor_id ORDER BY contri_count DESC LIMIT 0,3"),
            "top_3_centre_max_num_of_donors" => $top3CentreMax
        ]);
        return ResponseHelper::success($data);
    }

    public function getDonorByPhoneNumber($phone_number) {
        $donor = User::where('phone_number' , '=', $phone_number);
        if ($donor) {
            return ResponseHelper::success($donor);
        }
        return ResponseHelper::success(User::random());
    }
}
