<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Issue;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IssueController extends Controller
{
    use ResponseTrait, ImageUpload;

    public function __construct()
    {
//        dd(Auth::user());
//        if(Auth::user()->role == 'manager') {
//            $this->middleware('abort')->only(['delete']);
//        } else if(Auth::user()->role == 'judge') {
//            $this->middleware('abort')->only(['edit', 'update', 'delete']);
//        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $issues = Issue::latest()->paginate(12);
        return view('admin.issues.index')->with(compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'caseId' => 'required',
            'name' => 'required|string',
            'status' => 'required|string',
            'evidences' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all(), 200);
        }

        $images = [];
        foreach ($request->evidences as $evidence) {
            $image = $this->uploadImage($evidence, 'uploaded/evidences');
            $images[] = $image;
        }
        try {
            $issue = Issue::create([
                'user_id' => Auth::id(),
                'caseId' =>  $request->caseId,
                'name' => $request->name,
                'status' => $request->status,
                'evidences' =>  json_encode($images)
            ]);
            return $this->returnData('تم اضافة القضية بنجاح!',$issue,  201);
        } catch (\Exception $exception) {
            return $this->returnError('حدث خطأ ما. الرجاء المحاولة لاحقا', 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $issue = Issue::whereId($id)->first();
        $found = true;
        if(is_null($issue)) {
            $found = false;
        }
        return view('admin.issues.edit')->with(compact('issue', 'found'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $issue = Issue::whereId($id)->first();
        if(is_null($issue)) {
            return $this->returnError('لم يتم العثور على القضية', 200);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all(), 200);
        }

        if ($request->evidences) {
            foreach ((array)json_decode($issue->evidences) as $evidence) {
                File::delete($evidence);
            }
            $images = [];
            foreach ($request->evidences as $evidence) {
                $image = $this->uploadImage($evidence, 'uploaded/evidences');
                $images[] = $image;
            }
        } else {
            $images = $issue->evidences;
        }

        try {
            $issue->update([
                'name' => $request->name,
                'status' => $request->status,
                'evidences' =>  $images
            ]);
            return $this->returnData('تم تحديث القضية بنجاح!',$issue,  201);
        } catch (\Exception $exception) {
            return $this->returnError('حدث خطأ ما. الرجاء المحاولة لاحقا', 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $issue = Issue::whereId($id)->first();
        if(is_null($issue)) {
            return $this->returnError('لم يتم العثور على القضية', 200);
        }
        foreach ((array)json_decode($issue->evidences) as $evidence) {
            File::delete($evidence);
        }
        $issue->delete();
        return $this->returnSuccess('تم حذف القضية بنجاح!', 200);
    }
}
