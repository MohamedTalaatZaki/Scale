let input = $('.scale-weight-text-elem');

function wsInit(ip) {
    this.websocket = new WebSocket(ip);
    this.websocket.onopen = (evt) => {
        this.wsOnOpen(evt)
    };
    this.websocket.onclose = (evt) => {
        this.wsOnClose(evt)
    };
    this.websocket.onmessage = (evt) => {
        this.wsOnMessage(evt)
    };
    this.websocket.onerror = (evt) => {
        this.wsOnError(evt)
    };
}

function wsOnOpen(evt) {
}

function wsOnClose(evt) {
}

function wsOnMessage(evt) {
    if (this.isNumeric(evt.data)) {
        this.weight = evt.data;
        input.text(evt.data + " K.g");
    } else {
        input.text("000000 K.g");
    }
}

function wsOnError(evt) {
    input.text("Error");
}

function isNumeric(number) {
    return !isNaN(parseFloat(number)) && isFinite(number);
}

function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if (document.getElementById(elmnt.id + "Header")) {
        // if present, the Header is where you move the DIV from:
        document.getElementById(elmnt.id + "Header").onmousedown = dragMouseDown;
    } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
}
