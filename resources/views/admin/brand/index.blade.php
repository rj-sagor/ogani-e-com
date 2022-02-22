@extends('admin.adminMaster')
@section('brand') active @endsection
   
@section('admmincontent')




<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href ="">Rj sagor</a>
        <span class="breadcrumb-item active">Brand</span>
    </nav>
    <div class="sl-pagebody">
    <div class="row row-sm">


   

      <div class="col-lg-4">
        <div class="card mt-4 ">
          <div class="card-header bg-dark text-light">
            <h4>Add Brand</h4>
            

          </div>
          <div class="card-body">
          @if(session('success'))
                  <div class="alert alert-warning" role="alert">
                <strong>{{session('success') }}</strong>
               
              </div>              
               @endif
             
            
          
            <form action="{{route('brand.store')}}" method="post">

            @csrf

              <div class="mb-10">
                <label for="" class="form-label">Brand Name</label>
                <input style="color:black" type="text" name="brand_name" class="form-control" placeholder="Enter brand" required>
              </div>
                
            
              
         <button type="submit" class="btn btn-success" style="padding: 3px 10px; margin-top: 10px; font-size: 18px;" >Add</button>
      </form>
     </div>
 </div>  
</div>
        

      <div class="col-lg-8">
      <div class="container">
      <div class="card mt-4">
          <div class="card-header bg-dark text-light ">
           <h4>Brnads</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <th>sl</th>
                <th>brand name</th>
                <th>status</th>
                <th>created_ at</th>
              

              </thead>
              
              @if(session('update'))
                  <div class="alert alert-warning" role="alert">
                <strong>{{session('update') }}</strong>
               
              </div>              
               @endif
                
              @if(session('delete'))
                  <div class="alert alert-danger" role="alert">
                <strong>{{session('delete') }}</strong>
               
              </div>              
               @endif


              <tbody>
                  
                  @forelse($data as $data)
                  <tr>
                      <td style="color: black;">{{$loop->index +1}}</td>
                      <td style="color: black;">{{$data->brand_name}}</td>
                      <td>
                      @if($data->status== '1')
                     <button class="btn btn-sm  bg-dark text-light">Active</button>
                     @else
                     <button class="btn btn-danger btn-sm">Inactive</button>
                        @endif
                      </td>
                      <td style="color: black;">{{$data->created_at->format('d-m-y')}}</td>
                      <td>
                    <a href="{{url('/brand/edit',$data->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="{{url('/brand/delete',$data->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                    @if($data->status== '1')
                    <a href="{{url('/brand/inactive',$data->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-down"></i></a>
                    @else
                    <a href="{{url('/brand/active',$data->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-up"></i></a>
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