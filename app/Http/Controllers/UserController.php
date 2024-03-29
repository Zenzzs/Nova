<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.edit')->only('edit');
        $this->middleware('can:users.update')->only('update');
        $this->middleware('can:casa.changue_status')->only('changue_status');
        $this->middleware('can:casa.admin.casas')->only('administer_casa');




    }
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $users = User::where('email', 'like', '%' . $buscar . '%')
            ->orWhere('username', 'like', '%' . $buscar . '%')
            ->orderBy('id', 'DESC')
            ->paginate(8);
        return view('admin.users.index', compact('users', 'buscar'));
    }



    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {

        $user->roles()->sync($request->roles);

        return redirect()->route('users.edit', $user)->with('info', "Se asigno los roles correctamente");
    }

    public function change_status(User $user)
    {


        if ($user->status == null) {
            $user->status = 1;
            $user->save();
            return redirect()->back();
        }
        if ($user->status == 1) {
            $user->status = 2;
            $user->save();
            return redirect()->back();
        } else {
            $user->status = 1;
            $user->save();
            return redirect()->back();
        }
    }
    public function administer_casa()
    {
        $casas = Casa::with(['media'])
            ->orderBy('id')
            ->paginate(15);
        return view('admin.users.administer_casa', compact('casas'));
    }

}
