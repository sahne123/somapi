<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use \App\Http\Controllers;
use \App\Http\Controllers\Controller;

use \App\Group;

class GroupsController extends Controller
{
  protected $_validatorFields = [
    'name' => 'required',
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->build(['groups' => Group::all()], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if($this->_validate($request))
    {
      if($group = Group::create($request->all()))
      {
        return response()->build(['group' => $group], 201);
      }
      return response()->build(null, 422, 'Error saving Group.');
    }
    return response()->build(null, 422, $this->_validatorErrors);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    if($group = Group::find($id))
    {
      return response()->build(['group' => $group], 200);
    }
    return response()->build(null, 404, 'Group not found.');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    if( $request->input('id') == $id)
    {
      if($group = Group::find($id))
      {
        if($this->_validate($request, true))
        {
          if($group->update($request->all()))
          {
            return response()->build(['group' => $group], 200);
          }
          return response()->build(null, 422, 'Error saving Group.');
        }
        return response()->build(null, 422, $this->_validatorErrors);
      }
      return response()->build(null, 204);
    }
    return response()->build(null, 400, 'Id mismatch.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if($group = Group::find($id))
    {
      $group->delete();
      return response()->build(['group' => $group], 202);
    }
    return response()->build(null, 204);
  }


}
