@extends('adminlte::page')

@section('title', 'Edit-Roles | Zuku Monitoring')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
    <div class="card card-success">
              <div class="card-header">
                   <input readonly class="form-control" style="color: green" name="category" value="Edit Role">
              </div>

                    <!-- form start -->
                      <div class="card-body">
                        <form action="{{ route('roles.update',$role['id']) }}" method="POST">
                          @csrf
                           @method('PUT')
                           <div class="callout callout-success">
                          <div class="form-group">
                          <label for="exampleInputEmail1">Role name</label>
                          <input type="text" id="name" name="name"class="form-control"  placeholder="name" value="{{ $role->name }}">
                              <span style="color:red">@error('name'){{ $message }}@enderror</span>

                            <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Update Role</button>
                              </div>
                            </div>
                        </div>
                     </form>
                     <div class="callout callout-success">
                        <div class="mt-6 p-2 bg-slate-100">
                          <h2 class="text-2xl font-semibold">Role Permission </h2>
                            <div class="flex space-x-2 mt-4 p-2">
                              @if($role->permissions)
                               @foreach ($role->permissions as $role_permission )
                             <form class="px-4 py-2"
                              method="POST"
                              action="{{ route('roles.permissions.revoke', [$role->id,$role_permission->id]) }}" onsubmit="return confirm('Are you sure you want to delete');">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="btn btn-danger">{{ $role_permission->description }}
                                </button>
                            @endforeach
                           @endif
                          </div>
                         </div>
                        </div>
                         </form>
                     <div>
                       <form action="{{ route('roles.permissions',$role->id) }}" method="POST">
                        @csrf
                        <div class="callout callout-success">
                        <div class="mt-6 p-2 bg-slate-100">
                          <label >Role</label>
                          <select class="custom-select"id="role" name="role" ata-placeholder="select">
                              @foreach ($permission as $permission)
                                  <option value="{{ $permission->description }}">{{ $permission->description }}</option>
                              @endforeach
                          </select>
                          </div>
                     <div class="card-footer">
                       <button type="submit" class="btn btn-success float-right">Assign Role</button>
                       </div>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('role')  // id
</script>
@stop
