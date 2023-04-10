@extends('adminlte::page')

@section('title', 'View User')

@section('content_header')
    <h1 hidden>View User</h1>
@stop

@section('content')
<div class="container">

<div class="col">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-success">
        <h3 class="widget-user-username">{{ $user->name }}</h3>
        <h5 class="widget-user-desc">{{ $user->position }}</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="/vendor/adminlte/dist/img/user1-128x128.jpg" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="callout callout-success">
        <div class="row">
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">Country</h5>
              <span class="text">{{ $user->country_name }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">E-mail</h5>
              <span class="text">{{ $user->email }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">Service</h5>
              <span class="text">
                @if ($user->services == '1')

                <a disable class="badge badge-success" >Cable</a>

                 @else

               <a disable class="badge badge-primary">DTH</a>

                 @endif

            </span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
           <div class="col-sm-3 border-right">
            <div class="description-block">
              <h5 class="description-header">Category</h5>
              <span class="text">{{ $user->category_name }}</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-2 ">
            <div class="description-block">
              <h5 class="description-header">Status</h5>
              <span class="text">

                @if ($user->user_status == '1')
                  <a disable class="badge badge-success" >Active</a>
                @else
                <a disable class="badge badge-danger" >Inactive</a>
                @endif

              </span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
       </div>
        <div class="callout callout-success">
            <div class="row">
            <div class="mt-6 p-2 bg-slate-100">
                <h2 class="text-2xl font-semibold">Roles</h2>
                  <div class="flex space-x-2 mt-4 p-2">
                    @if($user->roles)
                     @foreach ($user->roles as $user_roles )
                   <form class="px-4 py-2"
                    method="POST"
                    action="[$user->id,$user_roles->id]" >
                     <button disabled class="btn btn-info">{{ $user_roles->name }}
                      </button>
                  @endforeach
                 @endif
                </div>
               </div>
            </div>
        </div>
        <div class="callout callout-success">
            <div class="row">
            <div class="mt-6 p-2 bg-slate-100">
                <h2 class="text-2xl font-semibold">Permission</h2>
                  <div class="flex space-x-2 mt-4 p-2">
                    @if($user->permission)
                    @foreach ($user->permissions as $role_permission )
                   <form class="px-4 py-2"
                    method="POST"
                    action="[$role->id,$role_permission->id]" >
                     <button  class="btn btn-info">{{ $role_permission->description  }}
                      </button>
                  @endforeach
                 @endif
                </div>
               </div>
        </div>
        </div>

      </div>
    </div>
    <!-- /.widget-user -->
  </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
@stop

@section('js')
<script src="sweetalert2.min.js"></script>
    <script>

$('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'User Deleted',
        class: 'bg-success',
        autohide: true,
        delay: 750,
      })
    });
    $('.toastsDefaultAutohide@').click(function() {
      $(document).Toasts('create', {
        title: 'User Deleted',
        class: 'bg-danger',
        autohide: true,
        delay: 750,
      })
    });


    </script>
@stop
