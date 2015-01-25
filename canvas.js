// Keep everything in anonymous function, called on window load.
if(window.addEventListener) {
    window.addEventListener('load', function () {
        var canvas, context, tool;

        function init () {
            // Find the canvas element.
            canvas = document.getElementById('canvas');
            canvas.width = window.innerWidth * 0.98;
            canvas.height = window.innerHeight * 0.68;

            if (!canvas) {
                alert('Error: I cannot find the canvas element!');
                return;
            }

            if (!canvas.getContext) {
                alert('Error: no canvas.getContext!');
                return;
            }

            // Get the 2D canvas context.
            context = canvas.getContext('2d');
            if (!context) {
                alert('Error: failed to getContext!');
                return;
            }

            // Pencil tool instance.
            tool = new tool_pencil();

            // Attach the mousedown, mousemove and mouseup event listeners.
            canvas.addEventListener('mousedown', ev_canvas, false);
            canvas.addEventListener('mousemove', ev_canvas, false);
            canvas.addEventListener('mouseup',   ev_canvas, false);
            canvas.addEventListener('touchstart', ev_canvas_touch, false);
            canvas.addEventListener('touchmove', ev_canvas_touch, false);
            canvas.addEventListener('touchend', ev_canvas_touch, false);
        }

        // This painting tool works like a drawing pencil which tracks the mouse 
        // movements.
        function tool_pencil () {
            var tool = this;
            this.started = false;

            this.touchstart = function (ev) {
                context.beginPath();
                context.moveTo(ev._x, ev._y);
                tool.touch = true;
            };

            this.touchmove = function (ev) {
                if (tool.touch) {
                    context.lineTo(ev._x, ev._y);
                    context.stroke();
                }
            };

            this.touchend = function (ev) {
                if (tool.touch) {
                    tool.mousemove(ev);
                    tool.touch = false;
                }
            };

            // This is called when you start holding down the mouse button.
            // This starts the pencil drawing.
            this.mousedown = function (ev) {
                context.beginPath();
                context.moveTo(ev._x, ev._y);
                tool.started = true;
            };

            // This function is called every time you move the mouse. Obviously, it only 
            // draws if the tool.started state is set to true (when you are holding down 
            // the mouse button).
            this.mousemove = function (ev) {
                if (tool.started) {
                    context.lineTo(ev._x, ev._y);
                    context.stroke();
                }
            };

            // This is called when you release the mouse button.
            this.mouseup = function (ev) {
                if (tool.started) {
                    tool.mousemove(ev);
                    tool.started = false;
                }
            };
        }

        // The general-purpose event handler. This function just determines the mouse 
        // position relative to the canvas element.
        function ev_canvas (ev) {
            if (ev.layerX || ev.layerX == 0) { // Firefox
                ev._x = ev.layerX;
                ev._y = ev.layerY;
            } else if (ev.offsetX || ev.offsetX == 0) { // Opera
                ev._x = ev.offsetX;
                ev._y = ev.offsetY;
            } 
//            document.getElementById("debug").innerText = "body height: " + window.innerHeight + ", canvas height: " + canvas.height;

            // Call the event handler of the tool.
            var func = tool[ev.type];
            if (func) {
                func(ev);
            }
        }

        function ev_canvas_touch (ev) {
            if (ev.touches.item(0).pageX || ev.touches.item(0).pageX == 0) {
                ev._x = ev.touches.item(0).pageX - canvas.getBoundingClientRect().left;
                ev._y = ev.touches.item(0).pageY - canvas.getBoundingClientRect().top; 
            }
//            document.getElementById("debug").innerText = "body height: " + window.innerHeight + ", canvas height: " + canvas.height;

            // Call the event handler of the tool.
            var func = tool[ev.type];
            if (func) {
                func(ev);
            }
        }

        init();

    }, false); }
