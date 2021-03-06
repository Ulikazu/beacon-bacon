@extends('layouts.app')

@section('contentheader_title', 'Editing ' . $location->name)

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{ route('places.index') }}">Places</a></li>
  <li><a href="{{ route('places.show', $placeId) }}">{{ $location->place->name }}</a></li>
  <li><a href="{{ route('floors.show', [$placeId, $floorId]) }}">{{ $location->floor->name }}</a></li>
  <li><a href="{{ route('locations.show', [$placeId, $floorId, $location->id]) }}">{{ $location->name }}</a></li>
  <li class="active">Editing</li>
</ol>
@endsection

@section('content')

{!! Form::open(['route' => ['locations.update', $placeId, $floorId, $location->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
{!! Form::hidden('place_id', $placeId) !!}
{!! Form::hidden('floor_id', $floorId) !!}
{!! Form::hidden('type', 'block') !!}

<div class="row">
  <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            {!! Form::label('block_id', 'Building Block', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
              {!! Form::select('block_id', $blocks, $location->block_id, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
              {!! Form::text('name', $location->name, ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
            </div>
          </div>

          <div class="form-group">
			<h5 class="col-sm-2" style="font-size: 16px; text-align: right;">Findable Parameters</h5>
            <div class="col-sm-10"></div>
          </div>

          @if($location->findable)
          
          @if($location->findable->parameter_one_name)
	          <div class="form-group">
	            {!! Form::label('parameter_one', $location->findable->parameter_one_name, ['class' => 'col-sm-2 control-label']) !!}
	
	            <div class="col-sm-10">
	              {!! Form::text('parameter_one', $location->parameter_one, ['class' => 'form-control', 'placeholder' => 'Enter ' . $location->findable->parameter_one_name]) !!}
	            </div>
	          </div>          
		  @endif

          @if($location->findable->parameter_two_name)          
	          <div class="form-group">
	            {!! Form::label('parameter_two', $location->findable->parameter_two_name, ['class' => 'col-sm-2 control-label']) !!}
	
	            <div class="col-sm-10">
	              {!! Form::text('parameter_two', $location->parameter_two, ['class' => 'form-control', 'placeholder' => 'Enter ' . $location->findable->parameter_two_name]) !!}
	            </div>
	          </div>          
		  @endif
		  
          @if($location->findable->parameter_three_name)          
	          <div class="form-group">
	            {!! Form::label('parameter_three', $location->findable->parameter_three_name, ['class' => 'col-sm-2 control-label']) !!}
	
	            <div class="col-sm-10">
	              {!! Form::text('parameter_three', $location->parameter_three, ['class' => 'form-control', 'placeholder' => 'Enter ' . $location->findable->parameter_three_name]) !!}
	            </div>
	          </div>          
		  @endif
		  
          @if($location->findable->parameter_four_name)          
	          <div class="form-group">
	            {!! Form::label('parameter_four', $location->findable->parameter_four_name, ['class' => 'col-sm-2 control-label']) !!}
	
	            <div class="col-sm-10">
	              {!! Form::text('parameter_four', $location->parameter_four, ['class' => 'form-control', 'placeholder' => 'Enter ' . $location->findable->parameter_four_name]) !!}
	            </div>
	          </div>          
		  @endif
		  
          @if($location->findable->parameter_five_name)          
	          <div class="form-group">
	            {!! Form::label('parameter_five', $location->findable->parameter_five_name, ['class' => 'col-sm-2 control-label']) !!}
	
	            <div class="col-sm-10">
	              {!! Form::text('parameter_five', $location->parameter_five, ['class' => 'form-control', 'placeholder' => 'Enter ' . $location->findable->parameter_five_name]) !!}
	            </div>
	          </div>          
		  @endif

		  @endif

          <div class="form-group">
			<h5 class="col-sm-2" style="font-size: 16px; text-align: right;">Location on Map</h5>
            <div class="col-sm-10"></div>
          </div>

          <div class="form-group">
            {!! Form::label('posX', 'Position X', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
              {!! Form::text('posX', $location->posX, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('posY', 'Position Y', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
              {!! Form::text('posY', $location->posY, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('rotation', 'Rotation', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
              {!! Form::text('rotation', $location->rotation, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
          </div>

          <div class="form-group">
			<h5 class="col-sm-2" style="font-size: 16px; text-align: right;">Place Block on Map</h5>
            <div class="col-sm-10">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-2"></div>

            <div class="col-sm-10">
	            
	            <div id="floor-map-container" style="overflow: scroll; width: 100%;">

					<div id="floor-map" class="map" style="background-image: url({{ $location->floor->image }}); background-size: cover; cursor: crosshair; height: {{ $location->mapHeight }}px; overflow: hidden; position: relative; width: 100%; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; width: {{ $location->mapWidth }}px;">
				          @if($location->block->image)
						  	<div id="floor-block" style="cursor: move; height: {{ $location->imageHeight or 0 }}px; position: absolute; width: {{ $location->imageWidth or 0 }}px;">
								<img src="{{ $location->block->image }}" alt="" />
							</div>				          
				          
							
						  @endif
					</div>

	            </div>
		
            </div>
          </div>

        </div>
        <div class="box-footer">
          <a href="{{ route('floors.show', [$placeId, $floorId]) }}" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Save</button>
        </div>
      </div>
  </div>
</div>
{!! Form::close() !!}
@endsection

@section('footer')
<script>

var MAP_WIDTH = {{ $location->mapWidth }};
var MAP_HEIGHT = {{ $location->mapHeight }};

var IMAGE_WIDTH = {{ $location->imageWidth or 0 }};
var IMAGE_HEIGHT = {{ $location->imageHeight or 0 }};

Math.degrees = function ( radians ) {
	var degree = Math.round( radians * 180 / Math.PI );

	return degree < 0 ? 360 + degree : degree;
};

function calculate_image_position_x ( posX ) {
	return Math.round( posX - ( IMAGE_WIDTH / 2 ) );
}

function calculate_image_position_y ( posY ) {
	return Math.round( posY - ( IMAGE_HEIGHT / 2 ) );	
}

function floor_map () {
	var floor_map_width = $( '#floor-map-container' ).width();		
		
	var ratio = floor_map_width / MAP_WIDTH;
	var floor_map_height = Math.round( MAP_HEIGHT * ratio );
	
	$( '#floor-map-container' ).css( 'height', floor_map_height + 'px' );
	
	var posX = $( '#posX' ).val();
	var posY = $( '#posY' ).val();

	$( '#floor-block' ).css( {
		left : calculate_image_position_x( posX ),
		top : calculate_image_position_y( posY )
	} );	
}

$( window ).resize( function () {
	floor_map();
} );

$( document ).ready( function ( ) {
	floor_map();
	
	$( '#posX' ).keyup( function() {
		floor_map();
	} );
	
	$( '#posY' ).keyup( function() {
		floor_map();
	} );	

	$( '#floor-map' ).dblclick( function ( event ) {
		
		var posX = event.offsetX;
		var posY = event.offsetY;

		$( '#posX' ).val( posX );
		$( '#posY' ).val( posY );

		$( '#floor-block' ).animate( {
			left : calculate_image_position_x( event.offsetX ),
			top : calculate_image_position_y( event.offsetY )
		} );
	} );

    $( '#floor-block' ).rotatable( {
	    angle : {{  $location->imageRotation or 0 }},
        stop : function( event, ui ) {
			$( '#rotation' ).val( Math.degrees( ui.angle.current ) );
        },
        rotationCenterX : 50.0, 
        rotationCenterY : 50.0
    });

	$( '#floor-block' ).draggable( {
		containment: 'parent',
		opacity: .7,
		stop: function ( event, image ) {
			var posX = Math.round( image.position.left + ( IMAGE_WIDTH / 2 ) );
			var posY = Math.round( image.position.top + ( IMAGE_HEIGHT / 2 ) );

			$( '#posX' ).val( posX );
			$( '#posY' ).val( posY );
		}
	} );
} );
</script>
@endsection