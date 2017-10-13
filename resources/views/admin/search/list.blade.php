@extends('backpack::layout')

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
          <div class="col-lg-4 col-sm-6">
            {{ $property->name }}
            <a href="{{ url($crud->route) }}/watch/request/{{ $property->id }}"/>More Info</a>
          </div>
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
