@extends('admin.adminMaster')
@section('product') active show-sub @endsection
@section('manage.product') active @endsection
   
@section('admmincontent')




<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href ="">Rj sagor</a>
        <span class="breadcrumb-item active">products</span>
        <span class="breadcrumb-item active">Manage products</span>
    </nav>
    <div class="sl-pagebody">
    <div class="row row-sm">

    <div class="col-lg-12">
      <div class="container">
      <div class="card mt-4">
          <div class="card-header bg-dark text-light ">
           <h4>Mange Products</h4>
          </div>
          <div class="card-body">
          @if(session('succes'))
                  <div class="alert alert-success" role="alert">
                <strong>{{session('succes') }}</strong>
               
              </div>              
               @endif 
            <table class="table table-bordered">
              <thead>
                <th>Image</th>
                <th>Product name</th>
                <th>Product Quantity</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
              

              </thead>
              
            
              @if(session('active'))
                  <div class="alert alert-success" role="alert">
                <strong>{{session('active') }}</strong>
               
              </div>              
               @endif 
               
             


              <tbody>
                  
                  @forelse($products as $data)
                  <tr>
                     
                      <td>
                          <img src="{{asset($data->image_one)}}" width="50px" height="50px" alt="">
                      </td>
                      <td>{{$data->product_name}}</td>
                      <td>{{$data->product_quantity}}</td>
                      <td>{{$data->productToCategory->category_name}}</td>
                      <td>
                      @if($data->status== '1')
                     <button class="btn btn-sm  bg-dark text-light">Active</button>
                     @else
                     <button class="btn btn-danger btn-sm">Inactive</button>
                        @endif
                      </td>
                      <td style="color: black;">{{$data->created_at->format('d-m-y')}}</td>
                      <td>
                    <a href="{{url('admin/product/edit',$data->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="{{url('admin/product/delete',$data->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                    @if($data->status== '1')
                    <a href="{{url('/admin/product/inactive',$data->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-down"></i></a>
                    @else
                    <a href="{{url('/admin/product/active',$data->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-up"></i></a>
                    @endif
                  </td>
                  </tr>
                 
                  @empty
                          <tr>
                          <td class="text-danger  text-center" colspan="10">no data added yet</td>
                          </tr>
                         

                  @endforelse

              
             
              
              </tbody>

            </table>
          </div>
        </div>
           
      </div>
        </div>
   

    
     </div>
 </div>  
</div>
        

  




  


@endsection