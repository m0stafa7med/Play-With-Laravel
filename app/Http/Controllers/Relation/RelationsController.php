<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
   public function hasOneRelation()
   {
    $user=\App\User::find(1);
    return response()->json($user);
   }
}
