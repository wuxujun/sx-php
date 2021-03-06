if (typeof getElementById != "function") {
    var getElementById = function(a) {
        if (typeof(a) == "object") {
            return a;
        }
        if (document.getElementById(a)) {
            return document.getElementById(a);
        } else {
            throw new Error(a + ' argument error, can not find "' + a + '" element');
        }
    };
}
function getElCoordinate(f) {
    var c = f.offsetTop;
    var b = f.offsetLeft;
    var a = f.offsetWidth;
    var d = f.offsetHeight;
    while (f = f.offsetParent) {
        c += f.offsetTop;
        b += f.offsetLeft;
    }
    return {
        top: c,
        left: b,
        width: a,
        height: d,
        bottom: c + d,
        right: b + a
    };
}
var neverModules = window.neverModules || {};
neverModules.modules = neverModules.modules || {};
neverModules.modules.slider = function(a) {
    if ((typeof a) != "object") {
        throw new Error("config argument is not a object, error raise from slider constructor");
    }
    this.sliderValue = a.sliderValue;
    this.targetId = a.targetId;
    this.hints = a.hints ? a.hints: "";
    this.sliderCss = a.sliderCss ? a.sliderCss: "";
    this.barCss = a.barCss ? a.barCss: "";
    this.min = a.min ? a.min: 0;
    this.max = a.max ? a.max: 100;
    this.onstart = function() {};
    this.onchange = a.change ||
    function() {};
    this.onend = function() {};
    this._defaultInitializer.apply(this);
};
neverModules.modules.slider.prototype = {
    _defaultInitializer: function() {
        this._bar = null;
        this._slider = null;
        this._wrapper = null;
        this._target = getElementById(this.targetId);
        this._sliderPoint = null;
        if (this.min > this.max) {
            var a = this.min;
            this.min = this.max;
            this.max = a;
        }
        this._value = this.min;
    },
    create: function() {
        this._createSlider();
    },
    dispose: function() {},
    createBar: function() {
        with(this) {
            var _self = this;
            _bar = document.createElement("DIV");
            _wrapper.appendChild(_bar);
            _bar.title = hints;
            _bar.id = targetId + "_bar";
            _bar.className = barCss;
            _bar.style.position = "absolute";
            _bar.onmousedown = function(evt) {
                _self._initMoveSlider(evt);
            };
            _sliderPoint = document.createElement("span");
            _wrapper.appendChild(_sliderPoint);
            _sliderPoint.id = targetId + "_sp";
            _sliderPoint.style.color = "red";
            _sliderPoint.style.fontSize = "14px";
            _sliderPoint.style.position = "absolute";
        }
    },
    setValue: function(n, notfire) {
        with(this) {
            if (!_bar) {
                return;
            }
            n = _Number(Number(n));
            n = n > max ? max: n < min ? min: n;
            _bar.style.left = Math.round((n - min) * ((_slider.offsetWidth - _bar.offsetWidth) / (max - min))) + "px";
            _value = n;
            this._sliderPoint.style.left = parseInt(this._bar.style.left) + "px";
            this._sliderPoint.style.top = this._bar.offsetHeight + "px";
            this._sliderPoint.innerHTML = _value || "";
            if (!notfire) {
                fireChange();
                fireEnd();
            }
        }
    },
    getValue: function() {
        return this._value;
    },
    fireStart: function() {
        this.onstart.call(this);
    },
    fireChange: function() {
        if (completeLoaded) {
            this._bar.title = this._value;
            if (this.sliderValue.type) {
                this.sliderValue.value = this._value;
            } else {
                this.sliderValue.style.display = "none";
            }
            this._sliderPoint.style.left = parseInt(this._bar.style.left) + "px";
            this._sliderPoint.style.top = this._bar.offsetHeight + "px";
            this._sliderPoint.innerHTML = this._value;
            this._target.value = this._value;
            this.onchange.call(this._target);
        }
    },
    fireEnd: function() {
        this.onend.call(this);
    },
    _createSlider: function() {
        with(this) {
            _wrapper = document.createElement("DIV");
            _target.appendChild(_wrapper);
            _wrapper.id = targetId + "_wrapper";
            _wrapper.style.position = "relative";
            _slider = document.createElement("DIV");
            _wrapper.appendChild(_slider);
            _slider.id = targetId + "_slider";
            _slider.className = sliderCss;
            _slider.style.position = "absolute";
            createBar();
            var divClear = document.createElement("DIV");
            divClear.style.clear = "both";
            _wrapper.appendChild(divClear);
            var _self = this;
            _slider.onclick = function(evt) {
                _self._moveTo(evt);
            };
        }
    },
    _moveTo: function(evt) {
        with(this) {
            evt = evt ? evt: window.event;
            var x = evt.clientX - getElCoordinate(_slider).left - Math.round(_bar.offsetWidth / 2);
            x = _coordsX(x);
            _bar.style.left = x + "px";
            _value = Math.round(x / ((_slider.offsetWidth - _bar.offsetWidth) / (max - min)) + min);
            fireChange();
            fireEnd();
        }
    },
    _coordsX: function(x) {
        with(this) {
            x = _Number(x);
            x = x <= _slider.offsetLeft ? _slider.offsetLeft: x >= _slider.offsetLeft + _slider.offsetWidth - _bar.offsetWidth ? _slider.offsetLeft + _slider.offsetWidth - _bar.offsetWidth: x;
            return x;
        }
    },
    _coordsY: function(y) {
        with(this) {}
    },
    _Number: function(a) {
        return isNaN(a) ? 0 : a;
    },
    _initMoveSlider: function(evt) {
        with(this) {
            evt = evt ? evt: window.event;
            var _self = this;
            _bar.slider_x = evt.clientX - _bar.offsetLeft;
            fireStart();
            document.onmousemove = function(evt) {
                _self._changeHandle(evt);
            };
            document.onmouseup = function(evt) {
                _self._endHandle(evt);
            };
        }
    },
    _changeHandle: function(evt) {
        with(this) {
            evt = evt ? evt: window.event;
            var x = evt.clientX - _bar.slider_x;
            x = _coordsX(x);
            _bar.style.left = x + "px";
            _value = Math.round(x / ((_slider.offsetWidth - _bar.offsetWidth) / (max - min)) + min);
            fireChange();
        }
    },
    _endHandle: function(evt) {
        with(this) {
            document.onmousemove = null;
            document.onmouseup = null;
            fireEnd();
        }
    }
};