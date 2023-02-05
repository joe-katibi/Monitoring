@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
<h1 hidden ></h1>
@stop

@section('content')
    <div class="card card-success">
       <!-- /.card-header -->
       <div class="card-header">
        <input readonly class="form-control" style="color: green" name="category" value="Edit User">
   </div>

                    <!-- form start -->
                      <div class="card-body">
                        <form action="{{ route('users.update',$user['id']) }}" method="POST">
                          @csrf
                           @method('PUT')
                           <div class="callout callout-success">
                          <div class="form-group">
                          <label for="exampleInputEmail1">User name</label>
                          <input type="text" id="name" name="name"class="form-control"  placeholder="name" value="{{ $user->name }}">
                              <span style="color:red">@error('name'){{ $message }}@enderror</span>

                            <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Update User name</button>
                              </div>
                            </div>
                        </div>
                     </form>
                     <div class="callout callout-success">
                        <div class="mt-6 p-2 bg-slate-100">
                          <h2 class="text-2xl font-semibold">Roles</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                              @if($user->roles)
                               @foreach ($user->roles as $user_roles )
                             <form class="px-4 py-2"
                              method="POST"
                              action="{{ route('roles.remove', [$user->id,$user_roles->id]) }}" onsubmit="return confirm('Are you sure you want to delete');">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="btn btn-danger">{{ $user_roles->name }}
                                </button>
                            @endforeach
                           @endif
                          </div>
                         </div>
                        </div>
                         </form>
                     <div>
                       <form action="{{ route('users.roles',$user->id) }}" method="POST">
                        @csrf
                        <div class="callout callout-success">
                        <div class="mt-6 p-2 bg-slate-100">
                            <label  >Role</label>
                            <select class="custom-select"id="role" name="role" data-placeholder="select">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
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
