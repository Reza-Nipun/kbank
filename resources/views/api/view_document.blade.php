<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Knowledge-Bank') }}</title>

    <!-- Favicon Start -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('public/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicon End -->

    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        #canvas_container {
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        #canvas_container {
            background: #6399dd;
            text-align: center;
            border: solid 3px;
        }

    </style>
</head>
<body oncontextmenu="return false;">
<div id="my_pdf_viewer">
    <div id="navigation_controls">
        <button id="go_previous">Previous</button>
        <input id="current_page" value="1" type="number"/>
        <button id="go_next">Next</button>
    </div>

    <div id="zoom_controls">
        <button id="zoom_in">+</button>
        <button id="zoom_out">-</button>
    </div>

    <div id="canvas_container">
        <canvas id="pdf_renderer"></canvas>
    </div>

</div>
<script>
    document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
            e.keyCode === 86 ||
            e.keyCode === 85 ||
            e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
    };
</script>
<script>
    $( document ).ready(function() {

        var data = '{{ $file_url }}';

                var myState = {
                    pdf: null,
                    currentPage: 1,
                    zoom: 1.2
                }

                pdfjsLib.getDocument(data).then((pdf) => {

                    myState.pdf = pdf;
                    render();

                });

                function render() {
                    myState.pdf.getPage(myState.currentPage).then((page) => {

                        var canvas = document.getElementById("pdf_renderer");
                        var ctx = canvas.getContext('2d');

                        var viewport = page.getViewport(myState.zoom);

                        canvas.width = viewport.width;
                        canvas.height = viewport.height;

                        page.render({
                            canvasContext: ctx,
                            viewport: viewport
                        });
                    });
                }

                document.getElementById('go_previous').addEventListener('click', (e) => {
                    if(myState.pdf == null || myState.currentPage == 1)
                        return;
                    myState.currentPage -= 1;
                    document.getElementById("current_page").value = myState.currentPage;
                    render();
                });

                document.getElementById('go_next').addEventListener('click', (e) => {
                    if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
                        return;
                    myState.currentPage += 1;
                    document.getElementById("current_page").value = myState.currentPage;
                    render();
                });

                document.getElementById('current_page').addEventListener('keypress', (e) => {
                    if(myState.pdf == null) return;

                    // Get key code
                    var code = (e.keyCode ? e.keyCode : e.which);

                    // If key code matches that of the Enter key
                    if(code == 13) {
                        var desiredPage =
                            document.getElementById('current_page').valueAsNumber;

                        if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                            myState.currentPage = desiredPage;
                            document.getElementById("current_page").value = desiredPage;
                            render();
                        }
                    }
                });

                document.getElementById('zoom_in').addEventListener('click', (e) => {
                    if(myState.pdf == null) return;
                    myState.zoom += 0.5;
                    render();
                });

                document.getElementById('zoom_out').addEventListener('click', (e) => {
                    if(myState.pdf == null) return;
                    myState.zoom -= 0.5;
                    render();
                });



    });

</script>
</body>
</html>