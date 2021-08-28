@extends('products.layout')
 
      @section('content')
      
      <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 50px">
            <div class="float-right" style="margin-bottom: 10px">
                <a class="btn btn-success" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
      </div>
      <div class="card shadow mb-4">
        {!! Form::open(['method' => 'POST', 'route' => isset($product->id)?['products.update',$product->id]:['products.store'],'class' => 'form-horizontal','id' => 'form', 'files' => true]) !!}
        @csrf
        @if(isset($product->id))
        @method('PUT')
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($product->id)?'Edit':'Add' }} Form</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 form-group {{$errors->has('name') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                        <label for="name">Name <span style="color:red">*</span></label>
                        {!! Form::text('name', old('name', isset($product->name)?$product->name:''), ['id'=>'name', 'class' => 'form-control', 'placeholder' => 'Name']) !!}

                        @if($errors->has('name'))
                        <p class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                        @endif
                    </div>

                    <div class="col-md-12 form-group {{$errors->has('detail') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                        <label for="detail">Detail <span style="color:red">*</span> </label>
                        {!! Form::textarea('detail', old('detail',isset($product->detail)?$product->detail:''), ['class' => 'form-control', 'placeholder' => 'Detail', 'rows' => 3]) !!}

                        @if($errors->has('detail'))
                        <p class="help-block">
                            <strong>{{ $errors->first('detail') }}</strong>
                        </p>
                        @endif
                    </div>  
                </div>
                
            </div>
        </div>  
        <div class="card-footer">
            <button type="submit" class="btn btn-responsive btn-primary btn-sm">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
 
    @endsection
   
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
     
        $(document).ready(function () {
     
        $('#form').validate({ 
            rules: {
                name: {
                    required: true
                },
                detail: {
                    required: true
                }
                
            }
        });
    });
    </script>
 