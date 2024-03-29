<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerInfoController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(): Response
    {
        $customer = User::query()->findOrFail(Auth::id());
        return view('cabinet.customer-info.show')->with(compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $customer
     * @return Response
     */
    public function edit(User $customer): Response
    {
        return view('cabinet.customer-info.edit')->with(compact('customer'));
    }

    /**
     * /**
     * @param UserUpdateRequest $request
     * @param User $customer
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $customer): RedirectResponse
    {

        $params = $request->all();
        unset($params['avatar']);

        if ($request->hasFile('avatar')) {
            $params = array_merge($params, ['avatar' => $this->storeImage($request)]);
        }

        $customer->update($params);

        return redirect()->route('cabinet.customer-info.show')
            ->with('success', 'Post updated successfully.');
    }


    /**
     * @param Request $request
     * @return bool|string
     */
    protected function storeImage(Request $request): bool|string
    {
        $avatar = $request->file('avatar');
        $path = $avatar->store('avatars');

        return substr($path, strlen('avatars/'));
    }
}
