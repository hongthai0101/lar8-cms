@extends('core/base::layouts.master')
@section('content')
    <x-portlet>
        <form class="m-form" action="{{route('admin.roles.update', $role->id)}}" method="POST">
            @csrf
            @method('PUT')
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
                            <label class="m-checkbox">
                                <input type="checkbox" name="permissions[]" value="{{$key}}" @if(in_array($key, $currentPermissions)) checked @endif>
                                    {{ $value }}
                                <span></span>
                            </label>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>

        <hr>
        <div class="row align-items-center">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6 m--align-right">
                <button type="submit" class="btn btn-brand">
                    @lang('Submit')
                </button>
                <span class="m--margin-left-10">
                   <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                </span>
            </div>
        </div>
        </form>
    </x-portlet>
@stop