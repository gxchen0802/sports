@extends('cms.layouts.default')

@include('cms.categories.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          @include('cms.layouts.notice')

          <h2 class="sub-header">创建二级栏目</h2>

        {{ Form::open(array('action' => array('CategoriesController@storeParent'), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="parent" class="col-sm-2 control-label">一级栏目</label>
              <div class="col-sm-6">
                <select class="form-control" name="child">
                  @foreach ($records as $record)
                    <option value="{{ $record->parent }}">{{ $record->parent }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="parent" class="col-sm-2 control-label">二级栏目</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="parent" placeholder="二级栏目">
              </div>
            </div>

            <div class="form-group">
              <label for="parent" class="col-sm-2 control-label">栏目文章是否唯一</label>
              <div class="col-sm-6">
                <div class="radio">
                  <label>
                    <input type="radio" name="single" id="optionsRadios1" value="yes" checked>唯一
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="single" id="optionsRadios1" value="no">不唯一
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
              </div>
            </div>

          {{ Form::close() }}

@stop
