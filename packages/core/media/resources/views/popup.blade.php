@if (request()->input('media-action') === 'select-files')
    <html>
        <head>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            {!! Assets::renderHeader(['core']) !!}
            {!! Media::renderHeader() !!}
        </head>
        <body>
            {!! Media::renderContent() !!}

            @include('core/base::elements.common')
            {!! Assets::renderFooter() !!}
            {!! Media::renderFooter() !!}
        </body>
    </html>
@else
    {!! Media::renderHeader() !!}

    {!! Media::renderContent() !!}

    {!! Media::renderFooter() !!}
@endif
