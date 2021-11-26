<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ManagerController extends Controller
{
    use ResponseTrait, ImageUpload;
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $managers = User::whereRole('manager')->latest()->paginate(12);
        return view('admin.managers.index')->with(compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'image' => ['nullable', 'file', 'max:5000', 'mimes:png,jpg,jpeg,svg,gif'],
        ]);


        if($request->has('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploaded/profile');
        } else {
            $image = null;
        }

        try {
            $user = User::create([
                'role' => 'manager',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $image,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'instagram_link' => $request->instagram_link,
            ]);
            Manager::create(['user_id' => $user->id]);
            return $this->returnData('تم اضافة المشرف بنجاح!',$user,  201);
        } catch (\Exception $exception) {
            return $this->returnError($exception->getMessage(), 200);
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
        $manager = User::whereRole('manager')->whereId($id)->first();
        $found = true;
        if(is_null($manager)) {
            $found = false;
        }
        return view('admin.managers.edit')->with(compact('manager', 'found'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function editAdmin($id): View
    {
        $manager = User::whereRole('admin')->whereId($id)->first();
        $found = true;
        if(is_null($manager)) {
            $found = false;
        }
        return view('admin.managers.edit')->with(compact('manager', 'found'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $manager = User::whereId($id)->first();
        if(is_null($manager)) {
            return $this->returnError('لم يتم العثور على المشرف', 200);
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $id],
            'password' => ['nullable', 'string', 'confirmed'],
            'image' => ['nullable', 'file', 'max:5000', 'mimes:png,jpg,jpeg,svg,gif'],
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all(), 200);
        }
        $manager->first_name = $request->first_name;
        $manager->last_name = $request->last_name;
        $manager->username = $request->username;
        $manager->email = $request->email;
        $manager->facebook_link = $request->facebook_link;
        $manager->twitter_link = $request->twitter_link;
        $manager->instagram_link = $request->instagram_link;
        if($request->has('password')) {
            $manager->password = Hash::make($request->password);
        }

        if($request->has('image')) {
            $image = $this->uploadImage($request->file('image'), 'uploaded/profile');
            $manager->image = $image;
        }


        try {
            $manager->save();
            return $this->returnData('تم تحديث المشرف بنجاح!',$manager,  201);
        } catch (\Exception $exception) {
            return $this->returnError($exception->getMessage(), 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $manager = User::whereRole('manager')->whereId($id)->first();
        if(is_null($manager)) {
            return $this->returnError('لم يتم العثور على المشرف!', 200);
        }
        $manager->delete();
        return $this->returnSuccess('تم حذف المشرف بنجاح!', 200);
    }
}
