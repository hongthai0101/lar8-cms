@extends('core/base::layouts.master')
@section('content')
    <div class="row">
        <div class="col-5">
            <x-portlet title="{{__('General')}}">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            @lang('Name')
                        </th>
                        <th>
                            @lang('Slug')
                        </th>
                        <th>
                            @lang('Description')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{$role->name}}
                        </td>
                        <td>
                            {{$role->slug}}
                        </td>
                        <td>
                            {{$role->description}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </x-portlet>
        </div>
        <div class="col-7">
            <x-portlet title="{{__('Assign')}}">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            @lang('Stt')
                        </th>
                        <th>
                            @lang('Name')
                        </th>
                        <th>
                            @lang('Email')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-portlet>
        </div>
        <div class="col-12">
            <x-portlet title="{{__('Permission')}}">
                <div class="m-form__group form-group row">
                    <table class="table table-striped m-table">
                        <tbody>
                        @foreach($permissions as $resource => $permission)
                            <tr>
                                <th scope="row">
                                    {{$resource}}
                                </th>
                                @foreach($permission as $key => $value)
                                    <td>
                                        {{ $value }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-portlet>
        </div>
    </div>

@stop