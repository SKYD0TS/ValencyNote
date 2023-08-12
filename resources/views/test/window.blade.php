<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
    
        /* Track */
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
    
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.242);
            border-radius: 5em;
        }
    
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #ffffff;
        }
    
        div#test::-webkit-scrollbar {
            width: 30px;
            !important height: 50px;
        }
    
        .window[window] {
            position: absolute;
            display: flex;
            flex-direction: column;
    
            height: 200px;
            width: 300px;
    
            background-color: rgb(98, 134, 122);
    
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.267);
            outline: 1px solid black;
    
        }
    
    
    
        .window[window] .content {
            padding: 5px;
            overflow-y: auto;
    
        }
    
        .window[window] .header {
            /* width: 300px; */
            user-select: none;
            padding: 0px 5px;
            height: 20px;
            cursor: grab;
    
            background-color: aquamarine;
        }
    
        .window[window] .resize {
            display: flex;
            float: right;
            margin-top: auto;
            align-self: end;
    
            cursor: grab;
        }
    
        .sidebar {
            height: 100%;
            width: 150px;
    
            position: absolute;
            z-index: 99;
    
            background-color: aquamarine;
        }
    
        body,
        div[windows],
        div[uis] {
            left: 0;
            top: 0;
            padding: 0px;
            margin: 0px;
        }
    </style>

</head>


<body class="antialiased">

    <div windows-container style="position:absolute; height:100%; width:100%">

        <button onclick="makeWindow()">makeWindow</button>
        <button onclick="checkWindow()">checkWindow</button>

        <div class="window" style="z-index:0;" window>
            <div>
                <div class="header" window-drag-handle>
                    window
                </div>
            </div>
            <div id="test" class="content">
            </div>
            <div class="footer" style="right:5px; bottom:5px; position: absolute;">
                <div class="resize" window-resize-handle>
                    ||||
                </div>
            </div>
        </div>

        <div class="window" style="z-index:1;" window>
            <div>
                <div class="header" window-drag-handle>
                    window
                </div>
            </div>
            <div id="test" class="content">
            </div>
            <div class="footer" style="right:5px; bottom:5px; position: absolute;">
                <div class="resize" window-resize-handle>
                    ||||
                </div>
            </div>
        </div>
        


    </div>

    


    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

    <script src="{{ @asset('js') }}/drag-resize.js"></script>

</body>

</html>
