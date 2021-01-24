<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">

</head>

<body>

<div class="container">
  <div class="row">
   <div class="col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading">Module <button type="button" class="btn btn-primary pull-right btn-sms" data-toggle="modal" data-target="#myModal">Add</button></div>
        <div class="panel-body">

         <div class="row">
            <div class="col-md-12">
                  @if($categories->count()>0)
                    <ul id="tree1">
                        @foreach($categories as $category)
                            <li>
                                {{ $category->title }}
                                <a  onclick="moduleView({{ $category->id }})"><span class="badge badge-pill badge-primary">View</span></a>
                                <a onclick="deletemod({{ $category->id }})"><span class="badge badge-pill badge-danger">Delete</span></a> 
                                
                                @if(count($category->childs))
                                    @include('category.manageChild',['childs' => $category->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                  @else
                    <div class="text-center">
                      <h4> <strong>No Module Found</strong></h4>
                    </div>
                  @endif
            </div>
        </div>
      </div>
    </div>
  </div>


 
<div class="col-md-8">
  <div class="panel panel-primary">
     <div class="panel-heading">
         Test Case
         @if(($testcasevalue->count()>0))
         - @php
         $temp = $testcasevalue->first(); 
         @endphp
         {{ $temp->module }}
         @endif
         <button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#addtestcasevalue">Add</button>
      </div>

      <div class="panel-body">
        <div class="row">
          @if(($testcasevalue->count()>0))
            <div class="col-md-12">
              <div class="form-group">
               <table class="table table-bordered data-table">
                <thead>
                 <tr>
                    <th>No</th>
                    <th>Module</th>
                    <th>Summary</th>
                    <th>Description</th>
                    <th>Attachment</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                   @php
                     $i=1;
                  @endphp
                @foreach ($testcasevalue as $testcase)
               <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $testcase->module }}</td>
                  <td>{{ $testcase->summary }}</td>
                  <td>{{ $testcase->description }}</td>
                  <td><a href="{{url('Download',$testcase->id)}}">{{ $testcase->filename}}</a></td>
                  <td><a style="height: 25px"  data-toggle="modal" data-target="#edittestcase{{ $testcase->id }}"><i class="fa fa-pencil-square-o" style="font-size:22px;color:blue"></i></a> 
                  <a style="height: 25px" id="deletetestcase" href="{{ url('deletetestcase',$testcase->id) }}" ><i class="fa fa-trash-o" style="font-size:22px;color:red"></i></a></td>
               </tr>
                @endforeach
                </tbody>
              </table>
              </div>
            </div>
          @else
            <div class="text-center">
            <h4> <strong>No Test Case Found</strong></h4>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Module / Sub Module</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="category" method="POST" action="{{ route('add.category') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                        <label>Module:</label>
                        <select id="parent_id" name="parent_id" class="form-control">
                            <option value="0">Select</option>
                            @foreach($allCategories as $rows)
                                    <option value="{{ $rows->id }}">{{ $rows->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <span class="text-red" role="alert">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input type="text" id="title" name="title" value="" class="form-control" placeholder="Please Enter the module name">
                        @if ($errors->has('title'))
                            <span class="text-red" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-danger pull-right btn-sm" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success pull-right btn-sm">Save</button>
                    </div>
                 </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  


<div class="modal" id="addtestcasevalue" role="dialog" aria-labelledby="myModalLabel1"  aria-hidden="true">
          <div class="modal-dialog ">
             <form role="form" id="testcase" method="POST" action="{{ route('add.testcase') }}" enctype="multipart/form-data">
                @csrf
           
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Add Test Case</h4 >
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div><!-- Modal header -->

                <div class="modal-body">

                  <div class="col-md-12">
                    <input type="hidden" name="FileUploadQE_ID" value="">

                    <div class="form-group row">
                      <label for="Category" class="col-md-4 label-control">Select Module *</label>
                      <div class="col-md-8">
                        <select name="module_id" id="module" required="required" class="form-control fileval">
                         
                          <option value="">select</option>
                          
                        @foreach($allCategories as $category)
                            <option value=" {{ $category->id }}"> {{ $category->title }}</option>
                    
                          @endforeach  
                        
                        </select>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label  class="col-md-4 label-control">Test Case Summary</label>
                      <div class="col-md-8">
                        <textarea name="summary" class="form-control fileval" placeholder="Add Summary" required></textarea>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label class="col-md-4 label-control">Description</label>
                      <div class="col-md-8">
                        <textarea name="description" class="form-control fileval" placeholder="Add Description"></textarea>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label class="col-md-4 label-control">File Upload *</label>
                      <div class="col-md-8">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" required="required" name="file">
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->
                  </div><!-- row -->
                </div><!-- Modal body -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-md pull-left" data-dismiss="modal">Cancel</button>
                  <button id="Attachment_submit" type="submit" class="btn btn-success btn-md block-page">Save</button>
                </div><!-- Modal footer-->
              </div><!-- Modal content-->
          </form>
    </div><!-- Modal-dialog -->
  </div><!-- Modal -->

 @foreach ($testcasevalue as $testcase)
  <div class="modal" id="edittestcase{{ $testcase->id }}">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Edit Module </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                         <form role="form" id="edittestcase" method="POST" action="{{ url('edittestcase',$testcase->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label class="control-label">Module</label>
                        <input type="text"  name="module" value="{{ $testcase->module }}" class="form-control" readonly>
                    </div>
                   <div class="form-group">
                      <label class="control-label">Summary</label>
                        <textarea value="{{ $testcase->summary }}" name="summary"  class="form-control">{{ $testcase->summary }}</textarea>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Description</label>
                        <textarea value="{{ $testcase->description }}" name="description"  class="form-control">{{ $testcase->description }}</textarea>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-danger pull-right btn-sm" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success pull-right btn-sm">Save</button>
                    </div>
                </form>
            </div>
          </div> 
        </div>
      </div>
    </div>
   </div>
  @endforeach
</div>


  
        
        

<script src="{{ asset('js/treeview.js') }}"></script>
<script>
  $('#deletetestcase').on('click', function(){
    event.preventDefault();
    var confirmation = confirm("Are you sure you want to Delete the Test Case?");
    
    if (confirmation) {
        window.location.href=$(this).attr('href');
    }
    else{
       swal("Cancelled", "Your Data is safe ","error");
    }
  })
 </script>
 <script type="text/javascript">
     function moduleView(id)
     {

        window.location.href="{{ url('gettestcase') }}/"+id;
     }

</script>
<script type="text/javascript">
     function deletemod(id)
     {
   var confirmation = confirm("Are you sure you want to Delete the Module?");
    
    if (confirmation) {
       window.location.href="{{ url('deletemodule') }}/"+id;
    }
    else{
       swal("Cancelled", "Your Data is safe ","error");
    }     
     }
 </script>

</body>
</html>