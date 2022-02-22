@extends('admin.adminMaster')
@section('coupon') active @endsection
   
@section('admmincontent')




<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href ="">Rj sagor</a>
        <span class="breadcrumb-item active">coupon</span>
    </nav>
    <div class="sl-pagebody">
    <div class="row row-sm">


   

      <div class="col-lg-4">
        <div class="card mt-4 ">
          <div class="card-header bg-dark text-light">
            <h4>Add coupon</h4>
            

          </div>
          <div class="card-body">
          @if(session('success'))
                  <div class="alert alert-warning" role="alert">
                <strong>{{session('success') }}</strong>
               
              </div>              
               @endif
             
            
          
            <form action="{{route('coupon.store')}}" method="post">

            @csrf

              <div class="mb-10">
                <label for="" class="form-label">coupon Name</label>
                <input style="color:black" type="text" name="coupon_name" class="form-control" placeholder="Enter coupon" required>
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
           <h4>Coupons</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <th>sl</th>
                <th>coupons name</th>
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
                  
                  @forelse($coupons as $coupon)
                  <tr>
                      <td style="color: black;">{{$loop->index +1}}</td>
                      <td style="color: black;">{{$coupon->coupon_name}}</td>
                      <td>
                      @if($coupon->status== '1')
                     <button class="btn btn-sm  bg-dark text-light">Active</button>
                     @else
                     <button class="btn btn-danger btn-sm">Inactive</button>
                        @endif
                      </td>
                      <td style="color: black;">{{$coupon->created_at->format('d-m-y')}}</td>
                      <td>
                    <a href="{{url('/coupon/edit',$coupon->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="{{url('/coupon/delete',$coupon->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                    @if($coupon->status== '1')
                    <a href="{{url('/coupon/inactive',$coupon->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-down"></i></a>
                    @else
                    <a href="{{url('/coupon/active',$coupon->id)}}" class="btn btn-sm bg-dark text-light"><i class="fa fa-arrow-up"></i></a>
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