<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Users_new extends Authenticatable
{
    use HasFactory,HasApiTokens, Notifiable;

    protected $table='users_news';
    protected $fillable = [
        // 'id',
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'email',
        'password',
        'contact',
        'address',
        'active',
        'role',
    ];

    public function getAllUsers($request)
    {
        $data = $this->select(['*']);
            // return $data->get();
            return $data->paginate(5);
        
    }
    public function getUser($request){
        $data=$this->select(['*'])->where ( 'firstname', 'LIKE', $request->searchText . '%' )
                                ->orWhere ( 'lastname', 'LIKE', $request->searchText . '%' )
                                ->orWhere ( 'email', 'LIKE', $request->searchText . '%' )
                                ->orWhere ( 'id', 'LIKE', $request->searchText . '%' )
                                ->orWhere ( 'contact', 'LIKE', $request->searchText . '%' );
                                // ->orWhere ( 'address', 'LIKE', '%' . $request->searchText . '%' );
                                // ->orWhere ( 'gender', 'LIKE', '%' . $request->searchText . '%' );
        return $data->get();
    }

    // public function deleteUser($request){
    //     $data=$this->select(['*'])->where('id', 'LIKE', '%' . $request->id . '%');
    //     return $data->delete();
    // }

    // public function updateUser($request){
    //     $data=$this->select(['*'])->where('id', 'LIKE', '%' . $request->id . '%');
    //     return $data->update();
    // }
}
