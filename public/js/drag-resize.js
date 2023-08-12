let isDragging = false;
let isResizing = false;
let draggable, resizable, lastX, lastY;
let highestZIndex = 0;



let windows = $("div[window]");

function checkWindow(){
    console.log($("div[window]").length)
}

function windowReorder(moved){
    $("div[window]").each(function (index) {
        // console.log(this, $(this).css("z-index"), draggable.css("z-index"), draggable, $(this).css("z-index") > draggable.css("z-index"))
        if ($(this).css("z-index") > moved.css("z-index")) {
            console.log("moved")
            $(this).css("z-index", $(this).css("z-index") - 1);
        }
    })
    moved.css("z-index", $("div[window]").length-1)
}

function makeWindow() {
    let currentCount = $("div[window]").length;
    console.log(currentCount)
    let newWindow = `
        <div class="window" style="z-index:${currentCount};" window>
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
        </div>`

    $("div[windows-container]").append(newWindow);

    // windows = windows.add(newWindow);
}

const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

$("div[windows-container]").on("click", "div[window]", (e)=>{
    console.log(e.target, $(e.target))
    windowReorder($(e.target))
})

$("div[windows-container]").on("mousedown", "div[window-drag-handle]", (e) => {
    $(e.target).css("cursor", "grabbing");
    draggable = $(e.currentTarget).parent().parent();
    
    isDragging = true;
    lastX = e.clientX - draggable.offset().left;
    lastY = e.clientY - draggable.offset().top;
    
    console.log($("div[window]").length);
    console.log(draggable.css("z-index"));
    
    windowReorder(draggable)
    
});

$("div[windows-container]").on("mousedown", "div[window-resize-handle]", (e) => {
        e.preventDefault();
        resizeable = $(e.currentTarget).parent().parent();
        isResizing = true;
        lastX = e.clientX;
        lastY = e.clientY;
        console.log(e);
    
        resizeable.css("z-index", 1);
    });

$(document).on("mousemove", (e) => {
    if (isDragging) {
        const newX = e.clientX - lastX;
        const newY = e.clientY - lastY;
        // draggable = $(e.currentTarget).parent().parent();
        // draggable.css("left", newX * (newX > 0 && newX < $("div[windows-container]").width()));
        // draggable.css("top", newY * (newY > 0 || newY < $("div[windows-container]").height()));
        draggable.css("left", clamp(newX, 0, $("div[windows-container]").width()-70) )
        draggable.css("top", clamp(newY, 0, $("div[windows-container]").height()-70) )
    }

    if (isResizing) {
        $("div[window-resize-handle]").css("cursor", "grabbing");

        console.log(resizeable);
        const deltaX = e.clientX - lastX;
        const deltaY = e.clientY - lastY;
        const newWidth = resizeable.width() + deltaX;
        const newHeight = resizeable.height() + deltaY;
        
        resizeable.css(
            "width", clamp(newWidth, 130, 9999)  + "px"
        );
        resizeable.css(
            "height", clamp(newHeight, 100, 9999) + "px"
        );

        lastX = e.clientX;
        lastY = e.clientY;
    }
});

// $("div[windows]").on("mousedown", "div[resizeable-handle]", (e) => {
//     e.preventDefault();
//     resizeable = $(e.currentTarget).parent().parent();
//     isResizing = true;
//     lastX = e.clientX;
//     lastY = e.clientY;
//     console.log(e);

//     draggable.css("z-index", 1);
// });

// $(document).on("mousemove", (e) => {
//     if (isResizing) {
//         $("div[resizeable-handle]").css("cursor", "grabbing");

//         console.log(resizeable);
//         const deltaX = e.clientX - lastX;
//         const deltaY = e.clientY - lastY;
//         const newWidth = resizeable.width() + deltaX;
//         const newHeight = resizeable.height() + deltaY;
//         // if(newWidth > 200 || newHeight >350){
//         resizeable.css(
//             "width",
//             newWidth > 150 ? newWidth : resizeable.width() + "px"
//         );
//         resizeable.css(
//             "height",
//             newHeight > 100 ? newHeight : resizeable.height() + "px"
//         );
//         // }

//         lastX = e.clientX;
//         lastY = e.clientY;
//     }
// });

$(document).on("mouseup", () => {
    $("div[draggable-handle]").css("cursor", "grab");
    $("div[resizeable-handle]").css("cursor", "grab");

    isDragging = false;
    isResizing = false;
});

let st = $("#sidebar-toggle");
