<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    use ResponseTrait;
    /**
     * @return View
     *
     */
    public function index(): View {
        return view('welcome');
    }// end of index

    /**
     * @return View
     *
     */
    public function checkPlayers(): View {
        return view('check-players');
    }// end of checkPlayers

    /**
     *
     *  @param Request $request
     *  @return JsonResponse
     */
    public function search(Request $request) {
        $issue = Issue::where('caseId', $request->caseId)->first();
        if(is_null($issue)) {
            return $this->returnError('عملية بحث فاشلة', 200);
        } else {
            return $this->returnData('عملية بحث ناجحة', $issue, 200);
        }

    }// end of search
}
