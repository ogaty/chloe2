<?php

namespace Easel\Http\Controllers\Backend;

use Session;
use Easel\Models\User;
use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userData = $this->guard()->user()->toArray();
        $blogData = config('blog');
        $data = array_merge($userData, $blogData);

        return view('canvas::backend.profile.index', compact('data'));
    }

    /**
     * Display the user profile privacy page.
     *
     * @return \Illuminate\View\View
     */
    public function editPrivacy()
    {
        return view('canvas::backend.profile.privacy', [
            'data' => array_merge($this->guard()->user()->toArray(), config('blog')),
        ]);
    }

    /**
     * Update the user profile information.
     *
     * @param ProfileUpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->toArray())->save();
        $user->save();

        Session::set('_profile', trans('canvas::messages.update_success', ['entity' => 'Profile']));

        return redirect()->route('canvas.admin.profile.index');
    }
}
