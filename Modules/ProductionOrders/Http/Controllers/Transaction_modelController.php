<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Store;
use App\Models\Transaction_model;
use Illuminate\Http\Request;

class Transaction_modelController extends Controller
{
    public function index()
    {

        $data = Transaction_model::get();

        return view('admin.Transaction_model.index', compact('data'));
    }

}
