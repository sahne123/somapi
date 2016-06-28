<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CharactersController extends ResourceController
{
  protected $_resource = 'character';

  protected $_validatorFields = [
    'name'       => 'required',
    'keywords'   => 'required',
    'level'      => 'required|integer|min:1',
    'initiative' => 'required|integer|min:0',
    'agility'    => 'required|integer|min:0',
    'cunning'    => 'required|integer|min:0',
    'spirit'     => 'required|integer|min:0',
    'strength'   => 'required|integer|min:0',
    'lore'       => 'required|integer|min:0',
    'luck'       => 'required|integer|min:0',
    'maxgrit'    => 'required|integer|min:0',
    'combat'     => 'required|integer|min:0',
    'range'      => 'required|integer|min:0',
    'melee'      => 'required|integer|min:0',
    'health'     => 'required|integer|min:0',
    'defense'    => 'required|integer|min:0',
    'sanity'     => 'required|integer|min:0',
    'willpower'  => 'required|integer|min:0',
  ];
}
