<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use \App\Http\Controllers\Controller;

abstract class ResourceRelationController extends Controller
{
  protected $_leadingResource;
  protected $_followingResource;

  private $_leadingSingular;
  private $_leadingClass;
  private $_followingSingular;
  private $_followingClass;
  private $_followingPlural;

  public function __construct()
  {
    $this->_leadingSingular   = strtolower($this->_leadingResource);
    $this->_followingSingular = strtolower($this->_followingResource);
    $this->_followingPlural   = str_plural($this->_followingSingular);
    $this->_leadingClass      = \App::make('App\\'.ucfirst($this->_leadingSingular));
    $this->_followingClass    = \App::make('App\\'.ucfirst($this->_followingSingular));
  }

  /**
   * Display a listing of the resource.
   *
   * @param  int  $group
   * @return \Illuminate\Http\Response
   */
  public function index($leadingId)
  {
    if($leadingModel = $this->_leadingClass->find($leadingId))
    {
      return response()->build([$this->_followingPlural => $leadingModel->characters], 200);
    }
    return response()->build(null, 404, $this->_leadingSingular.' not found.');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  int  $group
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store($leadingId, Request $request)
  {
    if($leadingModel = $this->_leadingClass->find($leadingId))
    {
      if(Validator::make($request->all(), [
        $this->_followingSingular => 'required|integer|min:1',
      ])->fails())
      {
        return response()->build(null, 422, 'Invalid '.$this->_followingSingular.'.');
      }
      if($followingModel = $this->_followingClass->find($request->{$this->_followingSingular}))
      {
        if($leadingModel->{$this->_followingPlural}->contains($followingModel->id))
        {
          return response()->build(null, 422, 'Relation already exists');
        }
        // TODO: Save Pivot Data
        call_user_func([$leadingModel, $this->_followingPlural])->attach($followingModel->id);
        return response()->build(null, 201);
      }
      return response()->build(null, 422, $this->_followingSingular.' not found.');
    }
    return response()->build(null, 422, $this->_leadingSingular.' not found.');
  }

  //TODO Update (PivotColumn)

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $group
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($leadingId, $followingId)
  {
    if($leadingModel = $this->_leadingClass->find($leadingId))
    {
      if($followingModel = $this->_followingClass->find($followingId))
      {
        if($leadingModel->{$this->_followingPlural}->contains($followingModel->id))
        {
          call_user_func([$leadingModel, $this->_followingPlural])->detach($followingModel->id);
          return response()->build(null, 200);
        }
        return response()->build(null, 422, 'Relation does not exist');
      }
      return response()->build(null, 422, $this->_followingSingular.' not found.');
    }
    return response()->build(null, 422, $this->_leadingSingular.' not found.');
  }
}
