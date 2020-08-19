<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
      public function hasOneRelation()
      {
      $user=\App\User::with(['phone'=>function($q)
      {
         $q->select('code','number','user_id');
      }])->find(1);
      return $user->phone->code;
      //return response()->json($user);

      
      }
      public function  hasOneRelationReverse()
      {
        $phone= Phone::with('user')->find(1);
        return $phone;
      }
      public function  getUserHasPhone()
      {
         return  User::whereHas('phone',function($q)
         {
            $q->where('code','4');
         })->get();
      }
         public function getUserNotHasPhone()
         {
            return User::whereDoesntHave('phone')->get();

         }
}
