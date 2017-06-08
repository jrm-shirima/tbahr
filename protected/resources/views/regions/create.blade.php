@extends('layout.master')
@section('page-title')
    {{"Add Region"}}
@endsection
@section('header')
     @include('layout.header')
@endsection
@section('main-right-navigation')
     @include('layout.main-right-navigation')
@endsection
@section('main-home')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Region</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           <div class="row">
            <div class="col-md-8 col-sm-8 pull-left" id="output">
            
            </div>

            </div>
            <div class="row">
                <form id="formAddRegion" action="{{url('regions')}}" method="POST">
                  {{ csrf_field() }}
                 <div class="col-lg-6">
                         <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter region name">
                          </div>
                          <div class="form-group">
                            <label for="district">District</label>
                            <input  type="text" class="form-control" id="district" name="district" placeholder="Enter district name">
                          </div> 
                          <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Submit</button>
                  </form>                         
                </div>
            </div>       
</div>
@endsection
@section('scripts')
 <script>
     $(document).ready(function(){
      
      var formObject = $("#formAddRegion");
      formObject.on('submit',function(){
          
              var postData = formObject.serializeArray();
              var formURL  = formObject.attr("action");
            
                submitData(postData, formURL);         
          
          return false;
          });         
       
      
     
    function submitData(postData, formURL){
        
        
        $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                         console.log(data);
                        setTimeout(function() {
                            $("#output").html("");
                        }, 2000);
                    },
                    error: function(jqXhr,status, response) {
                        console.log(jqXhr);
                        if( jqXhr.status === 401 ) {
                           // location.replace('{{url('login')}}');
                        }
                        if( jqXhr.status === 400 ){
                            
                            var errors = jqXhr.responseJSON.errors;
                            var errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';
                            $('#output').html(errorsHtml);
                            
                        }else{
                            $('#output').html(jqXhr.message);
                        }
                    }
                });
    }
     
     
     
     });
      
      
     
 </script>
@endsection
@section('footer')
     @include('layout.footer')
@endsection
