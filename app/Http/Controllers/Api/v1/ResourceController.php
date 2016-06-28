<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Http\Controllers\Controller;

abstract class ResourceController extends Controller
{
  private $_singular;
  private $_plural;
  private $_class;
  protected $_resource;

  public function __construct()
  {
      $this->_singular = strtolower($this->_resource);
      $this->_plural = str_plural($this->_singular);
      $this->_class = \App::make('App\\'.ucfirst($this->_singular));
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return response()->build(
      [$this->_plural => $this->_class->all()],
      200
    );
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
      if($model = $this->_class->create($request->all()))
      {
        return response()->build([$this->_singular => $model], 201);
      }
      return response()->build(null, 422, 'Error saving Resource.');
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
    if($model = $this->_class->find($id))
    {
      return response()->build([$this->_singular => $model], 200);
    }
    return response()->build(null, 404, 'Resource not found.');
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
      if($model = $this->_class->find($id))
      {
        if($this->_validate($request, true))
        {
          if($model->update($request->all()))
          {
            return response()->build([$this->_singular => $model], 200);
          }
          return response()->build(null, 422, 'Error saving Resource.');
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
    if($model = $this->_class->find($id))
    {
      $model->delete();
      return response()->build([$this->_singular => $model], 202);
    }
    return response()->build(null, 204);
  }

}
