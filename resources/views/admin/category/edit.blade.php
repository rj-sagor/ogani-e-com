@extends('admin.adminMaster')
@section('category') active @endsection
   
@section('admmincontent')




<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href ="">Rj sagor</a>
        <span class="breadcrumb-item active">Category</span>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="sl-pagebody">
    <div class="row row-sm">


   

      <div class="col-lg-6 m-auto">
        <div class="card mt-4 text-center ">
          <div class="card-header bg-dark text-light">
            <h4>Edit category</h4>
            

          </div>
          <div class="card-body">
          @if(session('success'))
                  <div class="alert alert-warning" role="alert">
                <strong>{{session('success') }}</strong>
               
              </div>              
               @endif
             
            
          
            <form action="{{url('/category/update',$data->id)}}" method="post">

            @csrf

              <div class="mb-10">
                <label for="" class="form-label">Category Name</label>
                <input style="color:black" type="text" name="category_name" class="form-control" value="{{$data->category_name}}" required>
              </div>
                
            
              
         <button type="submit" class="btn btn-success" style="padding: 3px 10px; margin-top: 10px; font-size: 18px;" >Update</button>
      </form>
     </div>
 </div>  
</div>
</div>
</div>
</div>
@endsection