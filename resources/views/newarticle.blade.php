<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('storage/css/articles.css') }}">
    <script src="{{ asset('storage/js/newarticle.js') }}" defer></script>

</head>

<body>
    <div id="testingID">
        @verbatim
            <siteheader></siteheader>
        @endverbatim

        <div id="session_creator" data-creator="{{ session('abalo_user') }}"></div>
        <div id="newarticle-main-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <newarticle></newarticle>
        </div>
    </div>


    @vite('storage/app/public/js/newarticle.js')

    <script>
        const app = new Vue({
            el: '#testingID',
            components: {
                'newarticle': require('../../storage/app/public/vue/newarticle.vue').default,
                'siteheader': require('../../storage/app/public/vue/siteheader.vue').default,
            },
        });
    </script>
</body>

</html>
