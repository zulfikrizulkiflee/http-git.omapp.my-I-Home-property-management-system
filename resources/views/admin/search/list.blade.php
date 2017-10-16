@extends('backpack::layout')

<style>
    .box{
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
</style>

@section('header')
	<section class="content-header">
	  <h1>
	    <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
	    <small>{{ trans('backpack::crud.all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
<div class="row">

  <!-- THE ACTUAL CONTENT -->
  <div class="col-md-12">
    <div class="box">
      <div class="box-body" />
      <div class="row">
          @foreach ($properties as $property)
          <div class="col-lg-3 col-sm-6 col-md-4">

            <div class="card hovercard">
                <div class="cardheader">
                    <img src="https://media.timeout.com/images/103281049/630/472/image.jpg" height="100%" width="100%">
                </div>
                <div class="avatar">
                    <img alt="" src="https://placehold.it/160x160/00a65a/ffffff/&text=1">
                </div>
                <div class="info">
                    <div class="title">
                        <a target="_blank" href="#">{{ $property->name }}</a>
                    </div>
                    <div class="desc">{{ $property->city }}</div>
                </div>
                <div class="bottom">
                    <a class="btn btn-primary btn-sm" rel="publisher" href="#">
                        Request
                    </a>
                </div>
            </div>

        </div>
<!--
          <div class="col-lg-4 col-sm-6">
            {{ $property->name }}
              <img src="">
            <a href="{{ url($crud->route) }}/watch/request/{{ $property->id }}"/>More Info</a>
          </div>
-->
          @endforeach
      </div>
          <!-- this is the pagination -->
          {{ $properties->links() }}
      </div>
    </div>
    <!-- END THE ACTUAL CONTENT -->
  </div>
<!-- END Default box -->
</div>

@endsection
