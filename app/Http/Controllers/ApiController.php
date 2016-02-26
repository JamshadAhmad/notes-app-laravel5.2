<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index($id = null) {
    $notes = new \App\Note();
    if ($id == null) {
        $res = $notes->all();
    } else {
        $user = new \App\User();
        $user->id = $id;
        $res = $user->note;
    }
    return json_encode(array(
        'error' => false,
        'notes' => $res,
        'status_code' => 200
    ));
}
}
