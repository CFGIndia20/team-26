<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Donor;
use App\Helper\ResponseHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{
    public function getDonorContributionAccordingToCentres($donor_id) {
        $donorObj = Donor::find($donor_id);
        if ($donorObj) {
            $contributionObj = Contribution::join('donor_units', 'contributions.id', 'donor_units.contribution_id')->join('centres', 'donor_units.centre_id', 'centres.id' )->where('donor_units.donor_id',
                '=', $donor_id)->get();
            return ResponseHelper::success($contributionObj);
        }
        return ResponseHelper::badRequest();
    }

    public function getAllContribution() {
        return ResponseHelper::success(Contribution::with('donor')->get());
    }

    public function getAllUserContribution() {
        $donorContribution =  DB::table('contributions')
            ->join('donors', 'donors.id', '=','contributions.donor_id')
            ->join('users', 'users.id', '=','donors.user_id')
            ->join('donor_units', 'donors.id', '=','donor_units.donor_id')
            ->select([
                DB::raw("sum(contributions.amount) as contribution_amount"),
                "contributions.*",
                'users.name',
            ])
            ->groupBy('contributions.donor_id')
            ->orderBy('contribution_amount', 'desc')
            ->get();
            return ResponseHelper::success($donorContribution);
    }
}
