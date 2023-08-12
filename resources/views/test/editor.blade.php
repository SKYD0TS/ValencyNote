<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editor</title>

    <style type="text/css" media="screen">
        #el { 
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body>
<div style="height: 200px;width: 200px;">
    <div id="el"></div>

</div>

    <script src="{{ asset('aceeditor') }}/src-min/ace.js"></script>
    <script src="{{ asset('js') }}/jquery-3.7.0.js"></script>
    <script>
        let a = $('#el')
        
        let editor = ace.edit("el");
        editor.resize()
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");
        console.log(editor.getValue())
    </script>


</body>

</html>
