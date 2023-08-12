<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            height: 100vh;
            padding: 0px;
            margin: 0px;
            overflow: hidden;
        }

        div[windows-container],
        .screen {
            height: 100vh;
            width: 100vw;
        }

        .resizeable {
            padding: 8px;
            box-shadow: 4px 4px 10px black;
        }

        .draggable {
            background: red;
        }

        #ed {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <div windows-container>
        <div class="resizeable"
            style="height: 200px; width:200px; background-color:yellowgreen; position: absolute; transform: translate(190px, 180px);">
            <div class="draggable" data-x="190" data-y="180">
                <div>aw</div>
            </div>
        </div>

        <div class="resizeable"
            style="height: 200px; width:200px; background-color:bisque; position: absolute; transform: translate(65px, 206px);">
            <div class="draggable"data-x="65" data-y="205">
                <div>EDITOR</div>
            </div>
        </div>

        <div class="resizeable"
            style="height: 200px; width:200px; background-color:yellowgreen; position: absolute; transform: translate(340px, 180px); display: flex; flex-direction: column">
            <div class="draggable" data-x="340" data-y="180">
                <div>Text Editor</div>
            </div>
            <div style="height:100%; width: 100%;position: relative;">
                <div class="editor" id="ed"></div>
            </div>
        </div>

    </div>

    <div class="sidebar"
        style="width: 400px; height: 100vh; background: rgba(241, 241, 241, 0.312); position: absolute; top: 0;  z-index: 15; 
        box-shadow: 10px 2px 20px rgba(255, 255, 255, 0.187);
        box-shadow: inset -15px 0px 10px rgba(208, 208, 208, 0.24);
        backdrop-filter: blur(10px)">
        <button onclick="makeWindow()">add</button>
    </div>


    <script src="{{ asset('aceeditor') }}/src-min/ace.js"></script>
    <script src="{{ asset('interactjs') }}/interact.min.js"></script>
    <script src="{{ asset('js') }}/jquery-3.7.0.js"></script>

    <script>
        const zindexOffset = 0
        calculateZIndex('.resizeable')
        interact('.resizeable')
            .resizable({
                // resize from all edges and corners
                edges: {
                    left: true,
                    right: true,
                    bottom: true,
                    top: true
                },

                listeners: {
                    move(event) {
                        var target = event.target
                        let draggable = $(target).find('.draggable')[0]
                        var x = (parseFloat(draggable.getAttribute('data-x')) || 0)
                        var y = (parseFloat(draggable.getAttribute('data-y')) || 0)

                        // update the element's style
                        let padding = parseInt($(target).css('padding')) * 2
                        target.style.width = event.rect.width - padding + 'px'
                        target.style.height = event.rect.height - padding + 'px'
                        
                        // translate when resizing from top or left edges
                        x += event.deltaRect.left
                        y += event.deltaRect.top

                        target.style.transform = 'translate(' + x + 'px,' + y + 'px)'

                        draggable.setAttribute('data-x', x)
                        draggable.setAttribute('data-y', y)
                    }
                },
                modifiers: [
                    // keep the edges inside the parent
                    interact.modifiers.restrictEdges({
                        outer: 'parent'
                    }),

                    // minimum size
                    interact.modifiers.restrictSize({
                        min: {
                            width: 100,
                            height: 50
                        }
                    })
                ],

                inertia: true
            })

        interact('.draggable')
            .draggable({
                listeners: {
                    move: window.dragMoveListener
                },
                inertia: true,
                modifiers: [
                    interact.modifiers.restrictRect({
                        restriction: 'parent',
                        endOnly: true
                    })
                ]
            })

        function makeWindow() {
            let currentCount = $("div[window]").length;
            let newWindow = `
            <div class="resizeable" style="height: 200px; width: 200px; background-color: yellowgreen; position: absolute; transform: translate(190px, 180px); z-index: 0;">
            <div class="draggable" data-x="190" data-y="180">
                <div>RESIZE</div>
            </div>
        </div>`

            $("div[windows-container]").append(newWindow);

            // windows = windows.add(newWindow);
        }

        function dragMoveListener(event) {
            var target = event.target
            // keep the dragged position in the data-x/data-y attributes
            var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
            var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

            // translate the element
            let window = $(target).parent()[0]
            window.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

            // update the posiion attributes
            target.setAttribute('data-x', x)
            target.setAttribute('data-y', y)
            windowReorder($(window))
        }

        // this function is used later in the resizing and gesture demos
        window.dragMoveListener = dragMoveListener


        $("div[windows-container]").on("mousedown", ".resizeable", (e) => {
            if ($(e.target).parentsUntil('.resizeable').hasClass('draggable')) {
                windowReorder($(e.target).parentsUntil('.resizeable').parent())
            } else {
                windowReorder($(e.target))
            }
        })

        function windowReorder(interacted) {
            $(".resizeable").each(function(index) {
                if ($(this).css("z-index") > interacted.css("z-index")) {
                    $(this).css("z-index", $(this).css("z-index") - 1);
                }
            })
            interacted.css("z-index", $(".resizeable").length + zindexOffset - 1)
        }

        function calculateZIndex(r) {
            let e = $(r)
            e.each((i) => {
                $(e[i]).css('z-index', i + zindexOffset)
            })
        }
    </script>
    <script>
        let a = $('#ed')

        let editor = ace.edit("ed");
        editor.resize()
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");
        // console.log(editor.getValue())
    </script>

</body>

</html>
