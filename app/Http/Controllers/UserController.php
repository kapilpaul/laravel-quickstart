<?php

namespace App\Http\Controllers;

use Activation;
use App\Models\User\User;
use Illuminate\Http\Request;
use Sentinel;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\QueryException;
use PDOException;
use Illuminate\Session\TokenMismatchException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 100;
        $users = Sentinel::getUserRepository()->where('email', '!=', 'info@kapilpaul.me')->with('roles')->paginate($perPage);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Sentinel::getRoleRepository()->pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles_id' => 'required',
        ]);

        try {
            $input = $request->all();

            if ($file = $request->file('photo_id')) {
                $extension = $file->getClientOriginalExtension();
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $file->move('img', $name);
                    $photo = Photo::create(['photo' => $name]);
                    $input['photo_id'] = $photo->id;
                } else {
                    return redirect()->back()->with(['error' => "You can Only Upload Jpg, jpeg, png image"]);
                }
            }

            $role = Sentinel::findRoleById($request->roles_id);
            $user = Sentinel::registerAndActivate($input);
            $role->users()->attach($user);

            return redirect()->back()->with(['success' => "$request->first_name created Successfully."]);
        } catch (PDOException $e) {
            return redirect()->back()->with(['error' => "PDOException Error!"]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => "QueryException Error!"]);
        } catch (TokenMismatchException $e) {
            return redirect()->route('users.create');
        } catch (MethodNotAllowedHttpException $e) {
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);
        $roles = Sentinel::getRoleRepository()->pluck('name', 'id');
        $user_role = Sentinel::findById($user->id)->roles;

        return view('admin.users.edit', compact('user', 'roles', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'roles_id' => 'required',
        ]);

        try {
            if (trim($request->password) == "") {
                $input = $request->except('password');
            } else {
                $input = $request->all();
            }

            if ($file = $request->file('photo_id')) {

                $extension = $file->getClientOriginalExtension();

                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $file->move('img', $name);
                    $photo = Photo::create(['photo' => $name]);
                    $input['photo_id'] = $photo->id;
                } else {
                    return redirect()->back()->with(['error' => "You can Only Upload Jpg, jpeg, png image"]);
                }
            }

            $user = Sentinel::findById($id);
            $user_role = Sentinel::findById($user->id)->roles;
            $role = Sentinel::findRoleById($user_role[0]->id);
            $role->users()->detach($user);

            $user->update($input);
            $role = Sentinel::findRoleById($request->roles_id);

            $role->users()->attach($user);

            return redirect()->back()->with(['success' => "$request->first_name updated Successfully."]);
        } catch (PDOException $e) {
            return redirect()->back()->with(['error' => "PDOException Error!"]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => "QueryException Error!"]);
        } catch (TokenMismatchException $e) {
            return redirect()->route('users.update', $id);
        } catch (MethodNotAllowedHttpException $e) {
            return redirect()->route('users.update', $id);
        }
    }

    /**
     * Update the user in database as inactive
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inactive($id)
    {
        $user = Sentinel::findById($id);
        Activation::remove($user);
        $user->update(['status' => 0]);
        return redirect()->back()->with(['error' => $user->first_name . ' is now Inactive']);
    }

    /**
     * Update the user in database as inactive
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($id)
    {
        $user = Sentinel::findById($id);

        if (!Activation::exists($user)) {
            $activation = Activation::create($user);
        } else {
            $activation = Activation::exists($user);
        }

        if (Activation::complete($user, $activation->code)) {
            $user->update(['status' => 1]);
            return redirect()->back()->with(['success' => $user->first_name . ' is now Active']);
        } else {
            return redirect()->back()->with(['error' => $user->first_name . ' can not activate.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Sentinel::findById($id);

        if ($user->photo) {
            $image = Photo::findOrFail($user->photo_id);
            $image->delete();
            unlink(public_path() . $user->photo->photo);
        }
        Activation::remove($user);
        $user->delete();
        return redirect()->back()->with(['success' => $user->name . ' is Deleted']);
    }

    public function changePasswordForm()
    {
        return view('admin.users.change-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        try {
            $oldPassword = $request->old_password;
            $newPassword = $request->new_password;
            $user = Sentinel::getUser();

            $hasher = Sentinel::getHasher();
            if (!$hasher->check($oldPassword, $user->password)) {
                return redirect()->route('user.changePassword.form')->with(['error' => 'Wrong Password']);
            }

            if (trim($newPassword) !== "") {
                if (Sentinel::update($user, ['password' => $newPassword])) {
                    return redirect()->route('user.changePassword.form')->with(['success' => 'Password Changed Successfully']);
                }
            }

            return redirect()->route('user.changePassword.form')->with(['error' => 'Problem in changing password']);
        } catch (PDOException $e) {
            return redirect()->back()->with(['error' => "PDOException Error!"]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => "QueryException Error!"]);
        } catch (TokenMismatchException $e) {
            return redirect()->route('user.changePassword.form');
        } catch (MethodNotAllowedHttpException $e) {
            return redirect()->route('user.changePassword.form');
        }
    }
}
