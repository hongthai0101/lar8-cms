<form action="#" id="form-test-send-mail" class="m-form m-form--fit m-form--label-align-right">
    <div class="form-group">
        <label for="emailAddress">
            @lang('Email address')
        </label>
        <input type="email" class="form-control" name="email_address" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter email">
        <span class="m-form__help">
            Email received data test from admin
        </span>
    </div>
    <table class="table m-table m-table--head-bg-success">
        <thead>
        <tr>
            <th>
                @lang('Field')
            </th>
            <th>
                @lang('Content')
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($fields as $field)
            <tr>
                <td>
                    <code>{{$field}}</code>
                </td>
                <td>
                    <input type="text" class="form-control" name="{{$field}}" value="">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
