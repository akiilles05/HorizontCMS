@extends('layout')

@section('content')
    <div class='container main-container'>

        <div class="card mb-3">

            @include('breadcrumb', [
                'links' => [['name' => trans('settings.settings'), 'url' => route('settings.index')]],
                'page_title' => trans('System Update Center'),
                'stats' => [
                    ['label'=> 'Current version', 'value' => "v".$current_version->version]
                ]
            ])

        <div class="card-body">
        <section class='row'>

            <div class='col-md-4'
                style='/*max-height:400px;overflow-y:scroll;padding:0px;border:1px solid #9d9d9d;border-radius:5px;*/'>

                @if (count($available_list) > 0)
                    <a class="btn btn-info btn-block"
                        href="{{ config('horizontcms.backend_prefix') }}/settings/sys-upgrade">Install all</a><br><br>
                @endif


                <div class="list-group">


                    @foreach ($available_list as $available)
                        <a class="list-group-item">
                            <h5 class="list-group-item-heading">Available update: v{{ $available }}</h5>
                            <p class="list-group-item-text">Upgrade</p>
                        </a>
                    @endforeach


                    @foreach ($upgrade_list as $upgrade)
                        @if ($loop->first)
                            <a class="list-group-item active bg-primary border-0">
                                <h5 class="list-group-item-heading">Current Version: v{{ $upgrade->version }}</small></h5>
                                <p class="list-group-item-text">Installed:
                                    {{ $upgrade->created_at->format(\Settings::get('date_format', \Config::get('horizontcms.default_date_format'), true)) }}
                                </p>
                            </a>
                            <?php continue; ?>
                        @elseif($loop->last)
                            <a class="list-group-item bg-success text-white" style='border-radius:0px;cursor:pointer;'>
                                <h5 class="list-group-item-heading">System Core: {{ $upgrade->version }}</h5>
                                <p class="list-group-item-text">Installed:
                                    {{ $upgrade->created_at->format(\Settings::get('date_format', \Config::get('horizontcms.default_date_format'), true)) }}
                                </p>
                            </a>
                            <?php continue; ?>
                        @endif

                        <a class="list-group-item">
                            <h5 class="list-group-item-heading">{{ $upgrade->importance }} Update: v{{ $upgrade->version }}
                                <small>build: {{ $upgrade->build }}</small></h5>
                            <p class="list-group-item-text">Installed:
                                {{ $upgrade->created_at->format(\Settings::get('date_format', \Config::get('horizontcms.default_date_format'), true)) }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class='col-md-8' style='border: 1px solid #9d9d9d;min-height:400px;'>
                <br><br>

                @if (\Session::has('upgrade_console'))
                    {!! \Session::get('upgrade_console') !!}
                @endif

            </div>

        </section>

    </div>

    </div>
@endsection
