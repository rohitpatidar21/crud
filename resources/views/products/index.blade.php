@extends('products.layout')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.css"/>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 50px">
            <div class="float-right" style="margin-bottom: 10px">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create</a>
            </div>
        </div>
    </div>
   
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
   
    <table class="table table-bordered" id="tblProducts" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th>Name</th>
            <th>Detail</th>
            <th>Action</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
            <th>Name</th>
            <th>Detail</th>
            <th>Action</th>
        </tr>
      </tfoot>
    </table>
      


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
    getProducts();
});
 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getProducts(){
    jQuery('#tblProducts').dataTable().fnDestroy();
    jQuery('#tblProducts tbody').empty();
    jQuery('#tblProducts').DataTable({
        processing: false,
        serverSide: true,
        ajax: {
            url: '{{ route('products.getProducts') }}',
            method: 'POST'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'action', name: 'action', orderable: false, searchable: false, "width": "20%"},
        ],
        order: [[0, 'asc']]
    });
}
</script>
@endsection