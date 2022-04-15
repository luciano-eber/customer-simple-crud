<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\InertiaCrudController;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\Customer\Update as CustomerUpdate;

class CustomerController extends InertiaCrudController
{
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        return parent::_index(
            $view = 'Admin/Dashboard', 
            $paginate = 15, 
            $search = $search, 
            $searchFields = [ 'nome', 'uf', 'localidade' ]
        );
    }

    public function destroy(int $id)
    {
        return parent::_destroy($id);
    }

    public function edit(int $id)
    {
        return parent::_edit('Admin/Customer/Edit', $id);
    }

    public function update(CustomerUpdate $request, int $id)
    {
        return parent::__update($request->all(), $id);
    }
}
