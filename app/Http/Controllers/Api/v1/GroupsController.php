<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupsController extends ResourceController
{
  protected $_resource = 'group';

  protected $_validatorFields = [
    'name' => 'required',
  ];
}
