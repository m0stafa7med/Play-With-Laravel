<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
   public function hasOneRelation()
   {
    $user=\App\User::with(['phone'=>function($q)
    {
       $q->select('code','number','user_id');
    }])->find(1);
   return response()->json($user);
   }
}
