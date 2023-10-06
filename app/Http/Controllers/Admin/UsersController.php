<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Province;
use App\Region;
use App\Role;
use App\Services\GlobalService;
use App\Services\UserService;
use App\User;
use App\YouthCenter;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $regions = Region::all()->pluck('name', 'id');
        return view('admin.users.create', compact('roles', 'regions'));
    }

    public function store(StoreUserRequest $request, UserService $userService)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $userService->saveUserWorkplace($user->id, $request);
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');
        $regions = Region::all()->pluck('name', 'id');
        $workplaces = GlobalService::getUserWorkplaces($user);
        $provinces = $workplaces['region_id'] ? Province::where('region_id', $workplaces['region_id'])->get()->pluck('name', 'id') : [];
        $youth_centers = $workplaces['province_id'] ? YouthCenter::whereHas('city', function($query) use($workplaces) {
            $query->where('province_id', $workplaces['province_id']);
        })->get()->pluck('name', 'id') : [];

        return view('admin.users.edit', compact('roles', 'user', 'regions', 'provinces', 'youth_centers', 'workplaces'));
    }

    public function update(UpdateUserRequest $request, User $user,UserService $userService)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $userService->saveUserWorkplace($user->id, $request, true);
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
