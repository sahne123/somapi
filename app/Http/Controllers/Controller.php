<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $_validatorFields;
    protected $_validatorErrors;

    protected function _validate(Request $request, $isUpdate=false)
    {
      if($isUpdate)
      {
        $this->_validatorFields['id'] = 'required|numeric';
      }

      $validator = Validator::make($request->all(), $this->_validatorFields);

      if($validator->fails())
      {
        $this->_validatorErrors = 'Validation failed. ' . join(' ',$validator->errors()->all());
        return false;
      }
      else
      {
        return true;
      }

    }
}
