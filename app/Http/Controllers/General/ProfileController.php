<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use App\Services\ImageServices;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Return to profile page view
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('generals.profile');
    }

    /**
     * Update profile
     * @param ProfileRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ProfileRequest $request)
    {
        $data = request()->only(['name', 'email', 'gender', 'phone', 'address']);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if (!is_null($request->image)) {
            $data['image'] = (new ImageServices)->handleUploadedImage($request->file('image'));
        }
        Member::findOrFail($request->id)->update($data);
        return redirect()->route('profiles.index')->with('success', trans('message.profile_success'));
    }
}
