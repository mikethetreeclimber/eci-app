<?php

namespace Modules\Crm\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Crm\Entities\Circuit;
use Illuminate\Routing\Controller;
use Modules\Crm\Entities\Customers;
use Illuminate\Contracts\Support\Renderable;

class CrmController extends Controller
{
    /**
     * Display a listing of the Circuits.
     */
    public function index()
    {
        return view('crm::index');
    }

     /**
     * Show the Circuit resource.
     */
    public function show(Circuit $circuit)
    {
        return view('crm::show', [
            'circuit' => $circuit
        ]);
    }

    /**
     * Show the Customer of a Circuit.
     */
    public function showCustomer(Circuit $circuit, Customers $customer)
    {
        return view('crm::customer.show', [
            'circuit' => $circuit,
            'customer' => $customer
        ]);
    }
}
