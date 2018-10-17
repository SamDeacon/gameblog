<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:api');

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // return User::latest()->paginate(10);
      $this->authorize('isAdminOrEditor');
      return User::latest()->paginate(10);

    }
    public function usersByName()
    {
      // return User::latest()->paginate(10);
      $this->authorize('isAdminOrEditor');
      return User::orderBy('name')->paginate(10);

    }
    public function usersByType()
    {
      // return User::latest()->paginate(10);
      $this->authorize('isAdminOrEditor');
      return User::orderBy('usertype')->paginate(10);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->authorize('isAdmin');
      $this->validate($request,[
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'usertype' => 'required',
      ]);

      if ($request['photo'] == NULL) {
        $set_photo = 'default-profile.png';
      } else {
        $set_photo = $request['photo'];
      }

      return User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'usertype' => $request['usertype'],
        'bio' => $request['bio'],
        'photo' => $set_photo,
        'password' => Hash::make($request['password']),
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request,[
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
          'password' => 'sometimes|string|min:6',
        ]);

        $currentPhoto = $user->photo;

        if ($request->photo != $currentPhoto) {
          $name = time().'.'.explode('/', explode(':', substr($request->photo, 0, strpos
          ($request->photo, ';')))[1])[1];

          \Image::make($request->photo)->save(public_path('img/profile/').$name);
          $request->merge(['photo' => $name]);

          $currentUserPhoto = public_path('img/profile/').$currentPhoto;
          if(file_exists($currentUserPhoto)){
            @unlink($currentUserPhoto);
          }
        }

        if(!empty($request->password)){
          $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
          'password' => 'sometimes|string|min:6',
          'usertype' => 'sometimes',
        ]);
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->authorize('isAdmin');

      $user = User::findOrFail($id);

      $user->delete();

      return['message' => 'User '.$id.' Deleted'];
    }
}
