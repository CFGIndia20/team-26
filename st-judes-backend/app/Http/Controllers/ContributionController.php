<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Donor;
use App\Helper\ResponseHelper;
use App\User;
use Illuminate\Http\Request;

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
}
