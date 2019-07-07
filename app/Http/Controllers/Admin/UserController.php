<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use App\UserGroup;
use App\Binnacle;
use App\Events\Binnacles;
use Auth;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    
     public function getAllUsers()
	{
		return [
            'users' => User::search(request()->search)->orderBy('id','desc')
                    ->get(),
             ];
	}

	public function getUsers()
	{
		
		$users = User::search(request()->search)->orderBy('id','desc')
					->paginate(5);

		return $categories;
	}

    public function updateAvatar(){

        if (count(request()->images)>0 && request()->images[0]['Base64Img'] != null) {

                $Base64Img = request()->images[0]['Base64Img'];
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $Base64Img = base64_decode($Base64Img);
                $file = file_put_contents(request()->images[0]['url'], $Base64Img);
                rename(public_path().'/'.request()->images[0]['url'],public_path().'/images/avatar_admin/'.request()->images[0]['url']);
                $folder = '/images/avatar_admin/';
                
                $user = User::where('id',$id)->update([
                    'image' => $folder . request()->images[0]['url'],
                ]);

                if ($user) {
                    $data=[
                        'ip' => request()->ip(),
                        'action' => 'update', 
                        'description' => 'Actualizacion de la imagen del perfil', 
                        'affected_table' => 'users',
                        'querry' => $user,
                        'user_id' => Auth::id(),
                    ];
                    event( new Binnacles($data));
                    $module = Module::create(request()->all());
                    $module->save();
                }

                return ['message' => trans('app.user.update_message')];

            }

    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function userList()
    {
        $users = User::all();
        $users->map(function($user){
            $user->full_name = $user->full_name;
        });

        return $users;
    }

    public function cityList()
    {
        return City::where('state_id', request()->state_id)
        ->orderBy('name')
        ->get();
    }

    public function stateList()
    {
        return State::all();
    }

    public function userGroupList()
    {
        return UserGroup::all();
    }

    public function index()
    {

        return User::search(request()->search)->orderBy('id','desc')
            ->paginate(5);
    }

    public function store()
    {
        $v = \Validator::make(request()->all(), [
              'name' => 'required|string|max:255',
            	'email' => 'required|string|email|max:255|unique:users',
            ]);

            $errors = $v->errors();
            $message=[];

            foreach ($errors->all() as  $mess) {
                $message[]=$mess.'  ';
            }

            if ($v->fails())
            {
                return ['message' => $message , 'status' => 0];
            }
        
        request() -> request -> add(['password' => Hash::make('secret')]);
        request() -> request -> add(['remember_token' => str_random(10)]);    
        $user = User::create(request()->all());
        
        if ($user->save()) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'Store', 
                'description' => 'registro de un nuevo usuario', 
                'affected_table' => 'users',
                'query' => $user,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }


        return [
            'message' => trans('app.user.store_message'),
            'user' => $user
        ];
    }

	public function update($id)
    {

           // return request()->all();
        try {

            // $v = \Validator::make(request()->all(), [
            //     'name' => 'required|string|max:255',
            // 		// 'email' => 'required|string|email|max:255|unique:users',
            // ]);

            // $errors = $v->errors();
            // $message=[];

            // foreach ($errors->all() as  $mess) {
            //     $message[]=$mess.'  ';
            // }

            // if ($v->fails())
            // {
            //     return ['message' => $message , 'status' => 0];
            // }

            $storeValue = null;
            if (!empty(request()->image[0]['dataURL'])) {

                $Base64Img = request()->image[0]['dataURL'];
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $Base64Img = base64_decode($Base64Img);

                $carbon = Carbon::now()->format('dmYHis');

                $imageUrl = $carbon.'.'.request()->image[0]['upload']['filename'];

                $file = file_put_contents($imageUrl, $Base64Img);

                rename(public_path().'/'.$imageUrl,public_path().'/images/avatar_admin/'.$imageUrl);
           
                $storeValue = '/images/avatar_admin/'. $imageUrl;

            }

            $user = User::find($id);
            $user->address = request()->address;
            $user->email = request()->email;
            $user->name = request()->name;
            $user->phone = request()->phone;
            if ($storeValue !=null) {
                $user->image = $storeValue;
            }
            
            if ($user->save()) {
                $data=[
                    'ip' => request()->ip(),
                    'action' => 'Update', 
                    'description' => 'Actualizacion datosdel usuario', 
                    'affected_table' => 'users',
                    'query' => $user,
                    'user_id' => Auth::id(),
                ];
                event( new Binnacles($data));
            }

            return [
                'message' => trans('app.user.update_message'),
                'user' => $user,
            ];

        }catch(\Exception $e){
            \Log::debug('llego a lupdate'.$e);
            return response()->json(['status', trans('app.user.error_update')], 500);
        }

    }

    public function delete($id)
    {
        $user = User::destroy($id);

        if ($user) {
            $data=[
                'ip' => request()->ip(),
                'action' => 'store', 
                'description' => 'Eliminacion de un usario', 
                'affected_table' => 'users',
                'query' => $user,
                'user_id' => Auth::id(),
            ];
            event( new Binnacles($data));
        }

        return ['message' => trans('app.condition.delete_message')];
    }

    public function authUser()
    {
        if (auth()->guest()) {
            return ['first_name' => 'guest'];
        }

        return auth()->user();
    }
}
