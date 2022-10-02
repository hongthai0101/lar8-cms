<form action="#" id="form-mail-template-update-field" class="m-form m-form--fit m-form--label-align-right">
<table class="table m-table m-table--head-bg-success">
    <thead>
    <tr>
        <th>
            @lang('Field')
        </th>
        <th>
            @lang('Model')
        </th>
        <th>
            @lang('Content')
        </th>
    </tr>
    </thead>
    <tbody>
        @foreach($replaces as $field)
            <tr>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="field" readonly value="{{$field}}">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control is-valid select-update-field" name="model">
                            @foreach($models as $key => $model)
                                <option data-fillable='@json($model['fillable'])' value="{{$model['namespace']}}">{{$model['label']}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <select class="form-control is-valid select-fillable" name="fillable">
                    </select>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</form>
