<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends AdminController
{
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'collection' => new UserCollection(
                User::query()
                    ->sort()
                    ->filter()
                    ->paginate(),
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Edit', [
            //
        ])->model(User::class);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $user = User::create($attributes);

        return redirect()->route('admin.users.edit', $user)
            ->with('success', __('user.event.created'));
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'resource' => UserResource::make($user),
        ])->model(User::class);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $attributes = $request->validated();

        // dd($attributes);

        $user->fill($attributes);

        $user->save();

        return redirect()->route('admin.users.edit', $user)
            ->with('success', __('user.event.updated'));
    }
}
