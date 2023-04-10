<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pos-tab-container">
    <div class="pos-tab-menu">
        <div class="list-group">
            <a href="{{ url('settings/users/create') }}"
               class="list-group-item text {{ (str_contains(url()->current(),'/users') && !str_contains(url()->current(),'/roles') && !str_contains(url()->current(),'/permissions')) ? 'active': ''   }}">
                Users
            </a>
            <a href="{{ url('settings/roles') }}"
               class="list-group-item text {{ (str_contains(url()->current(),'/roles') || (str_contains(url()->current(),'/roles') && str_contains(url()->current(),'/permissions')))? 'active': ''   }}">
                Roles
            </a>
            <a href="{{ url('settings/permissions') }}"
               class="list-group-item text {{ (str_contains(url()->current(),'/permissions') && !str_contains(url()->current(),'/roles'))? 'active': ''   }}">
                Permissions
            </a>
        </div>
    </div>
</div>

@push('stack_css')
    <style>
        div.pos-tab-container {
            z-index: 10;
            background-color: #ffffff;
            padding: 0 !important;
        }

        div.pos-tab-menu {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }

        div.pos-tab-menu div.list-group {
            margin-bottom: 0;
        }

        div.pos-tab-menu div.list-group > a {
            margin-bottom: 0;
        }

        div.pos-tab-menu div.list-group > a .glyphicon,
        div.pos-tab-menu div.list-group > a .fa {
            color: #5A55A3;
        }

        div.pos-tab-menu div.list-group > a:first-child {
            border-radius: 0;
            -mox-border-radius: 0;
        }

        div.pos-tab-menu div.list-group > a:last-child {
            border-radius: 0;
            -mox-border-radius: 0;
        }

        div.pos-tab-menu div.list-group > a.active,
        div.pos-tab-menu div.list-group > a.active .glyphicon,
        div.pos-tab-menu div.list-group > a.active .fa {
            background-color: #3c8dbc;
            color: #ffffff;
            border-color: #3c8dbc;
        }

        div.pos-tab-menu div.list-group > a.active:after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            margin-top: -13px;
            border-left: 0;
            border-bottom: 13px solid transparent;
            border-top: 13px solid transparent;
            border-left: 10px solid #3c8dbc;
        }

        div.pos-tab-content {
            background-color: #ffffff;
            /* border: 1px solid #eeeeee; */
            padding-left: 8px;
        }

        div.pos-tab div.pos-tab-content:not(.active) {
            display: none;
        }
    </style>
@endpush

@push('stack_js')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
