@extends('adminlte::page')

@section('title', 'Permissions | Zuku Monitoring')

@section('content_header')
    <h1>Permissions</h1>
@stop

@section('content')
    <div class="card card-primary">
       <!-- /.card-header -->
              <div class="card-header">
                   <h3 class="card-title">Edit</h3>
              </div>
                     
                    <!-- form start --> 
                      <div class="card-body">
                        <form action="{{ route('permission.update',$permission['id']) }}" method="POST">
                          @csrf
                           @method('PUT')
                          <div class="form-group"> 
                          <label for="exampleInputEmail1">Permission name</label>
                          <input type="text" id="name" name="name"class="form-control"  placeholder="name" value="{{ $permission->name }}">
                              <span style="color:red">@error('name'){{ $message }}@enderror</span>
                      
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                              </div>
                     </form>
                        <div class="mt-6 p-2 bg-slate-100">
                          <h2 class="text-2xl font-semibold">Role</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                              @if($permission->roles)
                               @foreach ($permission->roles as $permission_roles )
                             <form class="px-4 py-2"
                              method="POST" 
                              action="{{ route('roles.permissions.revoke', [$permission->id,$rpermission_roles->id]) }}" onsubmit="return confirm('Are you sure you want to delete');">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="btn btn-danger">{{ $permission_roles->name }}
                                </button>
                            @endforeach
                           @endif
                          </div>
                         </div>
                         </form>
                        </div>
                     {{-- <div>
                       <form action="{{ route('roles.permissions',$permission->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1" >Role</label>
                          <select class="custom-select"id="role" name="role" ata-placeholder="select">
                              @foreach ($permission as $permission)
                                  <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                              @endforeach
                          </select>
                      </div> --}}
                     <div class="card-footer">
                       <button type="submit" class="btn btn-primary">Assign</button>
                       </div>
                      </form>
                    </div>
                 </div>
      </div>
    </div>
      <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop