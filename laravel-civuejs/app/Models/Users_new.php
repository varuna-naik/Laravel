<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_new extends Model
{
    use HasFactory;

    protected $table='users_news';
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'gender',
        'birthday',
        'email',
        'contact',
        'address'
    ];

    public function getAllUsers($request)
    {
        $data = $this->select(['*']);
            // return $data->get();
            return $data->paginate(5);
        
    }
    public function getUser($request){
        $data=$this->select(['*'])->where ( 'firstname', 'LIKE', '%' . $request->first_name. '%' );
                                // ->orWhere ( 'email', 'LIKE', '%' . $request . '%' )->get ();
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
