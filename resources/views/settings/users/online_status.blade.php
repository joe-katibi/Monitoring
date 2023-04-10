@extends('adminlte::page')
@section('title', 'General Configuration | Users Online Status')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-users"></i>
            Users Online Status
        </h3>

    </div>
    <div class="box-body">
        <table class="table table-striped table-bordered" id="online_users_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 0 ?>
                @foreach($users as $key=> $user)
                <?php
                if(!$user->isOnline()){continue;}
                $num++
                ?>
                <tr>
                    <td>{{$num}}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->isOnline())
                        <li class="text-success">Online</li>
                        @else
                        <li class="text-muted">Offline</li>
                        @endif
                    <td>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}">
<style>
    /* .user-block .username, .user-block .description, .user-block .comment {
            margin-left: 0 !important;
        } */
</style>
@stop


@section('js')
<script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="/js/jquery.steps.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
            $('#online_users_table').DataTable({
                "dom": 'lfrtip',
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });

        });
</script>
@stop

