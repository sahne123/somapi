<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Http\Controllers\Controller;

class GroupsCharactersController extends ResourceRelationController
{
  protected $_leadingResource = 'group';
  protected $_followingResource = 'character';
}
