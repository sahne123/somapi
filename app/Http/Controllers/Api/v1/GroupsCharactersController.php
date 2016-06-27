<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Http\Controllers\Controller;

class GroupsCharactersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  int  $group
   * @return \Illuminate\Http\Response
   */
  public function index($group)
  {
      //
      return $this->_response(['characters' => []], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  int  $group
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store($group, Request $request)
  {
      //
      return $this->_response(['character' => []], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $group
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($group, $id)
  {
      //
      return $this->_response(['character' => []], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $group
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $group, $id)
  {
      //
      return $this->_response(['character' => []], 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $group
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($group, $id)
  {
      //
      return $this->_response(['character' => []], 204);
  }
}