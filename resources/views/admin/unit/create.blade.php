@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
          @if ($crud->hasAccess('list'))
            <a href="{{ url($crud->route) }}">
                <i class="fa fa-chevron-circle-left"></i>
            </a>
          @endif
          {{ trans('backpack::crud.add') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.add') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Default box -->

		@include('crud::inc.grouped_errors')

		  {!! Form::open(array('url' => $crud->route, 'method' => 'post', 'files'=>$crud->hasUploadFields('create'))) !!}
		  <div class="box">

		    <div class="box-header with-border">
		      <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
		    </div>
		    <div class="box-body row">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
		      @else
		      	@include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
		      @endif
		    </div><!-- /.box-body -->
		    <div class="box-footer">

                @include('crud::inc.form_save_buttons')

		    </div><!-- /.box-footer-->

		  </div><!-- /.box -->
		  {!! Form::close() !!}
	</div>
</div>

@endsection

@section('custom_scripts')
<script type="text/javascript">
  jQuery(document).ready(function($) {
    _load();

    $("select[name='properties_id']").change(function() {
      _load();
    });

    function _load(){
      var property_id = $("select[name='properties_id']").val();

      $.get("{{ url($crud->route) }}/block_with_property_id/"+property_id, function (obj) {
        var selectbox = $("select[name='block_id']");
        $("#select2-chosen-4").html("- Please Select -");
        selectbox.empty();
        var list = '';
        for (var j = 0; j < obj.data.length; j++){
          list += "<option value='" +obj.data[j].id+ "'>" +obj.data[j].name+ "</option>";
        }
        selectbox.html(list);
      });
      $("#s2id_autogen3").parent().show();
    }
  });
</script>
@endsection
