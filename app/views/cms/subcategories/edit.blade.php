@extends('cms.layouts.default')

@include('cms.subcategories.sidebar')

@section('content')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

          @include('cms.layouts.notice')

          <h2 class="sub-header">编辑二级栏目</h2>

        {{ Form::open(array('action' => array('SubcategoriesController@update', $subcategory->id), 'class' => 'form-horizontal')) }}

            <div class="form-group">
              <label for="category_id" class="col-sm-2 control-label">一级栏目</label>
              <div class="col-sm-6">
                <select class="form-control" name="category_id">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">二级栏目</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="二级栏目" value="{{ $subcategory->name }}">
              </div>
            </div>

            <div class="form-group">
              <label for="single_article" class="col-sm-2 control-label">栏目文章是否唯一</label>
              <div class="col-sm-6">
                <div class="radio">
                  <label>
                    <input type="radio" name="single_article" id="optionsRadios1" value="1" {{ $subcategory->single_article == '1' ? 'checked' : '' }}>唯一
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="single_article" id="optionsRadios1" value="0" {{ $subcategory->single_article == '0' ? 'checked' : '' }}>不唯一
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
