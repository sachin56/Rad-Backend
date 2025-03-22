<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/vendors.bundle.css')}}">
<link id="appbundle" rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/app.bundle.css')}}">
<link id="myskin" rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/skins/skin-master.css')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url('public/assets/img/favicon/favicon-32x32.png') }}">
<link rel="mask-icon" href="{{ url('public/assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link id="mytheme" rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/themes/cust-theme-4.css')}}">


<!-- sweet alert -->
<link href="{{ url('public/assets/libs/sweetalert2/sweetalert2.min.css') }}" type="text/css" rel="stylesheet">

<link rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/datagrid/datatables/datatables.bundle.css') }}">

<!-- page select 2 CSS below -->
<link rel="stylesheet" media="screen, print" href="{{ url('public/assets/css/formplugins/select2/select2.bundle.css') }}">

<!-- page ssummer note CSS below -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

<link rel="stylesheet" media="screen,print" href="{{url('public/assets/css/themes/table.css')}}" rel="stylesheet">
<style>
    #preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        background: white;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #3498db;
        border-top: 5px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    /* Nexa Bold */
    @font-face {
        font-family: 'Nexa';
        src: {{url('/back/webfonts/NexaRegular.otf')}} format('opentype');
        font-weight: bold;
        font-style: normal;
    }

    @font-face {
        font-family: 'Nexa';
        src: {{url('/back/webfonts/Nexa-Bold.otf')}} format('opentype');
        font-weight: bold;
        font-style: normal;
    }

    /* Nexa Italic */
    @font-face {
        font-family: 'Nexa';
        src: {{url('/back/webfonts/Nexa-Regular-Italic.otf')}} format('opentype');
        font-weight: normal;
        font-style: italic;
    }

    /* Nexa Black (if needed) */
    @font-face {
        font-family: 'Nexa';
        src: {{ url('/back/webfonts/NexaBlack.otf') }} format('opentype');
        font-weight: 900;
        font-style: normal;
    }
    .note-editable {
        font-family: 'Nexa', sans-serif !important;
    }

</style>
