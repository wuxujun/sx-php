if (typeof(Array.prototype.push) != "function") {
    Array.prototype.push = function() {
        for (var a = 0; a < arguments.length; a++) {
            this[this.length] = arguments[a];
        }
        return this.length;
    };
}
String.prototype.format = function() {
    var a = arguments;
    return this.replace(/\{(\d+)\}/g,
    function(b, c) {
        return a[c];
    });
};
var hrefSave = document.getElementById("hrefSave");
var cur_page = 0;
var jumpPages;
var pageHolder = new Array();
var trapHolder = new Array();
var totalQ = 0;
var completeLoaded = false;
var MaxTopic = 0;
if (displayPrevPage == "none" && (hasJoin == "1" || isSuper)) {
    displayPrevPage = "";
}
var curdiv = null;
var curfilediv = null;
var isUploadingFile = false;
var hasZhenBiePage = false;
var progressArray = new Object();
var questionsObject = new Object();
var joinedTopic = 0;
var randomparm = "";
var hasTouPiao = false;
var useSelfTopic = false;
var isChrome = window.chrome;
//document.oncontextmenu = document.ondragstart = document.onselectstart = avoidCopy;
var ZheZhaoControl = null;
function forbidBackSpace(f) {
    var c = f || window.event;
    var d = c.target || c.srcElement;
    var b = d.type || d.getAttribute("type");
    var a = c.keyCode == 8 && b != "password" && b != "text" && b != "textarea";
    if (a) {
        return false;
    }
}
document.onkeydown = forbidBackSpace;
function avoidCopy(b) {
    b = window.event || b;
    var a;
    if (b) {
        if (b.target) {
            a = b.target;
        } else {
            if (b.srcElement) {
                a = b.srcElement;
            }
        }
        if (a.nodeType == 3) {
            a = a.parentNode;
        }
        if (a.tagName == "INPUT" || a.tagName == "TEXTAREA" || a.tagName == "SELECT") {
            return true;
        }
    }
    if (document.selection && document.selection.empty) {
        document.selection.empty();
    }
    return false;
}
function showItemDesc(b, a) {
    var c = $(b);
    var d = $("divDescPopData");
    d.innerHTML = c.innerHTML;
    PDF_launch("divDescPop", 500, 500);
}
var needCheckLeave = true;
if (allowSaveJoin && isRunning == "true" && guid) {
    window.onunload = function() {
        if (needCheckLeave) {
            if (confirm("您要保存填写的答卷吗？")) {
                submit(2);
                alert("答卷保存成功！");
            }
        }
    };
}
$ = function(a) {
    return document.getElementById(a);
};
$$ = function(a, b) {
    if (b) {
        return b.getElementsByTagName(a);
    } else {
        return document.getElementsByTagName(a);
    }
};
function getTop(b) {
    var a = b.offsetLeft;
    var c = b.offsetTop;
    while (b = b.offsetParent) {
        a += b.offsetLeft;
        c += b.offsetTop;
    }
    return {
        x: a,
        y: c
    };
}
function addEventSimple(c, a, b) {
    if (c.addEventListener) {
        c.addEventListener(a, b, false);
    } else {
        if (c.attachEvent) {
            c.attachEvent("on" + a, b);
        }
    }
}
function removeEventSimple(c, a, b) {
    if (c.removeEventListener) {
        c.removeEventListener(a, b, false);
    } else {
        if (c.detachEvent) {
            c.detachEvent("on" + a, b);
        }
    }
}
function Request(d) {
    var b = window.document.location.href;
    var f = b.indexOf("?");
    var e = b.substr(f + 1);
    var c = e.split("&");
    for (var a = 0; a < c.length; a++) {
        var g = c[a].split("=");
        if (g[0].toUpperCase() == d.toUpperCase()) {
            return g[1];
        }
    }
    return "";
}
var txtCurCity = null;
function openCityBox(e, d, c, f) {
    txtCurCity = e;
    if (e.getAttribute("lastdata") == "1") {
        txtCurCity.lastData = 1;
    }
    ZheZhaoControl = txtCurCity;
    f = f || "";
    var a = e.getAttribute("province");
    var b = "";
    if (a) {
        b = "&pv=" + encodeURIComponent(a);
    }
    if (d == 3) {
        PDF_launch("/wjx/design/setcitycounty.aspx?activityid=" + activityId + "&ct=" + d + b + "&pos=" + f, 470, 220);
    } else {
        if (d == 4) {
            ZheZhaoControl = null;
            PDF_launch("/wjx/design/school.aspx?activityid=" + activityId + b, 700, 340);
        } else {
            PDF_launch("/wjx/design/setcity.aspx?activityid=" + activityId + "&ct=" + d + "&pos=" + f, 470, 220);
        }
    }
}
function setCityBox(a) {
    txtCurCity.value = a;
}
var submit_tip = $("submit_tip");
var submit_div = $("submit_div");
function trim(a) {
    return a.replace(/(^\s*)|(\s*$)/g, "");
}
function isInt(a) {
    var b = /^-?[0-9]+$/;
    return b.test(a);
}
var spChars = ["$", "}", "^", "|", "<"];
var spToChars = ["ξ", "｝", "ˆ", "¦", "&lt;"];
function replace_specialChar(c) {
    for (var a = 0; a < spChars.length; a++) {
        var b = new RegExp("(\\" + spChars[a] + ")", "g");
        c = c.replace(b, spToChars[a]);
    }
    return c;
}
function isRadioImage(a) {
    if (!a || a == "0" || a == "1" || a == "101") {
        return false;
    } else {
        return true;
    }
}
function isRadioRate(a) {
    return a != "" && a != "0" && a != "1" && a != "-1";
}
var submit_table = $("submit_table");
var pre_page = $("btnPre");
var next_page = $("btnNext");
var submit_button = $("submit_button");
var imgCode = $("imgCode");
var submit_text = $("yucinput");
var tCode = $(tdCode);
var divMinTime = $("divMinTime");
var spanMinTime = $("spanMinTime");
var divMaxTime = $("divMaxTime");
var spanMaxTime = $("spanMaxTime");
var maxCounter = 0;
var maxTimer = null;

function changeHeight(d) {
    var e = parseInt(d.style.height);
    if (!e) {
        return;
    }
    var c = 18;
    var b = 100;
    var a = d.scrollHeight;
    a = a > c ? a: c;
    a = a > b ? b: a;
    if (a - e >= 10) {
        d.style.height = a + "px";
    }
}
function fcInputboxFocus() {}
function lengthChange(c) {
    var a = c.value.length;
    var b = c.size;
    if (a >= b && b <= 80) {
        c.size = a + 2;
    } else {
        if (b > 80) {}
    }
}
function fcInputboxBlur() {
    if (!this.value) {
        this.value = defaultOtherText;
        this.style.color = "#999999";
    } else {
        this.style.color = "#000000";
        if (langVer != 0) {
            return;
        }
        if (this.tagName == "select") {
            return;
        }
        var e = this.parent;
        var c = e.itemInputs;
        var f = this.value.split(/(,|，)/ig);
        for (var d = 0; d < c.length; d++) {
            var b = getNextNode(c[d]);
            if (!b) {
                return;
            }
            for (var a = 0; a < f.length; a++) {
                if (trim(f[a].toLowerCase()) == trim(b.innerHTML.toLowerCase())) {
                    alert("提示：您输入的“" + f[a] + "”已经包含在题目选项当中");
                    c[d].checked = true;
                    b.style.color = "red";
                }
            }
        }
    }
}
function isTextBoxEmpty(a) {
    a = trim(a);
    if (a == "" || a == defaultOtherText) {
        return true;
    }
    return false;
}
function refresh_validate() {
    if (imgCode && tCode.style.display != "none" && imgCode.style.display != "none") {
        imgCode.src = "/AntiSpamImageGen.aspx?q=" + activityId + "&t=" + (new Date()).valueOf();
    }
}
function enter_clicksub(a) {
    a = a || window.event;
    if (a && a.keyCode == 13) {
        submit(1);
    }
}
var relationHT = new Array();
var relationQs = new Object();
var relationNotDisplayQ = new Object();
var nextPageAlertText = "";
var hasMaxtime = false;
var imgVerify = null;
var shopHT = new Array();
Init();
function Init() {
    if (cur_page == 0 && !displayPrevPage && pre_page) {
        pre_page.style.display = "";
        pre_page.disabled = true;
    }
    pageHolder = $$("fieldset", survey);
    for (var al = 0; al < pageHolder.length; al++) {
        var ae = pageHolder[al].getAttribute("skip") == "true";
        if (ae) {
            pageHolder[al].skipPage = true;
        }
    }
    submit_button.onmouseover = function() {
        this.className = "submitbutton submitbutton_hover";
        if (isPub && $("spanTest").style.display != "") {
            $("spanTest").style.display = "";
            $("submittest_button").onmouseover = function() {
                show_status_tip("您是发布者，可以进行试填问卷，试填的答卷不会参与结果统计！", 5000);
                $("submittest_button").onmouseover = null;
            };
        }
    };
    submit_button.onclick = function() {
        if (checkDisalbed()) {
            return;
        }
        submit(1);
    };
    
    if (isPub) {
        $("submittest_button").onclick = function() {
            if (!isTest && confirm("试填后的答卷不会参与结果统计，确定试填吗？")) {
                submit(5);
            } else {
                if (isTest) {
                    submit(5);
                }
            }
        };
        if (isTest) {
            submit_button.style.display = "none";
        }
    }
    if (hasJoin == "3") {
        submit_button.onclick = function() {
            if (checkDisalbed()) {
                return;
            }
            if (window.confirm("确定编辑此答卷吗？")) {
                submit(6);
            }
        };
    }
    if (totalPage == 1 && isRunning == "true" && hasJoin != "1") {
        submit_table.style.display = "";
    } else {
        if (isRunning != "true") {
            var t = $("spanNotSubmit");
            if (t && trim(t.innerHTML) != "") {
                if (totalPage == 1 && hasJoin != "1") {
                    submit_table.style.display = "";
                }
                nextPageAlertText = t.innerHTML.replace(/<[^>]*>/g, "");
                submit_button.onclick = function() {
                    if (checkDisalbed()) {
                        return;
                    }
                    alert(nextPageAlertText);
                    t.scrollIntoView();
                };
            } else {
                submit_table.style.display = "none";
            }
        } else {
            submit_table.style.display = "none";
        }
    }
    if (pre_page) {
        pre_page.onclick = show_pre_page;
    }
    if (next_page) {
        next_page.onclick = show_next_page;
    }
    if (tCode && tCode.style.display != "none" && isRunning == "true") {
        submit_text.value = validate_info_submit_title3;
        addEventSimple(submit_text, "blur",
        function() {
            if (submit_text.value == "") {
                submit_text.value = validate_info_submit_title3;
            }
        });
        addEventSimple(submit_text, "focus",
        function() {
            if (submit_text.value == validate_info_submit_title3) {
                submit_text.value = "";
            }
        });
        imgCode.style.display = "none";
        if (langVer != 0) {
            imgCode.alt = "";
        }
        addEventSimple(submit_text, "click",
        function() {
            if (!needAvoidCrack && imgCode.style.display == "none") {
                imgCode.style.display = "";
                imgCode.onclick = refresh_validate;
                imgCode.onclick();
                imgCode.title = validate_info_submit_title1;
            } else {
                if (needAvoidCrack && !imgVerify) {
                    var q = $("divCaptcha");
                    q.style.display = "";
                    imgVerify = q.getElementsByTagName("img")[0];
                    imgVerify.style.cursor = "pointer";
                    imgVerify.onclick = function() {
                        var az = new Date();
                        var aw = az.getTime() + (az.getTimezoneOffset() * 60000);
                        var ax = window.location.host || "www.sojump.com";
                        var ay = "http://" + ax + "/BotDetectCaptcha.ashx?activity=" + activityId + "&get=image&c=" + this.captchaId + "&t=" + this.instanceId + "&d=" + aw;
                        this.src = ay;
                    };
                    var i = imgVerify.getAttribute("captchaid");
                    var k = imgVerify.getAttribute("instanceid");
                    imgVerify.captchaId = i;
                    imgVerify.instanceId = k;
                    imgVerify.onclick();
                }
            }
        });
    }
    for (var aj = 0; aj < pageHolder.length; aj++) {
        var m = $$("div", pageHolder[aj]);
        if (hasJoin) {
            pageHolder[aj].style.display = "";
        }
        var p = new Array();
        var ag = 0;
        for (var al = 0; al < m.length; al++) {
            var c = m[al].className.toLowerCase();
            if (c == "div_question") {
                var h = m[al].getAttribute("istrap") == "1";
                m[al].onclick = divQuestionClick;
                if (h) {
                    trapHolder.push(m[al]);
                    initItem(m[al]);
                    m[al].pageIndex = aj + 1;
                    m[al].isTrap = true;
                } else {
                    m[al].indexInPage = ag;
                    p[ag] = m[al];
                    p[ag].pageIndex = aj + 1;
                    ag++;
                    totalQ++;
                }
            }
        }
        pageHolder[aj].questions = p;
    }
    set_data_fromServer(qstr);
    var Q = new Array();
    for (var u = 0; u < pageHolder.length; u++) {
        var an = pageHolder[u].questions;
        for (var al = 0; al < an.length; al++) {
            var O = an[al].dataNode;
            var av = O._type;
            var F = an[al].getAttribute("relation");
            var A = an[al].getAttribute("isshop");
            if (A == "1") {
                an[al].isShop = true;
                shopHT.push(an[al]);
            }
            if (F && F != "0") {
                var U = F.split(",");
                var M = U[0];
                var d = U[1].split(";");
                for (var T = 0; T < d.length; T++) {
                    var s = M + "," + d[T];
                    if (!relationHT[s]) {
                        relationHT[s] = new Array();
                    }
                    relationHT[s].push(an[al]);
                }
                if (!relationQs[M]) {
                    relationQs[M] = new Array();
                }
                relationQs[M].push(an[al]);
                relationNotDisplayQ[O._topic] = "1";
            } else {
                if (F == "0") {
                    relationNotDisplayQ[O._topic] = "1";
                }
            }
            if (av != "page" && av != "cut") {
                questionsObject[O._topic] = an[al];
            }
            if (av == "radio" || av == "check") {
                if (av == "radio" && isRadioImage(O._mode)) {
                    initLikertItem(an[al]);
                } else {
                    initItem(an[al]);
                }
                if ((av == "radio" || av == "check") && !O.isRate && !an[al].isShop) {
                    var ab = $$("img", an[al]);
                    for (var ak = 0; ak < ab.length; ak++) {
                        ab[ak].onclick = function() {
                            var i = this.getAttribute("rel");
                            if (i) {
                                var q = $(i);
                                q.click();
                                var k = q.parent.parent || q.parent;
                                this.style.border = q.checked ? "solid 2px #ff9900": "solid 2px #eeeeee";
                                if (q.type == "radio") {
                                    if (k && k.prevImage && k.prevImage != this) {
                                        k.prevImage.style.border = "";
                                    }
                                    k.prevImage = this;
                                }
                            }
                        };
                    }
                }
            }
            if (av == "fileupload") {
                var o = $$("iframe", an[al]);
                if (o && o[0]) {
                    an[al].uploadFrame = o[0];
                    an[al].uploadFrame.allowTransparency = true;
                    var B = document.frames ? document.frames[o[0].id] : document.getElementById(o[0].id).contentWindow;
                    B.curdiv = an[al];
                    B._ext = O._ext;
                }
                var m = $$("div", an[al]);
                for (var ak = 0; ak < m.length; ak++) {
                    if (m[ak].className.toLowerCase() == "uploadmsg") {
                        an[al].uploadmsg = m[ak];
                        m[ak].style.color = "red";
                        break;
                    }
                }
                an[al].uploadFinish = function(i, q) {
                    this.uploadmsg.innerHTML = i;
                    this.fileName = q;
                    isUploadingFile = false;
                    this.uploadFrame.style.display = "";
                    var k = document.frames ? document.frames[this.uploadFrame.id] : document.getElementById(this.uploadFrame.id).contentWindow;
                    k.curdiv = this;
                    k._ext = this.dataNode._ext;
                    updateProgressBar(this.dataNode);
                    jump(this, this.uploadFrame);
                };
            }
            if (av == "matrix") {
                var n = O._mode;
                if (O._hasjump) {
                    if (n && n - 100 < 0) {
                        initLikertItem(an[al]);
                    } else {
                        initItem(an[al]);
                    }
                }
                var g = an[al].getAttribute("DaoZhi");
                var ar = null;
                if (!g) {
                    ar = $$("tr", an[al]);
                } else {
                    var aa = $$("tr", an[al]);
                    ar = new Array();
                    var x = aa[0].cells.length - 1;
                    for (var D = 0; D < x; D++) {
                        ar[D] = aa[0].cells[D + 1];
                        ar[D].itemInputs = new Array();
                    }
                    for (var D = 0; D < x; D++) {
                        for (var a = 0; a < aa.length; a++) {
                            var P = aa[a].cells[D + 1];
                            P.parent = ar[D];
                            P.onclick = function() {
                                if (curMatrixItem != this.parent) {
                                    var i = this.parent.itemInputs;
                                    if (i) {
                                        for (var k = 0; k < i.length; k++) {
                                            i[k].parentNode.style.background = "#edfafe";
                                        }
                                    }
                                    if (curMatrixItem && curMatrixItem.daoZhi) {
                                        i = curMatrixItem.itemInputs;
                                        for (var k = 0; k < i.length; k++) {
                                            i[k].parentNode.style.background = "";
                                        }
                                    }
                                    divMatrixItemClick.call(this.parent);
                                }
                            };
                            ar[D].parent = an[al];
                            ar[D].daoZhi = true;
                            var am = P.getElementsByTagName("input")[0];
                            if (am) {
                                ar[D].itemInputs.push(am);
                            }
                        }
                    }
                }
                if (!g) {
                    for (var ak = 0; ak < ar.length; ak++) {
                        if (n != "303") {
                            if (n && n - 100 < 0) {
                                initLikertItem(ar[ak]);
                            } else {
                                if (!g) {
                                    initItem(ar[ak]);
                                }
                            }
                        } else {
                            var af = $$("select", ar[ak]);
                            if (af.length > 0) {
                                ar[ak].itemSels = af;
                            }
                            if (O._hasjump) {
                                for (var ao = 0; ao < af.length; ao++) {
                                    af[ao].parent = ar[ak];
                                    af[ao].onchange = function() {
                                        var ay = this.parent.parent;
                                        var ax = ay.itemTrs;
                                        var aw = false;
                                        for (var k = 0; k < ax.length; k++) {
                                            var q = ax[k].itemSels;
                                            if (!q) {
                                                continue;
                                            }
                                            for (var i = 0; i < q.length; i++) {
                                                if (q[i].value) {
                                                    aw = true;
                                                    break;
                                                }
                                            }
                                            if (aw) {
                                                break;
                                            }
                                        }
                                        jumpAny(aw, ay);
                                    };
                                }
                            }
                        }
                        ar[ak].parent = an[al];
                        ar[ak].onclick = divMatrixItemClick;
                    }
                }
                if (n == "301" || n == "102") {
                    var z = an[al].getAttribute("minvalue");
                    var H = an[al].getAttribute("maxvalue");
                    an[al].dataNode._minvalue = z;
                    an[al].dataNode._maxvalue = H;
                }
                if (ar.length > 0) {
                    an[al].itemTrs = ar;
                }
            }
            if (av == "sum") {
                initItem(an[al]);
                var ar = $$("tr", an[al]);
                var y = new Array();
                for (var ak = 0; ak < ar.length; ak++) {
                    var Z = $$("input", ar[ak]);
                    if (Z.length > 0) {
                        ar[ak].parent = an[al];
                        y.push(ar[ak]);
                    }
                }
                var v = an[al].itemInputs.length;
                var r = an[al].itemInputs;
                for (var ak = 0; ak < v; ak++) {
                    r[ak].onblur = function() {
                        txtChange(this);
                    };
                }
                if (y.length > 0) {
                    an[al].itemTrs = y;
                }
                var S = an[al].getAttribute("rel");
                an[al].relSum = $(S);
            }
            if (av == "check" && O.isSort) {
                var au = $$("a", an[al]);
                for (ak = 0; ak < au.length; ak++) {
                    au[ak].onclick = itemSortClick;
                }
            }
            if (av == "question") {
                var ad = $$("textarea", an[al]);
                if (ad.length > 0) {
                    ad[0].onkeyup = function() {
                        txtChange(this);
                    };
                    if (!ad[0].onclick) {
                        ad[0].onclick = ad[0].onkeyup;
                    }
                    ad[0].onblur = ad[0].onchange = function() {
                        txtChange(this, 1);
                    };
                    ad[0].parent = an[al];
                    an[al].itemTextarea = ad[0];
                }
            } else {
                if (av == "gapfill") {
                    var ad = $$("input", an[al]);
                    for (var J = 0; J < ad.length; J++) {
                        ad[J].onkeyup = function() {
                            txtChange(this);
                        };
                        if (!ad[J].onclick) {
                            ad[J].onclick = ad[J].onkeyup;
                        }
                        ad[J].onblur = ad[J].onchange = function() {
                            txtChange(this, 1);
                        };
                        ad[J].parent = an[al];
                    }
                    an[al].gapFills = ad;
                }
            }
            if (av == "radio_down" || (av == "check" && O._mode)) {
                var R = $$("select", an[al]);
                if (R.length > 0) {
                    R[0].onchange = itemClick;
                    R[0].parent = an[al];
                    an[al].itemSel = R[0];
                }
            }
            var ai = $$("div", an[al]);
            var X = 0;
            var W = null;
            for (ak = 0; ak < ai.length; ak++) {
                if ((av == "radio" || av == "check") && !O.isRate) {
                    var Y = ai[ak].getAttribute("rel");
                    if (Y) {
                        var l = ai[ak].getElementsByTagName("a");
                        if (l.length == 0) {
                            ai[ak].onclick = function() {
                                var k = this.getAttribute("rel");
                                var i = $(k);
                                i.click();
                            };
                        }
                    }
                }
                if (ai[ak].className.toLowerCase() == "div_title_question") {
                    an[al].divTitle = ai[ak];
                } else {
                    if (ai[ak].className.toLowerCase() == "slider") {
                        if (av == "matrix" || av == "sum") {
                            W = ai[ak].parentNode.parentNode;
                            X++;
                        } else {
                            if (av == "slider") {
                                W = an[al];
                            }
                        }
                        W.divSlider = ai[ak];
                        ai[ak].parent = W;
                        var z = ai[ak].getAttribute("minvalue");
                        var H = ai[ak].getAttribute("maxvalue");
                        an[al].dataNode._minvalue = z;
                        an[al].dataNode._maxvalue = H;
                        var ah;
                        if (av == "sum") {
                            ah = W.getElementsByTagName("input")[0];
                        } else {
                            var at = ai[ak].getAttribute("rel");
                            ah = $(at);
                        }
                        var aq = new neverModules.modules.slider({
                            targetId: ai[ak].id,
                            sliderCss: "imageSlider1",
                            barCss: "imageBar1",
                            min: parseInt(z),
                            max: parseInt(H),
                            sliderValue: ah,
                            hints: slider_hint,
                            change: itemClick
                        });
                        aq.create();
                        W.sliderImage = aq;
                        var I = ai[ak].getAttribute("defvalue");
                        if (I && isInt(I)) {
                            aq.setValue(parseInt(I));
                            W.divSlider.value = parseInt(I);
                            if (av == "sum") {
                                if (hasJoin && I) {
                                    if (an[al].sumLeft == undefined) {
                                        an[al].sumLeft = O._total - parseInt(I);
                                    } else {
                                        an[al].sumLeft = an[al].sumLeft - parseInt(I);
                                    }
                                } else {
                                    an[al].sumLeft = 0;
                                }
                            }
                        }
                        if (hasJoin == "1") {
                            aq._slider.onclick = function() {};
                            aq._initMoveSlider = function() {};
                        }
                    }
                }
            }
            if (av == "matrix") {
                var E = new Array();
                var ar = an[al].itemTrs;
                for (var ak = 0; ak < ar.length; ak++) {
                    var G = ar[ak].itemInputs || ar[ak].itemLis || ar[ak].divSlider || ar[ak].itemSels;
                    if (G) {
                        E.push(ar[ak]);
                    }
                }
                if (E.length > 0) {
                    an[al].itemTrs = E;
                }
            }
            if (O && O._hasjump) {
                cur_page = u;
                if (hasJoin) {
                    jumpJoin(an[al], u);
                } else {
                    clearAllOption(an[al]);
                }
                cur_page = 0;
            }
            if (O._referedTopics) {
                Q.push(an[al]);
            }
            if (hasJoin && window.cancelInputClick) {
                cancelInputClick(an[al]);
            }
        }
        if (u > 0 && hasJoin) {
            pageHolder[u].style.display = "none";
        }
    }
    completeLoaded = true;
    if (window.cepingCandidate) {
        var e = cepingCandidate.split(",");
        var ac = new Object();
        for (var w = 0; w < e.length; w++) {
            var N = e[w].replace(/(\s*)/g, "");
            ac[N] = "1";
        }
        var an = pageHolder[0].questions[0];
        if (an.itemInputs) {
            for (var al = 0; al < an.itemInputs.length; al++) {
                var V = an.itemInputs[al].parentNode;
                var C = V.getElementsByTagName("label")[0];
                if (!C) {
                    continue;
                }
                var ap = trim(C.innerHTML);
                ap = ap.replace(/(\s*)/g, "");
                if (ac[ap]) {
                    an.itemInputs[al].checked = true;
                }
            }
        }
        an.style.display = "none";
        an.isCepingQ = "1";
    }
    for (var al = 0; al < Q.length; al++) {
        var ag = Q[al];
        createItem(ag);
    }
    for (var u = 0; u < pageHolder.length; u++) {
        var an = pageHolder[u].questions;
        for (var al = 0; al < an.length; al++) {
            var O = an[al].dataNode;
            var L = O._topic;
            if (relationQs[L]) {
                if (hasJoin) {
                    relationJoin(an[al]);
                } else {
                    clearAllOption(an[al]);
                }
            }
            var b = an[al].getAttribute("qingjing");
            if (b) {
                var f = an[al].getElementsByTagName("input")[0];
                f.checked = true;
                displayRelationRaidoCheck(an[al], O);
            }
        }
    }
    if (lastSavePage > 0 && lastSavePage < totalPage) {
        pageHolder[0].style.display = "none";
        cur_page = lastSavePage - 1;
        show_next_page(true);
    }
    if (lastSaveQ >= 1) {
        var K = $("div" + lastSaveQ);
        if (K) {
            K.scrollIntoView();
            K.onclick();
            joinedTopic = lastSaveQ;
            for (var al = 1; al <= lastSaveQ; al++) {
                progressArray[al + ""] = true;
            }
            showProgressBar();
        }
    }
    if (totalQ == 0) {
        submit_table.style.display = "none";
    }
    processMinMax();
    showProgressBar();
}
var prevPostion;
var resizedMax;
function getMaxTimeStr(c) {
    var d = "";
    var b = c;
    var a = parseInt(b / 3600);
    if (a) {
        d = a + "小时";
        b = b % 3600;
    }
    var e = parseInt(b / 60);
    if (e) {
        d += e + "分";
        b = b % 60;
    }
    if (b) {
        d += b + "秒";
    }
    return d;
}
function processMinMax() {
    if (maxTimer) {
        clearInterval(maxTimer);
    }
    if (isRunning == "true") {
        var c = pageHolder[cur_page]._maxtime;
        if (c) {
            var f = c > 10 ? 10 : 1;
            maxCounter = c;
            divMaxTime.style.position = "absolute";
            addEventSimple(window, "scroll", mmMaxTime);
            addEventSimple(window, "resize", resizeMaxTime);
            mmMaxTime();
            hasMaxtime = true;
            divMaxTime.style.display = "";
            var e = divMaxTime.getElementsByTagName("b")[0];
            if (e) {
                e.innerHTML = "";
            }
            spanMaxTime.innerHTML = getMaxTimeStr(c);
            maxTimer = setInterval(function() {
                maxCounter--;
                spanMaxTime.innerHTML = getMaxTimeStr(maxCounter);
                if (maxCounter <= 0) {
                    clearInterval(maxTimer);
                    divMaxTime.style.display = "none";
                    pageHolder[cur_page].hasExceedTime = true;
                    if (cur_page < totalPage - 1) {
                        show_next_page();
                    } else {
                        alert("提示：您的作答时间已经超过最长时间限制，请直接提交答卷！");
                        pageHolder[cur_page].style.display = "none";
                    }
                }
            },
            1000);
        }
        var b = pageHolder[cur_page]._mintime;
        var d = !IsSampleService || (IsSampleService && promoteSource == "t") || window.pubNeedApply;
        if (!d) {
            b = 0;
        }
        if (b) {
            if (pageHolder[cur_page]._istimer) {
                var a = b;
                next_page.style.display = "none";
                pre_page.style.display = "none";
                var g = setInterval(function() {
                    a--;
                    if (a <= 0) {
                        clearInterval(g);
                        if (cur_page < totalPage - 1) {
                            show_next_page();
                        } else {
                            alert("提示：您的作答时间已经超过最长时间限制，请直接提交答卷！");
                            pageHolder[cur_page].style.display = "none";
                        }
                    }
                },
                1000);
            } else {
                if (!isSuper) {
                    if (next_page) {
                        next_page.disabled = true;
                    }
                    submit_button.disabled = true;
                }
                divMinTime.style.display = "";
                addEventSimple(window, "resize", resizeMinTime);
                resizeMinTime();
                spanMinTime.innerHTML = b;
                var a = b;
                var g = setInterval(function() {
                    a--;
                    spanMinTime.innerHTML = a;
                    if (a <= 0) {
                        clearInterval(g);
                        if (next_page) {
                            next_page.disabled = false;
                        }
                        submit_button.disabled = false;
                        divMinTime.style.display = "none";
                    }
                },
                1000);
            }
        }
    }
}
function resizeMaxTime() {
    resizedMax = true;
    mmMaxTime();
}
function mmMaxTime() {
    var c = document.documentElement.scrollTop || document.body.scrollTop;
    var b = getTop(survey);
    var a = $("ctl00_ContentPlaceHolder1_JQ1_divHead");
    if (a) {
        b = getTop(a);
    }
    var e = b.x - 54;
    var d = c + b.y + 30;
    if (e <= 0) {
        e = qwidth - 10;
        d = c + b.y + 10;
    }
    divMaxTime.style.top = d + "px";
    divMaxTime.style.left = e + "px";
}
function resizeMinTime() {
    var b;
    b = submit_table.style.display == "none" ? next_page: submit_table.lastChild;
    var a = getTop(b);
    divMinTime.style.left = (a.x + b.offsetWidth + 10) + "px";
    divMinTime.style.top = a.y + 8 + "px";
}
function getPreviousNode(b) {
    var a = b.previousSibling;
    if (a && a.nodeType != 1) {
        a = a.previousSibling;
    }
    return a;
}
function getNextNode(b) {
    var a = b.nextSibling;
    if (a && a.nodeType != 1) {
        a = a.nextSibling;
    }
    return a;
}
function updateCart() {
    var h = "";
    var n = 0;
    for (var g = 0; g < shopHT.length; g++) {
        var l = shopHT[g];
        var p = l.itemInputs;
        for (var f = 0; f < p.length; f++) {
            var e = p[f];
            var d = parseInt(e.value);
            if (d == 0) {
                continue;
            }
            var c = e.parentNode.parentNode;
            var o = $$("div", c)[0].innerHTML;
            var b = $$("p", c)[0].getAttribute("price");
            var m = d * parseFloat(b);
            var a = '<li class="productitem"><span class="fpname">' + o + '</span><span class="fpnum">' + d + '</span><span class="fpprice">￥' + m + "</span></li>";
            h += a;
            n += m;
        }
    }
    h = "<ul class='productslist'>" + h + '</ul><div class="ftotalprice"><span class="priceshow">￥' + n + "</span></div>";
    var k = $("shopcart");
    k.innerHTML = h;
    k.style.display = n > 0 ? "": "none";
}
function initItem(e) {
    var b = $$("input", e);
    if (b.length == 0) {
        b = $$("textarea", e);
    }
    for (var d = 0; d < b.length; d++) {
        b[d].parent = e;
        if (e.isShop) {
            var k = getPreviousNode(b[d]);
            k.rel = b[d];
            var a = getNextNode(b[d]);
            a.rel = b[d];
            a.onclick = function() {
                var q = parseInt(this.rel.value);
                var p = false;
                var n = 0;
                var m = this.rel.getAttribute("num");
                if (m) {
                    p = true;
                    n = parseInt(m);
                }
                if (p && q >= n) {
                    var o = "库存只剩" + n + "件，不能再增加！";
                    if (n <= 0) {
                        o = "已售完，无法添加";
                    }
                    alert(o);
                } else {
                    this.rel.value = q + 1;
                    updateCart();
                }
            };
            k.onclick = function() {
                var m = parseInt(this.rel.value);
                if (m < 1) {
                    return;
                }
                this.rel.value = m - 1;
                updateCart();
            };
            b[d].onchange = b[d].onblur = function() {
                if (!isInt(this.value) || this.value - 1 < 0) {
                    this.value = 0;
                }
                updateCart();
            };
            continue;
        }
        if (!b[d].onclick) {
            b[d].onclick = itemClick;
        }
        if (b[d].tagName == "TEXTAREA") {
            b[d].onchange = b[d].onblur = itemClick;
        }
        var l = b[d].getAttribute("rel");
        if (l) {
            var i = null;
            if (l == "psibling") {
                i = getPreviousNode(b[d]);
                b[d].onclick = itemClick;
            } else {
                i = $(l);
            }
            i.itemText = b[d];
            b[d].choiceRel = i;
            if (e.dataNode && !e.dataNode.isSort) {
                b[d].onblur = fcInputboxBlur;
            }
            if (e.dataNode && e.dataNode._referedTopics) {
                b[d].onchange = itemClick;
            }
            if (!b[d].value) {
                b[d].value = defaultOtherText;
            }
            b[d].style.color = "#999999";
            var h = b[d].getAttribute("req");
            if (h == "true") {
                i.req = true;
            } else {
                i.req = false;
            }
        }
        if (e.dataNode && (e.dataNode._type == "radio" || e.dataNode._type == "check") && !e.dataNode.isSort && (!e.dataNode.isRate || e.dataNode._mode == "101")) {
            var f = b[d].nextSibling;
            if (b[d].choiceRel) {
                var i = getPreviousNode(b[d]);
                if (i) {
                    i.style.display = "inline-block";
                    b[d].style.position = "static";
                }
            } else {
                if (f != null) {
                    var g = b[d].parentNode;
                    g.onmouseover = function() {
                        this.style.background = "#efefef";
                    };
                    g.onmouseout = function() {
                        this.style.background = "";
                    };
                }
            }
        } else {
            if (e.tagName == "TR" && (b[d].type == "radio" || b[d].type == "checkbox")) {
                var c = b[d].parentNode;
                c.style.cursor = "pointer";
                c.onclick = function(o) {
                    var m = this.getElementsByTagName("input");
                    var n = m[0];
                    if (n.type == "checkbox") {
                        if (m.length == 1) {
                            n.checked = !n.checked;
                            n.onclick();
                        }
                    } else {
                        n.checked = true;
                        n.onclick();
                    }
                };
                c.onmouseover = function() {
                    this.style.background = "#efefef";
                };
                c.onmouseout = function() {
                    this.style.background = "";
                };
            }
        }
    }
    if (b.length > 0) {
        e.itemInputs = b;
    }
}
function initLikertItem(b) {
    var e = $$("li", b);
    var a = new Array();
    var f = false;
    var d;
    for (j = 0; j < e.length; j++) {
        var c = e[j].className.toLowerCase();
        if (e[j].className && (c.indexOf("off") > -1 || c.indexOf("on") > -1)) {
            e[j].onclick = itemLiClick;
            e[j].onmouseover = itemMouseOver;
            e[j].onmouseout = itemMouseOut;
            e[j].parent = b;
            a.push(e[j]);
            if (c.indexOf("on") > -1) {
                d = e[j];
            } else {
                if (c.indexOf("off") > -1 && d) {
                    d.parent.holder = d.value;
                }
            }
        }
    }
    if (e.length > 0) {
        if (d) {
            d.parent.holder = d.value;
        }
        b.itemLis = a;
    }
}
function createItem(k) {
    var s = k.dataNode;
    var r = s._referedTopics.split(",");
    var t = new Array();
    for (var i = 0; i < k.itemInputs.length; i++) {
        if (k.itemInputs[i].checked) {
            t.push(k.itemInputs[i]);
        }
    }
    for (var i = 0; i < r.length; i++) {
        var l = r[i];
        var n = questionsObject[l];
        if (!n) {
            continue;
        }
        var a = false;
        var c = document.getElementById("divRef" + l);
        if (!c) {
            continue;
        }
        var f = 0;
        switch (n.dataNode._type) {
        case "matrix":
        case "sum":
            var d = n.itemTrs[0].itemInputs || n.itemTrs[0].itemLis || n.itemTrs[0].divSlider || n.itemTrs[0].itemSels;
            if (!d) {
                f = 1;
            }
            for (var p = 0; p < k.itemInputs.length; p++) {
                var e = k.itemInputs[p];
                if (!e.value || e.type != "checkbox") {
                    continue;
                }
                var o = parseInt(e.value) - 1 + f;
                if (!n.itemTrs[o]) {
                    break;
                }
                n.itemTrs[o].style.display = e.checked ? "": "none";
                if (e.checked) {
                    a = true;
                    if (e.itemText) {
                        var u = e.itemText.value;
                        var h = n.itemTrs[o].getElementsByTagName("th")[0];
                        if (h) {
                            if (!h.span) {
                                h.span = document.createElement("span");
                                h.appendChild(h.span);
                            }
                            if (u && u != defaultOtherText) {
                                h.span.innerHTML = "[<span style='color:red;'>" + u + "</span>]";
                            } else {
                                h.span.innerHTML = "";
                            }
                        }
                    }
                }
                if (hasJoin && n.itemTrs[o].divSlider) {
                    var b = n.itemTrs[o].divSlider.getAttribute("defvalue");
                    if (b && isInt(b)) {
                        n.itemTrs[o].sliderImage.setValue(parseInt(b));
                    }
                }
            }
            if (f == 1) {
                n.itemTrs[0].style.display = a ? "": "none";
            }
            c.style.display = a ? "none": "";
            n.displayContent = a;
            n.referDiv = k;
            break;
        case "radio":
        case "check":
            var g = n.itemInputs;
            for (var p = 0; p < k.itemInputs.length; p++) {
                var e = k.itemInputs[p];
                if (!e.value || e.type != "checkbox") {
                    f++;
                    continue;
                }
                var o = parseInt(e.value) - 1 + f;
                if (g[o] && g[o].parentNode) {
                    g[o].parentNode.style.display = e.checked ? "": "none";
                }
                if (e.checked) {
                    a = true;
                    if (e.itemText) {
                        g[o].itemText.value = e.itemText.value;
                    }
                }
            }
            c.style.display = a ? "none": "";
            n.displayContent = a;
            break;
        }
    }
}
var curMatrixItem = null;
function divMatrixItemClick() {
    if (curMatrixItem == this) {
        return;
    }
    if (curMatrixItem != null) {
        curMatrixItem.style.background = curMatrixItem.prevBackColor || "";
        if (curMatrixItem.daoZhi) {
            itemInputs = curMatrixItem.itemInputs;
            for (var a = 0; a < itemInputs.length; a++) {
                itemInputs[a].parentNode.style.background = "";
            }
        }
    }
    curMatrixItem = this;
    if (this.itemInputs) {
        this.style.background = "#edfafe";
    }
}
function divQuestionClick() {
    if (curdiv == this) {
        return;
    }
    if (curdiv != null) {
        curdiv.style.background = "";
    }
    if (curdiv && curdiv.uploadFrame) {
        curdiv.uploadFrame.style.backgroundColor = "";
    }
    hasSaveChanged = true;
    showLeftBar();
    curdiv = this;
    if (this.uploadFrame) {
        this.uploadFrame.style.backgroundColor = "#edfafe";
    }
    if (curMatrixItem != null && curMatrixItem.parent != curdiv) {
        curMatrixItem.style.background = curMatrixItem.prevBackColor || "";
    }
    this.style.background = "#edfafe";
    if (curMatrixItem != null && curMatrixItem.parent == curdiv) {
        this.style.background = "";
    }
    if (this.removeError) {
        this.removeError();
    }
    if (!completeLoaded) {
        this.style.background = "";
        curdiv = null;
    }
    if (this.itemTextarea && curdiv.parentNode && curdiv.parentNode.style.display != "none") {
        this.itemTextarea.focus();
    }
}
function showLeftBar() {
    if (window.divLeftBar && !hasDisplayed) {
        if (divProgressImg) {
            divProgressImg.style.visibility = "visible";
            $("loadprogress").style.visibility = "visible";
        }
        if (divSave) {
            divSave.parentNode.style.visibility = "visible";
            divSave.parentNode.style.marginTop = "5px";
        }
        hasDisplayed = true;
        divLeftBar.style.background = "#ffffff";
    }
}
var loadcss = null;
var loadprogress = null;
function updateProgressBar(b) {
    var a = b._topic;
    if (a > MaxTopic) {
        MaxTopic = a;
    }
    if (!progressArray[a]) {
        joinedTopic++;
        progressArray[a] = true;
        showProgressBar(b);
    }
}
function showProgressBar(d) {
    if (window.divProgressImg) {
        if (!loadcss) {
            loadcss = $("loadcss");
        }
        if (!loadprogress) {
            loadprogress = $("loadprogress");
        }
        var c = totalQ;
        var e = joinedTopic;
        if (progressBarType == 2) {
            c = totalPage;
            e = cur_page + 1;
        }
        var b = parseFloat(e) / c * 100;
        b = b || 0;
        if (b >= 70 && d && d._topic == totalQ) {
            b = 100;
        }
        var a = b + "%";
        loadcss.style.height = a;
        if (progressBarType == 1) {
            loadprogress.innerHTML = "&nbsp;&nbsp;" + b.toFixed(0) + "%";
        } else {
            loadprogress.innerHTML = "&nbsp;" + e + "/" + c + page_info;
        }
        if (hrefSave) {
            if (spanSave) {
                clearInterval(saveInterval);
            }
        }
    }
}
function checkMinMax(d, g, f) {
    if (langVer == 0 && (g._maxValue > 0 || g._minValue > 0)) {
        var k = f.itemInputs;
        var e = 0;
        for (var b = 0; b < k.length; b++) {
            if (k[b].checked) {
                e++;
            }
        }
        if (!f.divChecktip) {
            f.divChecktip = document.createElement("div");
            f.appendChild(f.divChecktip);
            f.divChecktip.style.color = "666";
        }
        var a = "&nbsp;&nbsp;&nbsp;您已经选择了" + e + "项";
        if (g._maxValue > 0 && e > g._maxValue) {
            if (!g._referedTopics && !g._hasjump && !relationQs[g._topic]) {
                alert("此题最多只能选择" + g._maxValue + "项");
                d.checked = false;
                e--;
                a = "&nbsp;&nbsp;&nbsp;您已经选择了" + e + "项";
                var h = d.getAttribute("rel");
                if (g.isSort && h && $(h)) {
                    for (var c = 0; c < $(h).options.length; c++) {
                        if ($(h).options[c].value == d.value) {
                            $(h).options[c] = null;
                        }
                    }
                }
            } else {
                a += ",<span style='color:red;'>多选择了" + (e - g._maxValue) + "项</span>";
            }
        } else {
            if (g._minValue > 0 && e < g._minValue) {
                a += ",<span style='color:red;'>少选择了" + (g._minValue - e) + "项</span>";
                if (d.checked && g._select[d.value - 1] && g._select[d.value - 1]._item_huchi) {
                    a = "";
                }
            }
        }
        f.divChecktip.innerHTML = a;
    }
}
function itemSortClick() {
    var b = this.getAttribute("rel");
    if (b) {
        var e = $(b);
        var c = e.selectedIndex;
        var a = e.options.length;
        if (this.name == "up" && c > 0) {
            var d = e.options[c];
            var f = e.options[c - 1];
            e.insertBefore(d, f);
        } else {
            if (this.name == "first" && c > 0) {
                var d = e.options[c];
                var f = e.options[0];
                e.insertBefore(d, f);
            } else {
                if (this.name == "down" && c >= 0 && c < a - 1) {
                    var d = e.options[c];
                    var g = e.options[c + 1];
                    e.insertBefore(g, d);
                } else {
                    if (this.name == "last" && c >= 0 && c < a - 1) {
                        var d = e.options[c];
                        var g = e.options[a - 1];
                        e.insertBefore(d, g);
                        e.insertBefore(g, d);
                    }
                }
            }
        }
    }
}
function itemClick(k) {
    var e = this.parent.parent || this.parent;
    if (e.isTrap) {
        return;
    }
    var m = e.dataNode;
    updateProgressBar(m);
    if (this.itemText && this.itemText.onclick) {
        if (this.checked) {
            this.itemText.onclick();
        } else {
            if (this.itemText.onblur) {
                this.itemText.onblur();
            }
        }
    }
    if (this.type == "checkbox") {
        checkHuChi(e, this);
        var n = this.getAttribute("rel");
        if (n) {
            var c = $(n);
            var p = c.options;
            if (this.checked) {
                var b = this.nextSibling.nodeValue || this.nextSibling.innerHTML;
                if (!b && this.nextSibling.nextSibling) {
                    b = this.nextSibling.nextSibling.innerHTML;
                }
                var d = false;
                for (var a = 0; a < p.length; a++) {
                    if (p[a].value == this.value) {
                        d = true;
                        break;
                    }
                }
                if (!d) {
                    c.options[p.length] = new Option(b, this.value);
                }
            } else {
                for (var a = 0; a < p.length; a++) {
                    if (p[a].value == this.value) {
                        p[a] = null;
                    }
                }
            }
        }
        if (m._referedTopics) {
            createItem(e);
        }
        displayRelationRaidoCheck(e, m);
        checkMinMax(this, m, e);
        jump(e, this);
        if (m._type == "matrix") {
            k = k || window.event;
            if (k) {
                if (k.stopPropagation) {
                    k.stopPropagation();
                } else {
                    k.cancelBubble = true;
                }
            }
        }
    } else {
        if (this.type == "radio" || m._type == "slider" || (m._type == "matrix" && m._mode != "201")) {
            if(this.name=="q2"){
                if (this.value=="1") {
                    $('div20').style.display="block";
                    $('div21').style.display="block";
                    $('div22').style.display="block";
                    $('div18').style.display="none";
                    $('div19').style.display="none";
                }else if(this.value=="2"){
                    $('div20').style.display="none";
                    $('div21').style.display="none";
                    $('div22').style.display="none";
                    $('div18').style.display="block";
                    $('div19').style.display="block";
                }else{
                    $('div20').style.display="block";
                    $('div21').style.display="block";
                    $('div22').style.display="block";
                    $('div18').style.display="block";
                    $('div19').style.display="block";
                }
            }
            if (!m._requir && !e.hasClearHref) {
                addClearHref(e);
            }
            displayRelationRaidoCheck(e, m);
            jump(e, this);
            if (m._type == "matrix" && (m._mode == "102" || m._mode == "103" || m._mode == "101") && this.type == "text") {
                processTextR(this, e, m);
            }
        } else {
            if (m._type == "matrix" && m._mode == "201") {
                var h = e.itemTrs;
                var f = 0;
                var o;
                for (var a = 0; a < h.length; a++) {
                    f = validateMatrix(m, h[a], h[a].itemInputs[0]);
                    if (f && !o) {
                        o = h[a].itemInputs[0];
                        break;
                    }
                }
                if (e.removeError) {
                    e.removeError();
                }
                if (o) {
                    e.errorControl = o;
                    validate_ok = writeError(e, verifyMsg, 3000);
                }
                var l = false;
                for (var a = 0; a < h.length; a++) {
                    var g = h[a].itemInputs[0];
                    if (trim(g.value) != "") {
                        l = true;
                        break;
                    }
                }
                jumpAny(l, e);
            } else {
                if (m._type == "sum") {
                    if (this.parent.sliderImage) {
                        sumClick(e, this.parent.sliderImage.sliderValue);
                    } else {
                        sumClick(e, this);
                    }
                } else {
                    if (this.type == "text") {
                        processTextR(this, e, m);
                    } else {
                        if (this.nodeName == "SELECT") {
                            if (m._type == "check") {
                                return;
                            }
                            e.focus();
                            jump(e, this);
                            displayRelationDropDown(e, m);
                        }
                    }
                }
            }
        }
    }
}
function processTextR(c, a, b) {
    if (c.choiceRel) {
        if (c.value == defaultOtherText) {
            c.value = "";
        }
        c.choiceRel.checked = true;
        c.style.color = "#000000";
        c.style.background = "";
        if (b._referedTopics) {
            createItem(a);
        }
        if (c.choiceRel.type == "checkbox") {
            checkHuChi(a, c.choiceRel);
            checkMinMax(c.choiceRel, b, a);
        }
        displayRelationRaidoCheck(a, b);
        jump(a, c.choiceRel);
    }
}
function checkHuChi(c, f) {
    if (!f.checked) {
        return;
    }
    var e = c.dataNode;
    if (!e.hasHuChi) {
        return;
    }
    var a = c.itemInputs;
    var d = e._select[f.value - 1]._item_huchi;
    for (var b = 0; b < a.length; b++) {
        if (a[b].type != "checkbox") {
            continue;
        }
        if (a[b] == f) {
            continue;
        }
        if (!a[b].checked) {
            continue;
        }
        if (d) {
            a[b].click();
            a[b].checked = false;
        } else {
            var g = e._select[a[b].value - 1]._item_huchi;
            if (g) {
                a[b].click();
                a[b].checked = false;
            }
        }
    }
}
function relationJoin(b) {
    if (b.style.display != "none") {
        var c = b.dataNode;
        var a = c._type;
        if (a == "radio" || a == "check") {
            displayRelationRaidoCheck(b, c);
        } else {
            if (a == "radio_down") {
                displayRelationDropDown(b, c);
            }
        }
    }
}
function displayRelationRaidoCheck(h, k) {
    var d = k._topic;
    if (!relationQs[d]) {
        return;
    }
    h.hasDisplayByRelation = new Object();
    var i = -1;
    if (h.itemLis) {
        var e = h.itemLis;
        for (var f = 0; f < e.length; f++) {
            if (e[f].className.indexOf("on") > -1) {
                i = f + 1;
            }
        }
        for (var f = 0; f < e.length; f++) {
            var c = false;
            var b = e[f].value;
            var g = d + "," + b;
            if (i > -1 && b == i) {
                c = true;
            }
            displayByRelation(h, g, c);
        }
    } else {
        var e = h.itemInputs;
        for (var f = 0; f < e.length; f++) {
            var c = false;
            var b = e[f].value;
            var g = d + "," + b;
            if (e[f].checked) {
                c = true;
            }
            displayByRelation(h, g, c);
            var a = d + ",-" + b;
            if (relationHT[a]) {
                displayByRelationNotSelect(h, a, c);
            }
        }
    }
    loopJoinProgressQ(d);
}
function loopJoinProgressQ(b) {
    if (!relationQs[b]) {
        return;
    }
    for (var d = 0; d < relationQs[b].length; d++) {
        var c = relationQs[b][d];
        var a = c.dataNode._topic;
        if (c.style.display == "none" && !progressArray[a]) {
            progressArray[a] = "jump";
            joinedTopic++;
        }
        loopJoinProgressQ(a);
    }
}
function displayRelationDropDown(f, h) {
    var c = h._topic;
    if (!relationQs[c]) {
        return;
    }
    var i = f.itemSel;
    var g = f.itemSel.value;
    f.hasDisplayByRelation = new Object();
    for (var d = 0; d < i.length; d++) {
        var b = false;
        var a = i[d].value;
        var e = c + "," + a;
        if (a == g) {
            b = true;
        }
        displayByRelation(f, e, b);
    }
    loopJoinProgressQ(c);
}
function displayByRelation(c, f, b) {
    var d = relationHT[f];
    if (!d) {
        return;
    }
    for (var a = 0; a < d.length; a++) {
        if (c.hasDisplayByRelation[d[a].dataNode._topic]) {
            continue;
        }
        if (!b && d[a].style.display != "none") {
            loopHideRelation(d[a]);
        } else {
            if (b) {
                d[a].style.display = "";
                var e = d[a].dataNode._topic;
                c.hasDisplayByRelation[e] = "1";
                if (progressArray[e] == "jump") {
                    progressArray[e] = false;
                    joinedTopic--;
                }
                if (relationNotDisplayQ[e]) {
                    relationNotDisplayQ[e] = "";
                }
            }
        }
    }
}
function displayByRelationNotSelect(c, f, b) {
    var d = relationHT[f];
    if (!d) {
        return;
    }
    for (var a = 0; a < d.length; a++) {
        if (c.hasDisplayByRelation[d[a].dataNode._topic]) {
            continue;
        }
        if (b && d[a].style.display != "none") {
            loopHideRelation(d[a]);
        } else {
            if (!b) {
                d[a].style.display = "";
                var e = d[a].dataNode._topic;
                c.hasDisplayByRelation[e] = "1";
                if (progressArray[e] == "jump") {
                    progressArray[e] = false;
                    joinedTopic--;
                }
                if (relationNotDisplayQ[e]) {
                    relationNotDisplayQ[e] = "";
                }
            }
        }
    }
}
function loopHideRelation(a) {
    var c = a.dataNode._topic;
    var b = relationQs[c];
    if (b) {
        for (var d = 0; d < b.length; d++) {
            loopHideRelation(b[d], false);
        }
    }
    clearAllOption(a);
    a.style.display = "none";
    if (relationNotDisplayQ[c] == "") {
        relationNotDisplayQ[c] = "1";
    }
}
function sumClick(l, k, m) {
    var d = l.getElementsByTagName("input");
    var p = l.dataNode;
    updateProgressBar(p);
    if (d) {
        var o = d.length;
        var s = p._total;
        var b = s;
        var f = 0;
        var r;
        var q;
        var g = k.value;
        if (parseInt(g) < 0) {
            k.value = "";
        }
        for (var n = 0; n < o; n++) {
            var h = d[n].value;
            var a = l.itemTrs[n];
            if (a.style.display == "none") {
                h = "";
            }
            var t = a.sliderImage;
            if (n == o - 1) {
                r = d[n];
                q = t;
            }
            if (h && trim(h)) {
                if (isInt(h)) {
                    b = b - parseInt(h);
                    if (t._value == undefined) {
                        t.setValue(parseInt(g), true);
                    } else {
                        if (m && d[n] == k) {
                            t.setValue(parseInt(g), true);
                        }
                    }
                } else {
                    d[n].value = "";
                    f++;
                }
            } else {
                if (a.style.display == "none") {} else {
                    f++;
                }
            }
        }
        if (f == 1 && b >= 0) {
            q.setValue(b, true);
            r.value = b;
            b = 0;
        }
        var c = "";
        if (f == 0 && b != 0) {
            var e = parseInt(r.value) + b;
            if (e > 0) {
                q.setValue(e, true);
                r.value = e;
                b = 0;
            } else {
                c = "，<span style='color:red;'>" + sum_warn + "</span>";
            }
        }
        if (b == 0) {
            for (var n = 0; n < o; n++) {
                if (!d[n].value) {
                    d[n].value = "0";
                }
            }
        }
        l.sumLeft = b;
        if (l.relSum) {
            l.relSum.innerHTML = sum_total + "<b>" + s + "</b>" + sum_left + "<span style='color:red;font-bold:true;'>" + (s - b) + "</span>" + c;
        }
        jump(l, this);
    }
}
function jump(b, e) {
    var c = b.dataNode;
    var a = c._anytimejumpto;
    var d = c._hasjump;
    if (d) {
        if (a > 0) {
            jumpAnyChoice(b);
        } else {
            if (a == 0 && c._type != "radio" && c._type != "radio_down") {
                jumpAnyChoice(b);
            } else {
                jumpByChoice(b, e);
            }
        }
    }
}
function jumpAnyChoice(d, e) {
    var a = d.itemInputs || d.itemLis || d.itemTrs || d.gapFills;
    var c = false;
    if (a) {
        for (var b = 0; b < a.length; b++) {
            if (a[b].checked) {
                c = true;
            } else {
                if (a[b].className.indexOf("on") > -1) {
                    c = true;
                } else {
                    if (a[b].divSlider && a[b].divSlider.value) {
                        c = true;
                    } else {
                        if (a[b].tagName == "TEXTAREA" && trim(a[b].value) != "") {
                            c = true;
                        } else {
                            if (a[b].type == "text" && trim(a[b].value) != "") {
                                c = true;
                            } else {
                                if (a[b].itemSels) {
                                    for (var f = 0; f < a[b].itemSels.length; f++) {
                                        if (a[b].itemSels[f]) {
                                            c = true;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (c) {
                break;
            }
        }
    } else {
        if (d.itemSel) {
            if (d.itemSel.selectedIndex > 0) {
                c = true;
            } else {
                c = false;
            }
        } else {
            if (d.divSlider) {
                c = (d.divSlider.value != undefined && d.divSlider.value != null) ? true: false;
            } else {
                if (d.itemTextarea) {
                    c = trim(d.itemTextarea.value) != "";
                } else {
                    if (d.uploadFrame) {
                        c = d.fileName ? true: false;
                    }
                }
            }
        }
    }
    jumpAny(c, d, e);
}
function jumpByChoice(b, d) {
    var c = b.dataNode;
    if (d.value == "-2") {
        processJ(b.indexInPage - 0, 0);
    } else {
        if (d.value == "-1" || d.value == "") {
            processJ(b.indexInPage - 0, 0);
        } else {
            if ((c._type == "radio" || c._type == "radio_down") && parseInt(d.value) == d.value) {
                var a = c._select[d.value - 1]._item_jump;
                processJ(b.indexInPage - 0, a - 0);
            }
        }
    }
}
function txtChange(c, l) {
    var e = c.parent.parent || c.parent;
    updateProgressBar(e.dataNode);
    hasSaveChanged = true;
    if (e.removeError) {
        e.removeError();
    }
    if ((e.dataNode._needOnly || (e.dataNode._hasList && e.dataNode._listId != -1)) && trim(c.value) != "" && l) {
        var a = getXmlHttp();
        a.onreadystatechange = function() {
            if (a.readyState == 4) {
                if (a.status == 200) {
                    if (unescape(a.responseText) == "false1") {
                        c.isOnly = false;
                        writeError(e, validate_only, 3000);
                    } else {
                        if (unescape(a.responseText) == "false2") {
                            c.isInList = false;
                            c.isOnly = true;
                            writeError(e, validate_list, 3000);
                        } else {
                            c.isInList = true;
                            c.isOnly = true;
                        }
                    }
                } else {
                    c.isOnly = true;
                    c.isInList = true;
                }
            }
        };
        var n = e.dataNode._needOnly;
        var i = e.dataNode._hasList && e.dataNode._listId != -1;
        var d = e.dataNode._listId;
        a.open("get", "/Handler/AnswerOnlyHandler.ashx?q=" + activityId + "&at=" + escape(c.value) + "&qI=" + e.dataNode._topic + "&o=" + n + "&l=" + i + "&lid=" + d + "&t=" + (new Date()).valueOf());
        a.send(null);
    }
    var h = e.dataNode._verify;
    if (e.dataNode._type == "matrix" && e.dataNode._mode == "303") {
        h = "数字";
    }
    if (c.value != "" && h && h != "0") {
        if (e.removeError) {
            e.removeError();
        }
        var k = e.dataNode;
        var m = e.getAttribute("issample");
        var g = true;
        if (m && promoteSource != "t") {
            g = false;
        }
        if (g) {
            var b = verifyMinMax(c, h, k._minword, k._maxword);
            if (b != "") {
                validate_ok = writeError(e, b, 3000);
            }
            b = verifydata(c, h, e.dataNode);
            if (b != "") {
                validate_ok = writeError(e, b, 3000);
            }
        }
    }
    if (e.dataNode._type == "gapfill") {
        var f = 0;
        f = validateMatrix(e.dataNode, c, c);
        if (f) {
            e.errorControl = c;
            writeError(e, verifyMsg, 3000);
        }
    }
    if (e.dataNode._type == "sum") {
        sumClick(e, c, 1);
    } else {
        jumpAny(trim(c.value) != "", e);
    }
}
function jumpAny(a, b, d) {
    var c = b.dataNode;
    if (c._hasjump) {
        if (a) {
            processJ(b.indexInPage - 0, c._anytimejumpto - 0, d);
        } else {
            processJ(b.indexInPage - 0, 0, d);
        }
    }
}
function processJ(l, c, d) {
    var a = l + 1;
    var b = cur_page;
    for (var g = cur_page; g < pageHolder.length; g++) {
        var k = pageHolder[g].questions;
        if (c == 1) {
            b = g;
        }
        for (var f = a; f < k.length; f++) {
            var h = k[f].dataNode._topic;
            if (h == c || c == 1) {
                b = g;
            }
            if (h < c || c == 1) {
                k[f].style.display = "none";
                if (!progressArray[h]) {
                    joinedTopic++;
                    progressArray[h] = "jump";
                }
            } else {
                if (relationNotDisplayQ[h]) {
                    var e = 1;
                } else {
                    k[f].style.display = "";
                }
                if (progressArray[h] == "jump") {
                    joinedTopic--;
                    progressArray[h] = false;
                }
                if (k[f].dataNode._hasjump && !d) {
                    clearAllOption(k[f]);
                }
            }
        }
        a = 0;
    }
    if (c == 1) {
        joinedTopic = totalQ;
    }
    showProgressBar();
}
function addClearHref(b) {
    var c = b.dataNode;
    var a = document.createElement("a");
    a.title = validate_info_submit_title2;
    a.className = "link-999";
    a.style.marginLeft = "25px";
    a.innerHTML = "[" + type_radio_clear + "]";
    a.href = "javascript:void(0);";
    b.hasClearHref = true;
    b.divTitle.appendChild(a);
    b.clearHref = a;
    a.onclick = function() {
        clearAllOption(b);
        jumpAny(false, b);
    };
}
function clearAllOption(d) {
    var e = d.itemSel;
    if (e) {
        e.selectedIndex = 0;
    }
    if (d.divSlider && d.divSlider.value != undefined) {
        d.sliderImage.setValue(d.dataNode._minvalue, true);
        d.divSlider.value = undefined;
    }
    var a = d.itemInputs || d.itemLis || d.itemTrs;
    if (!a) {
        return;
    }
    d.hasClearHref = false;
    if (d.clearHref) {
        d.clearHref.parentNode.removeChild(d.clearHref);
        d.clearHref = null;
    }
    for (var c = 0; c < a.length; c++) {
        if (a[c].checked) {
            a[c].checked = false;
        } else {
            if (a[c].className.toLowerCase().indexOf("on") > -1) {
                a[c].className = "off" + d.dataNode._mode;
            } else {
                if (a[c].parent && a[c].parent.holder) {
                    a[c].parent.holder = 0;
                } else {
                    if (a[c].divSlider && a[c].divSlider.value) {
                        a[c].sliderImage.setValue(d.dataNode._minvalue, true);
                        a[c].divSlider.value = undefined;
                    } else {
                        var f = a[c].itemInputs || a[c].itemLis;
                        if (f) {
                            for (var b = 0; b < f.length; b++) {
                                if (f[b].checked) {
                                    f[b].checked = false;
                                } else {
                                    if (f[b].className.toLowerCase().indexOf("on") > -1) {
                                        f[b].className = "off" + d.dataNode._mode;
                                    } else {
                                        if (f[b].parent && f[b].parent.holder) {
                                            f[b].parent.holder = 0;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    if (d.holder) {
        d.holder = 0;
    }
}
function itemMouseOver() {
    var c = this.parent.parent || this.parent;
    if (c.dataNode.isRate) {
        var a = this.parent.itemLis.length;
        var d = "on";
        for (var b = 0; b < a; b++) {
            d = b < this.value ? "on": "off";
            this.parent.itemLis[b].className = d + c.dataNode._mode;
        }
    }
}
function itemMouseOut() {
    var d = this.parent.parent || this.parent;
    if (d.dataNode.isRate) {
        var a = this.parent.itemLis.length;
        var e = "on";
        var c = this.parent.holder || 0;
        for (var b = 0; b < a; b++) {
            e = b < c ? "on": "off";
            this.parent.itemLis[b].className = e + d.dataNode._mode;
        }
    }
}
function itemLiClick() {
    var b = this.parent.parent || this.parent;
    var c = b.dataNode;
    updateProgressBar(c);
    if (c.isRate) {
        this.parent.holder = this.value;
        for (var a = 0; a < this.value; a++) {
            this.parent.itemLis[a].className = "on" + c._mode;
        }
        if (!c._requir && !b.hasClearHref) {
            addClearHref(b);
        }
        displayRelationRaidoCheck(b, c);
        jump(b, this);
    }
}
function set_data_fromServer(d) {
    var m = new Array();
    m = d.split("¤");
    var h = m[0];
    var a = h.split("§");
    hasTouPiao = a[0] == "true";
    useSelfTopic = a[1] == "true";
    var q = 0;
    var n = 0;
    var l = true;
    var p = 0;
    for (var k = 1; k < m.length; k++) {
        var f = new Object();
        var e = m[k].split("§");
        switch (e[0]) {
        case "page":
            if (l) {
                l = false;
            } else {
                n++;
            }
            p = 0;
            if (e[2] == "true") {
                pageHolder[n]._iszhenbie = true;
            } else {
                if (e[2] == "time") {
                    pageHolder[n]._istimer = true;
                }
            }
            pageHolder[n]._mintime = e[3] ? parseInt(e[3]) : "";
            pageHolder[n]._maxtime = e[4] ? parseInt(e[4]) : "";
            break;
        case "question":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            f._height = trim(e[2]);
            f._maxword = trim(e[3]);
            if (e[4] == "true") {
                f._requir = true;
            } else {
                f._requir = false;
            }
            if (e[5] == "true") {
                f._norepeat = true;
            } else {
                f._norepeat = false;
            }
            if (trim(e[6]) == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = trim(e[7]);
            f._verify = trim(e[8]);
            f._needOnly = e[9] == "true" ? true: false;
            f._hasList = e[10] == "true" ? true: false;
            f._listId = e[11] ? parseInt(e[11]) : -1;
            f._minword = e[12];
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        case "slider":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            if (e[2] == "true") {
                f._requir = true;
            } else {
                f._requir = false;
            }
            f._minvalue = trim(e[3]);
            f._maxvalue = trim(e[4]);
            if (trim(e[5]) == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = trim(e[6]);
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        case "fileupload":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            if (e[2] == "true") {
                f._requir = true;
            } else {
                f._requir = false;
            }
            f._maxsize = trim(e[3]);
            f._ext = trim(e[4]);
            if (trim(e[5]) == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = trim(e[6]);
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        case "gapfill":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            if (e[2] == "true") {
                f._requir = true;
            } else {
                f._requir = false;
            }
            f._gapcount = trim(e[3]);
            if (trim(e[4]) == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = trim(e[5]);
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        case "sum":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            if (e[2] == "true") {
                f._requir = true;
            } else {
                f._requir = false;
            }
            f._total = parseInt(e[3]);
            if (trim(e[4]) == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = trim(e[5]);
            f._referTopic = e[6];
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        case "radio":
        case "check":
        case "radio_down":
        case "matrix":
            f._type = trim(e[0]);
            f._topic = trim(e[1]);
            f._numperrow = trim(e[2]);
            if (e[3] == "true") {
                f._hasvalue = true;
            } else {
                f._hasvalue = false;
            }
            if (e[4] == "true") {
                f._hasjump = true;
            } else {
                f._hasjump = false;
            }
            f._anytimejumpto = e[5];
            f._mode = trim(e[9]);
            if (e[0] != "check") {
                if (e[6] == "true") {
                    f._requir = true;
                } else {
                    f._requir = false;
                }
                f.isSort = false;
                f.isRate = isRadioRate(f._mode);
            } else {
                var o = e[6].split(",");
                f._minValue = 0;
                f._maxValue = 0;
                if (o[0] == "true") {
                    f._requir = true;
                } else {
                    f._requir = false;
                }
                if (o[1] != "") {
                    f._minValue = Number(o[1]);
                }
                if (o[2] != "") {
                    f._maxValue = Number(o[2]);
                }
                f.isSort = f._mode != "" && f._mode != "0";
                f.isRate = false;
            }
            if (e[7] == "true") {
                f._isTouPiao = true;
            } else {
                f._isTouPiao = false;
            }
            f._verify = trim(e[8]);
            f._referTopic = e[10];
            f._referedTopics = e[11];
            var c = 12;
            f._select = new Array();
            for (var g = c; g < e.length; g++) {
                f._select[g - c] = new Object();
                var b = e[g].split("〒");
                if (b[0] == "true") {
                    f._select[g - c]._item_radio = true;
                } else {
                    f._select[g - c]._item_radio = false;
                }
                f._select[g - c]._item_value = trim(b[1]);
                f._select[g - c]._item_jump = trim(b[2]);
                f._select[g - c]._item_huchi = b[3] == "true";
                if (f._select[g - c]._item_huchi) {
                    f.hasHuChi = true;
                }
            }
            pageHolder[n].questions[p].dataNode = f;
            p++;
            break;
        default:
            break;
        }
    }
}
function show_pre_page() {
    if (cur_page > 0 && pageHolder[cur_page - 1].hasExceedTime) {
        alert("上一页填写超时，不能返回上一页");
        return;
    }
    submit_table.style.display = "none";
    next_page.style.display = "";
    pageHolder[cur_page].style.display = "none";
    cur_page--;
    for (var c = cur_page; c >= 0; c--) {
        if (pageHolder[c].skipPage) {
            cur_page--;
        } else {
            break;
        }
    }
    for (var c = cur_page; c >= 0; c--) {
        if (pageHolder[c].questions.length == 0) {
            break;
        }
        var a = pageHolder[c].questions;
        var e = false;
        for (var b = 0; b < a.length; b++) {
            var d = a[b];
            if (d.style.display != "none") {
                e = true;
                break;
            }
        }
        if (!e && cur_page > 0) {
            cur_page--;
        } else {
            break;
        }
    }
    if (cur_page == 0 && pre_page) {
        pre_page.style.display = displayPrevPage;
        pre_page.disabled = true;
    }
    if (window.divTouPiouId) {
        $(divTouPiouId).style.display = "none";
    }
    showDesc();
    pageHolder[cur_page].style.display = "";
    var a = pageHolder[cur_page].questions;
    pageHolder[cur_page].scrollIntoView();
    adjustHeight();
}
function adjustHeight() {
    try {
        if (window.parent && window.parent.adjustMyFrameHeight) {
            window.parent.adjustMyFrameHeight();
        }
    } catch(a) {}
}
var pubNoCheck = null;
var saveNeedAlert = true;
function checkDisalbed() {
    curdiv = null;
    if (!submit_button.disabled) {
        return false;
    }
    if (divMinTime.innerHTML) {
        var a = divMinTime.innerHTML.replace(/<.+?>/gim, "");
        alert(a);
    }
    return true;
}
function show_next_page(a) {
    if (next_page) {
        next_page.disabled = true;
    }
    curdiv = null;
    if (pubNoCheck != true) {
        if (isPreview) {
            submit_button.onclick = function() {
                if (checkDisalbed()) {
                    return;
                }
                alert("此为预览状态，不能提交答卷！");
            };
            to_next_page();
            return;
        } else {
            if (a != true && !validate()) {
                if (isPub && pubNoCheck == null) {
                    if (window.confirm("您填写的数据不符合要求，由于您是发布者，可以选择直接跳到下一页（此次填写的答卷将不能提交），是否确定？")) {
                        pubNoCheck = true;
                        $("submittest_button").onclick = submit_button.onclick = function() {
                            if (checkDisalbed()) {
                                return;
                            }
                            alert("由于您选择了跳过了数据检查，所以此次填写的答卷无法提交！如果您需要提交答卷，请刷新此页面并再次填写问卷。");
                        };
                        to_next_page();
                        return;
                    } else {
                        pubNoCheck = false;
                        next_page.disabled = false;
                        return;
                    }
                } else {
                    next_page.disabled = false;
                    return;
                }
            }
        }
    } else {
        if (pubNoCheck == true) {
            to_next_page();
            return;
        }
    }
    if (pageHolder[cur_page]._iszhenbie && isRunning == "true" && a != true) {
        submit(3);
    } else {
        to_next_page();
        if (a != true && allowSaveJoin && isRunning == "true" && guid) {
            saveNeedAlert = false;
            submit(2);
        }
    }
}
function to_next_page() {
    if (cur_page == 0 && nextPageAlertText) {
        alert(nextPageAlertText);
    }
    pre_page.style.display = displayPrevPage;
    pre_page.disabled = false;
    pageHolder[cur_page].style.display = "none";
    cur_page++;
    next_page.disabled = false;
    for (var c = cur_page; c < pageHolder.length; c++) {
        if (pageHolder[c].skipPage) {
            cur_page++;
        } else {
            break;
        }
    }
    var g = false;
    for (var c = cur_page; c < pageHolder.length; c++) {
        if (pageHolder[c].questions.length == 0 && !g) {
            break;
        }
        var a = pageHolder[c].questions;
        var f = false;
        for (var b = 0; b < a.length; b++) {
            var e = a[b];
            if (e.style.display != "none") {
                f = true;
                break;
            }
        }
        if (!f && cur_page < pageHolder.length - 1) {
            cur_page++;
            g = true;
        } else {
            break;
        }
    }
    var d = true;
    for (var c = cur_page + 1; c < pageHolder.length; c++) {
        if (!pageHolder[c].skipPage) {
            d = false;
        }
    }
    if (cur_page >= pageHolder.length - 1 || d) {
        next_page.style.display = "none";
        if (hasJoin != "1") {
            submit_table.style.display = "";
        }
        if (window.divTouPiouId) {
            $(divTouPiouId).style.display = "";
        }
    } else {
        if (cur_page < pageHolder.length - 1) {
            next_page.style.display = "";
        }
    }
    if (divMaxTime) {
        divMaxTime.style.display = "none";
    }
    showDesc();
    pageHolder[cur_page].style.display = "";
    pageHolder[cur_page].scrollIntoView();
    showProgressBar();
    processMinMax();
    adjustHeight();
}
function showDesc() {
    if (!window.divDec) {
        return;
    }
    var a = document.getElementById(window.divDec);
    if (a) {
        a.style.display = cur_page > 0 ? "none": "";
    }
}
if (hrefPreview) {
    hrefPreview.onclick = function() {
        submit(0);
        return false;
    };
}
var spanSave = null;
var saveInterval = null;
var hasSaveChanged = false;
var manualSave = false;
var changeInterval = null;
var totalSaveSec = 1;
if (hrefSave) {
    hrefSave.onclick = function() {
        if (isRunning != "true") {
            alert("此问卷处于停止状态，不能保存！");
            return;
        }
        manualSave = true;
        submit(2);
        manualSave = false;
        return false;
    };
    if (isRunning == "true") {
        saveInterval = setInterval(function() {
            submit(2);
        },
        60000);
    }
}
var havereturn = false;
var timeoutTimer = null;
var errorTimes = 0;
var hasSendErrorMail = false;
function processError(e, c, b, a) {
    if (!havereturn) {
        havereturn = true;
        var d = "";
        var f = encodeURIComponent(e);
        if (f.length > 1800) {
            d = a + "&submitdata=exceed&partdata=" + f.substring(0, 1700);
        } else {
            d = a;
            if (a.indexOf("submitdata=") == -1) {
                d += "&submitdata=" + f;
            }
            if (a.indexOf("useget=") == -1) {
                d += "&useget=1";
            }
            if (a.indexOf("iframe=") == -1) {
                d += "&iframe=1";
            }
        }
        errorTimes++;
        if (errorTimes == 1 && !hasSendErrorMail) {
            d += "&nsd=1";
            hasSendErrorMail = true;
        }
        PDF_launch("/wjx/join/jqerror.aspx?" + d + "&status=" + encodeURIComponent(c) + "&et=" + errorTimes, 400, 120);
        refresh_validate();
        submit_tip.style.display = "none";
        submit_div.style.display = "block";
    }
    if (!window.submitWithGet) {
        window.submitWithGet = 1;
    }
    if (timeoutTimer) {
        clearTimeout(timeoutTimer);
    }
}
function submit(n) {
    if (n != 2 && !validate()) {
        return;
    }
    if (n == 1) {
        if (window.isDianChu) {
            if (!is_dianchecked) {
                tou_submit.call(this);
                return false;
            }
        } else {
            if (tCode && tCode.style.display != "none" && (submit_text.value == "" || submit_text.value == validate_info_submit_title3)) {
                alert(validate_info_submit1);
                try {
                    submit_text.focus();
                    submit_text.click();
                } catch(u) {}
                return false;
            }
        }
    }
    submit_tip.innerHTML = validate_info_submit2;
    if (n == 0) {
        PromoteUser("正在处理，请稍候...", 3000, true);
    } else {
        if (n == 2) {
            var o = "已保存";
            if (langVer == 1) {
                o = "Saved";
            }
            if (!hasSaveChanged) {
                if (manualSave) {
                    if (spanSave) {
                        spanSave.innerHTML = "&nbsp;" + o;
                        if (langVer == 1) {
                            spanSave.innerHTML = "<div style='font-size:18px;'>&nbsp;&nbsp;Saved</div>";
                        }
                    } else {
                        PromoteUser(o, 3000, true);
                    }
                    submit_tip.scrollIntoView();
                }
                return;
            }
            if (spanSave) {
                spanSave.innerHTML = "&nbsp;正在保存，请稍候...";
            }
            var x = cur_page;
        } else {
            if (n == 3) {
                PromoteUser("正在验证，请稍候...", 3000, true);
            } else {
                submit_tip.style.display = "block";
                submit_div.style.display = "none";
            }
        }
    }
    needCheckLeave = false;
    var h = sent_to_answer();
    var y = getXmlHttp();
    y.onreadystatechange = function() {
        if (y.readyState == 4) {
            clearTimeout(timeoutTimer);
            var e = y.status;
            if (e == 200) {
                afterSubmit(y.responseText, n);
            } else {
                processError(h, e, n, m);
            }
        }
    };
    var m = "submittype=" + n + "&curID=" + activityId + "&t=" + (new Date()).valueOf();
    if (source) {
        m += "&source=" + encodeURIComponent(source);
    }
    if (window.udsid) {
        m += "&udsid=" + window.udsid;
    }
    if (nvvv) {
        m += "&nvvv=1";
    }
    if (window.cProvince) {
        m += "&cp=" + encodeURIComponent(cProvince.replace("'", "")) + "&cc=" + encodeURIComponent(cCity.replace("'", "")) + "&ci=" + escape(cIp);
        if (jiFen == 0) {
            var l = cProvince + "," + cCity;
            try {
                setCookie("ip_" + cIp, l, null, "/", "", null);
            } catch(v) {}
        }
    }
    if (refu) {
        m += "&refu=" + encodeURIComponent(refu);
    }
    if (hasTouPiao) {
        m += "&toupiao=t";
    }
    if (jiFen > 0) {
        m += "&jf=" + jiFen;
    }
    if (randomparm) {
        m += "&ranparm=" + randomparm;
    }
    if (inviteid) {
        m += "&inviteid=" + encodeURIComponent(inviteid);
    }
    if (SJBack) {
        m += "&sjback=1";
    }
    if (eproguid) {
        m += "&eproguid=" + eproguid;
    }
    if (parterid) {
        m += "&partnerid=" + parterid;
    }
    if (window.cpid) {
        m += "&cpid=" + cpid;
    }
    if (n == 2) {
        m += "&lastpage=" + x + "&lastq=" + MaxTopic;
    }
    if (n == 3) {
        m += "&zbp=" + (cur_page + 1);
    }
    if (hasJoin) {
        m += "&nfjoinid=" + nfjoinid;
    }
    if (window.sojumpParm) {
        m += "&sojumpparm=" + encodeURIComponent(sojumpParm);
    }
    if (tCode && tCode.style.display != "none" && submit_text.value != "") {
        m += "&validate_text=" + encodeURIComponent(submit_text.value);
    }
    if (window.isDianChu) {
        m += "&check_key=" + encodeURIComponent(check_key) + "&check_address=" + encodeURIComponent(check_address) + "&validate_text=dian";
    }
    m += "&starttime=" + encodeURIComponent(starttime);
    if (guid) {
        m += "&emailguid=" + guid;
    }
    if (window.sjUser) {
        m += "&sjUser=" + encodeURIComponent(sjUser);
    }
    if (window.mobileRnum) {
        m += "&m=" + window.mobileRnum;
    }
    if (window.rndnum) {
        m += "&rn=" + encodeURIComponent(rndnum);
    }
    if (Password) {
        m += "&psd=" + encodeURIComponent(Password);
    }
    if (hasMaxtime) {
        m += "&hmt=1";
    }
    if (sourceDetail) {
        m += "&sd=" + sourceDetail;
    }
    if (window.parterparm && window.parterparmname) {
        m += "&" + parterparmname + "=" + parterparm;
    }
    if (wbid) {
        m += "&wbid=" + wbid;
    }
    if (imgVerify) {
        m += "&btuserinput=" + encodeURIComponent(submit_text.value);
        m += "&btcaptchaId=" + encodeURIComponent(imgVerify.captchaId);
        m += "&btinstanceId=" + encodeURIComponent(imgVerify.instanceId);
    }
    var w = window.alipayAccount || window.cAlipayAccount;
    if (w) {
        m += "&alac=" + encodeURIComponent(w);
    }
    var p = encodeURIComponent(h);
    var i = false;
    var f = "";
    var s = "";
    for (var k = 0; k < trapHolder.length; k++) {
        f = "";
        var c = trapHolder[k].itemInputs;
        var t = new Array();
        for (var r = 0; r < c.length; r++) {
            if (c[r].checked) {
                t.push(c[r].value);
            }
        }
        t.sort(function(z, e) {
            return z - e;
        });
        for (var r = 0; r < t.length; r++) {
            f += t[r] + ",";
        }
        var q = trapHolder[k].getAttribute("trapanswer");
        if (f && q && f.indexOf(q) == -1) {
            i = true;
            s = trapHolder[k].getAttribute("tikuindex");
            break;
        }
    }
    if (i) {
        m += "&ite=1&ics=" + encodeURIComponent(s + ";" + f);
    }
    var g = false;
    var b = "post";
    var d = window.getMaxWidth || 1800;
    if (window.submitWithGet && p.length <= d) {
        g = true;
    }
    if (g) {
        m += "&submitdata=" + p;
        m += "&useget=1";
        b = "get";
    } else {
        if (window.submitWithGet) {
            window.postIframe = 1;
        }
    }
    var a = "/index.php?/isip";
    y.open(b, a, false);
    y.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    havereturn = false;
    if (window.postIframe) {
        postWithIframe(a, h, n);
    } else {
        if (g) {
            if (errorTimes == 2 || window.getWithIframe) {
                GetWithIframe(a, h, n, m);
            } else {
                if (n == 1) {
                    timeoutTimer = setTimeout(function() {
                        processError(h, "ajaxget", n, m);
                    },
                    20000);
                }
                y.send(null);
            }
        } else {
            if (n == 1) {
                timeoutTimer = setTimeout(function() {
                    processError(h, "ajaxpost", n, m);
                },
                20000);
            }
            y.send("submitdata=" + p);
        }
    }
}
function postWithIframe(d, e, b, a) {
    if (b == 1) {
        timeoutTimer = setTimeout(function() {
            processError(e, "postiframe", b, a);
        },
        20000);
    }
    var c = document.createElement("div");
    c.style.display = "none";
    c.innerHTML = "<iframe id='mainframe' name='mainframe' style='display:none;' > </iframe><form target='mainframe' id='frameform' action='' method='post' enctype='application/x-www-form-urlencoded'><input  value='' id='submitdata' name='submitdata' type='hidden'><input type='submit' value='提交' ></form>";
    document.body.appendChild(c);
    $("submitdata").value = e;
    var f = $("frameform");
    f.action = d + "&iframe=1";
    f.submit();
}
function GetWithIframe(d, e, b, a) {
    if (b == 1) {
        timeoutTimer = setTimeout(function() {
            processError(e, "getiframe", b, a);
        },
        20000);
    }
    var c = document.createElement("div");
    c.style.display = "none";
    var g = d + "&iframe=1";
    c.innerHTML = "<iframe id='mainframe' name='mainframe'> </iframe>";
    document.body.appendChild(c);
    var f = $("mainframe");
    f.src = g;
}
function getExpDate(d, a, c) {
    var b = new Date();
    if (typeof(d) == "number" && typeof(a) == "number" && typeof(a) == "number") {
        b.setDate(b.getDate() + parseInt(d));
        b.setHours(b.getHours() + parseInt(a));
        b.setMinutes(b.getMinutes() + parseInt(c));
        return b.toGMTString();
    }
}
function processRedirect(d) {
    var b = d[1];
    var a = d[3] || "";
    var g = d[2];
    if (!b || b[0] == "?") {
        b = window.location.href;
    } else {
        if (b.toLowerCase().indexOf("http://") == -1 && b.toLowerCase().indexOf("https://") == -1) {
            b = "http://" + b;
        }
    }
    if (window.sojumpParm) {
        b = b.replace("{output}", sojumpParm);
    }
    if (window.sojumpParm) {
        var c = "sojumpindex=" + a;
        if (b.indexOf("?") > -1) {
            c = "&" + c;
        } else {
            c = "?" + c;
        }
        if (b.toLowerCase().indexOf("sojumpparm=") == -1) {
            c += "&sojumpparm=" + sojumpParm;
        }
        b += c;
    }
    if (g && g != "不提示" && window.jiFenBao == 0 && !window.sojumpParm) {
        PromoteUser(g, 3000, true);
    }
    try {
        setCookie(activityId + "_save", "", getExpDate( - 1, 0, 0), "/", "", null);
    } catch(f) {}
    setTimeout(function() {
        location.replace(b);
    },
    1000);
}
var changeSave = false;
var nvvv = 0;
function afterSubmit(w, m) {
    havereturn = true;
    errorTimes = 0;
    if ($("PDF_bg_chezchenz")) {
        PDF_close();
    }
    clearTimeout(timeoutTimer);
    var n = w.split("〒");
    var l = n[0];
    if (l==0) {
        alert("您提交的数据有误，请检查!");
    }else{
        alert("提交成功");
    }
    // if (m == 0) {
    //     if (l == 14) {
    //         var b = n[1];
    //         var r = "/wjx/previewanswer.aspx?activityid=" + activityId + "&sg=" + b + "&t=" + (new Date()).valueOf();
    //         var a = $("hrefPQ");
    //         a.href = r;
    //         PDF_launch("divPreviewQ", 300, 100);
    //     } else {
    //         alert("请点击预览答卷按钮");
    //     }
    // } else {
    //     if (m == 2) {
    //         if (l == 14) {
    //             var b = n[1];
    //             var k = window.location.href.toLowerCase();
    //             if (k.indexOf("?") > -1) {
    //                 if (k.indexOf("sg=") > -1) {
    //                     k = k.replace(/sg=([\w|\-]+)/g, "sg=" + b);
    //                 } else {
    //                     k = k + "&sg=" + b;
    //                 }
    //             } else {
    //                 k = k + "?sg=" + b;
    //             }
    //             if (hrefSave) {
    //                 var s = getTop(hrefSave);
    //                 if (!spanSave) {
    //                     spanSave = document.createElement("div");
    //                     divSaveText.appendChild(spanSave);
    //                     spanSave.style.color = "#666666";
    //                     spanSave.style.lineHeight = "14px";
    //                     spanSave.style.width = "14px";
    //                     if (divProgressImg) {
    //                         divProgressImg.style.paddingLeft = "7px";
    //                     } else {
    //                         spanSave.style.paddingLeft = "15px";
    //                     }
    //                 }
    //                 var v = new Date();
    //                 var p = v.getMinutes();
    //                 if (p < 10) {
    //                     p = "0" + p;
    //                 }
    //                 var c = v.getHours();
    //                 if (c < 10) {
    //                     c = "0" + c;
    //                 }
    //                 var d = c + ":" + p;
    //                 spanSave.innerHTML = "答卷保存于<div id='saveData'>1</div><div id='divUnit'>秒</div>钟前";
    //                 if (langVer == 1) {
    //                     spanSave.innerHTML = "<div style='font-size:18px;'>&nbsp;&nbsp;Saved</div>";
    //                 }
    //                 totalSaveSec = 1;
    //                 spanSave.style.display = "";
    //                 submit_tip.style.display = "none";
    //                 clearInterval(changeInterval);
    //                 changeInterval = setInterval(function() {
    //                     var e = $("saveData");
    //                     if (e) {
    //                         totalSaveSec++;
    //                         e.innerHTML = totalSaveSec;
    //                         if (totalSaveSec > 60) {
    //                             e.innerHTML = parseInt(totalSaveSec / 60);
    //                             $("divUnit").innerHTML = "分";
    //                         }
    //                     }
    //                 },
    //                 1000);
    //             }
    //             hasSaveChanged = false;
    //             clearInterval(saveInterval);
    //             saveInterval = setInterval(function() {
    //                 submit(2);
    //             },
    //             60000);
    //             if (!window.saveGuid) {
    //                 try {
    //                     setCookie(activityId + "_save", b, getExpDate(30, 0, 0), "/", "", null);
    //                 } catch(u) {}
    //             }
    //             if (n[2]) {
    //                 nfjoinid = n[2];
    //                 hasJoin = "2";
    //             }
    //             if (n[3]) {
    //                 starttime = n[3];
    //             }
    //             if (changeSave) {
    //                 var k = window.location.href;
    //                 if (k.indexOf("?") == -1) {
    //                     k += "?csave=1";
    //                 } else {
    //                     k += "&csave=1";
    //                 }
    //                 window.location = k;
    //             }
    //             return;
    //         }
    //     } else {
    //         if (m == 3) {
    //             if (l == 12) {
    //                 randomparm = n[1];
    //                 PromoteUser("", 1, true);
    //                 to_next_page();
    //                 return;
    //             } else {
    //                 if (l == 13) {
    //                     var g = n[1];
    //                     var x = n[2] || "0";
    //                     var k = "/wjx/join/complete.aspx?q=" + activityId + "&s=" + simple + "&joinid=" + g;
    //                     if (guid) {
    //                         k += "&guid=" + guid;
    //                     }
    //                     if (promoteSource == "t") {
    //                         k += "&ps=" + promoteSource;
    //                     }
    //                     if (eproguid) {
    //                         k += "&eproguid=" + eproguid;
    //                     }
    //                     k += "&v=" + x;
    //                     if (window.sjUser) {
    //                         k += "&sjUser=" + encodeURIComponent(sjUser);
    //                     }
    //                     location.replace(k);
    //                     return;
    //                 } else {
    //                     if (l == 11) {
    //                         processRedirect(n);
    //                         return;
    //                     } else {
    //                         if (l == 5) {
    //                             alert(n[1]);
    //                             return;
    //                         }
    //                     }
    //                 }
    //             }
    //         } else {
    //             if (l == 10) {
    //                 var k = n[1];
    //                 k += "&s=" + simple;
    //                 if (promoteSource == "t") {
    //                     k += "&ps=" + promoteSource;
    //                 }
    //                 if (eproguid) {
    //                     k += "&eproguid=" + eproguid;
    //                 }
    //                 if (qwidth) {
    //                     k += "&width=" + qwidth;
    //                 }
    //                 if (inviteid) {
    //                     k += "&inviteid=" + inviteid;
    //                 }
    //                 if (parterid) {
    //                     k += "&partnerid=" + parterid;
    //                 }
    //                 if (source) {
    //                     k += "&source=" + encodeURIComponent(source);
    //                 }
    //                 if (guid) {
    //                     k += "&guid=" + guid;
    //                 }
    //                 if (window.sjUser) {
    //                     k += "&sjUser=" + encodeURIComponent(sjUser);
    //                 }
    //                 if (window.parterparm && window.parterparmname) {
    //                     k += "&" + parterparmname + "=" + parterparm;
    //                 }
    //                 if (window.needJQJiang) {
    //                     k += "&njqj=1";
    //                 }
    //                 if (window.HasJiFenBao) {
    //                     k += "&hjfb=1";
    //                 }
    //                 if (startAge) {
    //                     k += "&sa=" + encodeURIComponent(startAge);
    //                 }
    //                 if (endAge) {
    //                     k += "&ea=" + encodeURIComponent(endAge);
    //                 }
    //                 if (gender) {
    //                     k += "&ge=" + gender;
    //                 }
    //                 if (marriage) {
    //                     k += "&ma=" + marriage;
    //                 }
    //                 if (education) {
    //                     k += "&edu=" + education;
    //                 }
    //                 if (shopHT.length > 0) {
    //                     var o = $("shopcart");
    //                     if (o && o.style.display != "none") {
    //                         k += "&ishop=1";
    //                     }
    //                 }
    //                 try {
    //                     setCookie(activityId + "_save", "", getExpDate( - 1, 0, 0), "/", "", null);
    //                 } catch(u) {}
    //                 location.replace(k);
    //                 return;
    //             } else {
    //                 if (l == 11) {
    //                     processRedirect(n);
    //                     return;
    //                 } else {
    //                     if (l == 9 || l == 16 || l == 23) {
    //                         var q = parseInt(n[1]);
    //                         var f = (q + 1) + "";
    //                         var h = n[2];
    //                         if (l == 23) {
    //                             h = "很抱歉，由于问卷发布者设置了选项配额，您选择的选项配额已满，请重新选择！";
    //                         }
    //                         if (pageHolder.length == 1 && pageHolder[0].questions[q]) {
    //                             writeError(pageHolder[0].questions[q], h, 3000);
    //                             pageHolder[0].questions[q].scrollIntoView();
    //                         } else {
    //                             if (questionsObject[f]) {
    //                                 writeError(questionsObject[f], h, 3000);
    //                                 alert(h);
    //                                 questionsObject[f].scrollIntoView();
    //                             } else {
    //                                 alert("您提交的数据有误，请检查！");
    //                             }
    //                         }
    //                     } else {
    //                         if (l == 7) {
    //                             alert(n[1]);
    //                             if (needAvoidCrack != 2) {
    //                                 tCode.style.display = "";
    //                                 submit_tip.style.display = "none";
    //                                 submit_div.style.display = "block";
    //                                 try {
    //                                     submit_text.focus();
    //                                     submit_text.click();
    //                                     if (imgVerify) {
    //                                         imgVerify.onclick();
    //                                     }
    //                                 } catch(t) {}
    //                             }
    //                         } else {
    //                             if (l == 2) {
    //                                 alert(n[1]);
    //                                 window.submitWithGet = 1;
    //                             } else {
    //                                 if (l == 17) {
    //                                     alert("密码冲突！在您提交答卷之前，此密码已经被另外一个用户使用了，请重新更换密码！\r\n系统会自动保存您当前填写的答卷，请复制新的链接重新提交此份答卷！");
    //                                     submit(2);
    //                                     return;
    //                                 } else {
    //                                     if (l == 4) {
    //                                         alert(n[1]);
    //                                         changeSave = true;
    //                                         submit(2);
    //                                         return;
    //                                     } else {
    //                                         if (l == 5) {
    //                                             alert(n[1]);
    //                                             return;
    //                                         } else {
    //                                             if (l == 19) {
    //                                                 alert(n[1]);
    //                                                 window.location = "/";
    //                                                 return;
    //                                             } else {
    //                                                 if (l == 22) {
    //                                                     alert("提交有误，请输入验证码重新提交！");
    //                                                     if (!needAvoidCrack) {
    //                                                         tCode.style.display = "";
    //                                                         imgCode.style.display = "";
    //                                                         imgCode.onclick = refresh_validate;
    //                                                         imgCode.onclick();
    //                                                     }
    //                                                     nvvv = 1;
    //                                                     submit_tip.style.display = "none";
    //                                                     submit_div.style.display = "block";
    //                                                     return;
    //                                                 } else {
    //                                                     alert(n[1]);
    //                                                 }
    //                                             }
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    refresh_validate();
    submit_tip.style.display = "none";
    submit_div.style.display = "block";
    return;
}
var firstError = null;
var firstMatrixError = null;
var startAge = 0;
var endAge = 0;
var gender = 0;
var education = 0;
var marriage = 0;
var labelName = "";
var labelIndex = 0;
function getAgeGenderLabel(d, a) {
    if (d._type == "radio" && a.itemInputs) {
        for (var c = 0; c < a.itemInputs.length; c++) {
            if (a.itemInputs[c].checked) {
                var b = getNextNode(a.itemInputs[c]);
                labelName = b.innerHTML;
                labelIndex = c;
                break;
            }
        }
    } else {
        if (d._type == "radio_down") {
            labelName = a.itemSel.options[a.itemSel.selectedIndex].text;
            labelIndex = a.itemSel.selectedIndex - 1;
        }
    }
}
function getAgeGender(c, a) {
    if (c._type != "radio" && c._type != "radio_down") {
        return;
    }
    var d = a.divTitle.innerHTML;
    if (d.indexOf("年龄") > -1) {
        getAgeGenderLabel(c, a);
        if (!labelName) {
            return;
        }
        var b = /[1-9][0-9]*/g;
        var e = labelName.match(b);
        if (!e || e.length == 0) {
            return;
        }
        if (e.length > 2) {
            return;
        }
        if (e.length == 2) {
            startAge = e[0];
            endAge = e[1];
        } else {
            if (e.length == 1) {
                if (labelIndex == 0) {
                    endAge = e[0];
                } else {
                    startAge = e[0];
                }
            }
        }
    } else {
        if (d.indexOf("性别") > -1) {
            getAgeGenderLabel(c, a);
            if (!labelName) {
                return;
            }
            if (labelName.indexOf("男") > -1) {
                gender = 1;
            } else {
                if (labelName.indexOf("女") > -1) {
                    gender = 2;
                }
            }
        } else {
            if (d.indexOf("学历") > -1 || d.indexOf("教育程度") > -1) {
                getAgeGenderLabel(c, a);
                if (!labelName) {
                    return;
                }
                if (labelName.indexOf("初中") > -1) {
                    education = 1;
                } else {
                    if (labelName.indexOf("高中") > -1 || labelName.indexOf("中专") > -1) {
                        education = 2;
                    } else {
                        if (labelName.indexOf("大专") > -1) {
                            education = 3;
                        } else {
                            if (labelName.indexOf("本科") > -1) {
                                education = 4;
                            } else {
                                if (labelName.indexOf("硕士") > -1) {
                                    education = 5;
                                } else {
                                    if (labelName.indexOf("博士") > -1) {
                                        education = 6;
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if (d.indexOf("婚姻") > -1) {
                    getAgeGenderLabel(c, a);
                    if (!labelName) {
                        return;
                    }
                    if (labelName.indexOf("已婚") > -1) {
                        marriage = 1;
                    } else {
                        if (labelName.indexOf("未婚") > -1) {
                            marriage = 2;
                        } else {
                            if (labelName.indexOf("离婚") > -1) {
                                marriage = 3;
                            } else {
                                if (labelName.indexOf("再婚") > -1) {
                                    marriage = 4;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
function sent_to_answer() {
    var p = new Array();
    var u = 0;
    for (var q = 0; q < pageHolder.length; q++) {
        var W = pageHolder[q].questions;
        var o = pageHolder[q]._maxtime > 0;
        for (var V = 0; V < W.length; V++) {
            var C = W[V].dataNode;
            var m = W[V].style.display.toLowerCase() == "none" || (W[V].dataNode._referTopic && !W[V].displayContent) || pageHolder[q].skipPage;
            if (W[V].isCepingQ) {
                m = false;
            }
            var n = new Object();
            n._topic = C._topic;
            n._value = "";
            p[u++] = n;
            try {
                getAgeGender(C, W[V]);
            } catch(M) {}
            switch (C._type) {
            case "question":
                if (m) {
                    n._value = "(跳过)";
                    continue;
                }
                var N = W[V].itemTextarea || W[V].itemInputs[0];
                var w = N.value || "";
                n._value = replace_specialChar(w);
                break;
            case "gapfill":
                var d = W[V].gapFills;
                for (var S = 0; S < d.length; S++) {
                    if (S > 0) {
                        n._value += spChars[2];
                    }
                    if (m) {
                        n._value += "(跳过)";
                    } else {
                        n._value += replace_specialChar(trim(d[S].value.substring(0, 3000)));
                    }
                }
                break;
            case "slider":
                var O = W[V].divSlider.value;
                if (m) {
                    n._value = "(跳过)";
                    continue;
                }
                n._value = O == undefined ? "": O;
                break;
            case "fileupload":
                var A = W[V].fileName;
                if (m) {
                    n._value = "(跳过)";
                    continue;
                }
                n._value = A || "";
                break;
            case "sum":
                var r = W[V].itemInputs;
                len = r.length;
                for (var S = 0; S < len; S++) {
                    var I = r[S];
                    var J = W[V].relSum == 0 ? trim(I.value) || "0": trim(I.value);
                    if (W[V].itemTrs[S].style.display == "none") {
                        J = "";
                    }
                    if (S > 0) {
                        n._value += spChars[2] + J;
                    } else {
                        n._value = J;
                    }
                }
                if (m) {
                    var Q = 0;
                    while (Q < len) {
                        if (Q == 0) {
                            n._value = "(跳过)";
                        } else {
                            n._value += spChars[2] + "(跳过)";
                        }
                        Q++;
                    }
                }
                break;
            case "radio":
            case "check":
                if (W[V].itemSel) {
                    var X = W[V].itemSel;
                    var z = X.options;
                    if (m) {
                        var Q = 0;
                        while (Q < C._select.length) {
                            if (Q == 0) {
                                n._value = "-3";
                            } else {
                                n._value += ",-3";
                            }
                            Q++;
                        }
                        continue;
                    }
                    for (var S = 0; S < z.length; S++) {
                        if (S == 0) {
                            n._value = z[S].value + "";
                        } else {
                            n._value += "," + z[S].value;
                        }
                    }
                    if (z.length == 0 || z.length < C._select.length) {
                        var H = C._select.length;
                        for (var S = z.length; S < H; S++) {
                            if (n._value) {
                                n._value += ",-2";
                            } else {
                                n._value = "-2";
                            }
                        }
                    }
                    continue;
                }
                if (m) {
                    n._value = "-3";
                    continue;
                }
                var z = W[V].itemInputs || W[V].itemLis;
                if (W[V].isShop) {
                    var E = false;
                    for (var S = 0; S < z.length; S++) {
                        var B = parseInt(z[S].value);
                        if (B > 0) {
                            if (n._value) {
                                n._value += spChars[3];
                            }
                            n._value += (S + 1) + "";
                            n._value += spChars[2] + B;
                            E = true;
                        }
                    }
                    if (!E) {
                        n._value = "-2";
                    }
                    continue;
                }
                var s = -1;
                var K = 0;
                for (var S = 0; S < z.length; S++) {
                    if (z[S].className.toLowerCase().indexOf("on") > -1) {
                        s = S;
                    }
                    var x = z[S].parentNode && z[S].parentNode.style.display == "none";
                    if (!x && z[S].checked) {
                        K++;
                        if (n._value) {
                            n._value += spChars[3] + z[S].value;
                        } else {
                            n._value = z[S].value + "";
                        }
                        if (z[S].itemText) {
                            var T = z[S].itemText.value;
                            if (T == defaultOtherText) {
                                T = "";
                            }
                            n._value += spChars[2] + replace_specialChar(trim(T.substring(0, 3000)));
                        }
                    }
                }
                if (s > -1) {
                    n._value = z[s].value + "";
                } else {
                    if (K > 0) {} else {
                        n._value = "-2";
                    }
                }
                break;
            case "radio_down":
                if (m) {
                    n._value = "-3";
                    continue;
                }
                n._value = W[V].itemSel.value;
                break;
            case "matrix":
                var g = W[V].itemTrs;
                var h = C._mode;
                len = g.length;
                var Y = 0;
                var l = 0;
                var G = 0;
                var y = 0;
                var P = new Array();
                var f = false;
                for (var S = 0; S < g.length; S++) {
                    var b = g[S].getAttribute("rowIndex");
                    if (b == 0 && g[S].getAttribute("RandomRow") == "true") {
                        f = true;
                    }
                    var Z = new Object();
                    Z.rowIndex = b;
                    if (g[S].style.display == "none") {
                        if (h != "201" && h != "202" && h != "301" && h != "302" && h != "303") {
                            if (n._value) {
                                n._value += ",-2";
                            } else {
                                n._value = "-2";
                            }
                            Z.val = "-2";
                            continue;
                        }
                    }
                    var z = g[S].itemInputs || g[S].itemLis || g[S].divSlider || g[S].itemSels;
                    if (!z) {
                        len = len - 1;
                        y = 1;
                        continue;
                    } else {
                        Y = z.length;
                    }
                    var s = -1;
                    var F = "";
                    if (h != "201" && h != "202") {
                        for (var Q = 0; Q < z.length; Q++) {
                            if (z[Q].className.toLowerCase().indexOf("on") > -1) {
                                s = Q;
                                F = z[Q].value;
                            }
                            if (z[Q].checked) {
                                s = Q;
                                if (F) {
                                    F += ";" + z[Q].value;
                                } else {
                                    F = z[Q].value;
                                }
                                if ((h == "103" || h == "102" || h == "101") && z[Q].itemText) {
                                    var U = trim(z[Q].itemText.value);
                                    if (U == defaultOtherText) {
                                        U = "";
                                    }
                                    U = replace_specialChar(U).replace(/;/g, "；").replace(/,/g, "，");
                                    F += spChars[2] + U;
                                }
                            } else {
                                if (z[Q].tagName == "TEXTAREA" || z[Q].tagName == "SELECT") {
                                    s = Q;
                                    var U = trim(z[Q].value);
                                    if (g[S].style.display == "none") {
                                        U = "";
                                    }
                                    if (Q > 0) {
                                        F += spChars[3];
                                    }
                                    if (U) {
                                        if (h == "302") {
                                            U = replace_specialChar(U);
                                        }
                                        F += U;
                                    } else {
                                        if (h == "303") {
                                            F += "-2";
                                        } else {
                                            F += "(空)";
                                        }
                                    }
                                }
                            }
                        }
                        if (s > -1) {
                            if (n._value) {
                                if (h == "301" || h == "302" || h == "303") {
                                    n._value += spChars[2] + F;
                                } else {
                                    n._value += "," + F;
                                }
                            } else {
                                n._value = F;
                            }
                            Z.val = F;
                        } else {
                            if (n._value) {
                                n._value += ",-2";
                            } else {
                                n._value = "-2";
                            }
                            Z.val = "-2";
                        }
                    } else {
                        if (h == "201") {
                            var B = trim(z[0].value.substring(0, 3000));
                            if (g[S].style.display == "none") {
                                B = "";
                            }
                            if (G > 0) {
                                n._value += spChars[2] + replace_specialChar(B);
                            } else {
                                n._value = replace_specialChar(B);
                            }
                            Z.val = replace_specialChar(B);
                        } else {
                            if (h == "202") {
                                var R = g[S].divSlider.value == undefined ? "": g[S].divSlider.value;
                                if (g[S].style.display == "none") {
                                    R = "";
                                }
                                if (G > 0) {
                                    n._value += spChars[2] + R;
                                } else {
                                    n._value = R;
                                }
                                Z.val = R;
                            }
                        }
                    }
                    P.push(Z);
                    G++;
                }
                if (m) {
                    var Q = 0;
                    n._value = "";
                    while (Q < len) {
                        if (h == "201" || h == "202") {
                            if (Q == 0) {
                                n._value = "(跳过)";
                            } else {
                                n._value += spChars[2] + "(跳过)";
                            }
                        } else {
                            if (h == "301" || h == "302" || h == "303") {
                                if (Q > 0) {
                                    n._value += spChars[2];
                                }
                                for (var D = 0; D < Y; D++) {
                                    if (D > 0) {
                                        n._value += spChars[3];
                                    }
                                    if (h == "303") {
                                        n._value += "-3";
                                    } else {
                                        n._value += "(跳过)";
                                    }
                                }
                            } else {
                                if (Q == 0) {
                                    n._value = "-3";
                                } else {
                                    n._value += ",-3";
                                }
                            }
                        }
                        Q++;
                    }
                    continue;
                } else {
                    if (f) {
                        P.sort(function(k, i) {
                            return k.rowIndex - i.rowIndex;
                        });
                        var c = spChars[2];
                        if (h != "201" && h != "202" && h != "301" && h != "302" && h != "303") {
                            c = ",";
                        }
                        var L = "";
                        for (var a = 0; a < P.length; a++) {
                            if (a > 0) {
                                L += c;
                            }
                            L += P[a].val;
                        }
                        n._value = L;
                    }
                }
                break;
            }
        }
    }
    p.sort(function(k, i) {
        return k._topic - i._topic;
    });
    var e = "";
    for (V = 0; V < p.length; V++) {
        if (V > 0) {
            e += spChars[1];
        }
        e += p[V]._topic;
        e += spChars[0];
        e += p[V]._value;
    }
    return e;
}
var verifyMsg = "";
function validate() {
    var z = true;
    var Q = pageHolder[cur_page].questions;
    var B = pageHolder[cur_page].hasExceedTime;
    firstError = null;
    firstMatrixError = null;
    var S = document.getElementById("divNA");
    var H = S.getElementsByTagName("input");
    if (H[0].checked || H[1].checked) {
        alert("系统检测到非法填写问卷");
        window.location.href = window.location.href;
        return;
    }
    for (var P = 0; P < Q.length; P++) {
        var x = Q[P].dataNode;
        var T = x._hasjump;
        verifyMsg = "";
        var s = Q[P].style.display.toLowerCase() == "none" || pageHolder[cur_page].skipPage;
        if (Q[P].removeError) {
            Q[P].removeError();
        }
        if (s || (Q[P].dataNode._referTopic && !Q[P].displayContent) || B) {
            continue;
        }
        switch (x._type) {
        case "question":
            var G = Q[P].itemTextarea || Q[P].itemInputs[0];
            var p = G.value || "";
            if (x._requir) {
                if (trim(p) == "") {
                    z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
                }
            }
            if (p.length - 3000 > 0) {
                z = writeError(Q[P], "您输入的字数超过了3000，请修改！", 3000);
            }
            var n = x._verify;
            var I = Q[P].getAttribute("issample");
            var D = true;
            if (I && promoteSource != "t") {
                D = false;
            }
            if (D) {
                if (p) {
                    var F = verifyMinMax(G, n, x._minword, x._maxword);
                    if (F != "") {
                        z = writeError(Q[P], F, 3000);
                    }
                }
                if (p != "" && n && n != "0") {
                    var F = verifydata(G, n, x);
                    if (F != "") {
                        z = writeError(Q[P], F, 3000);
                    }
                }
            }
            if (z && trim(p) != "" && isRunning == "true") {
                if (x._needOnly) {
                    if (G.isOnly == false) {
                        z = writeError(Q[P], validate_only, 3000);
                    } else {
                        if (G.isOnly != true) {
                            z = writeError(Q[P], validate_error, 3000);
                            G.focus();
                            return z;
                        }
                    }
                }
                if (z && x._hasList && x._listId != -1) {
                    if (G.isInList == false) {
                        z = writeError(Q[P], validate_list, 3000);
                    } else {
                        if (G.isInList != true) {
                            z = writeError(Q[P], validate_error, 3000);
                            G.focus();
                            return z;
                        }
                    }
                }
            }
            if (T) {
                jumpAnyChoice(Q[P], true);
            }
            break;
        case "gapfill":
            var c = Q[P].gapFills;
            for (var N = 0; N < c.length; N++) {
                var p = c[N].value || "";
                if (trim(p) == "") {
                    if (x._requir) {
                        Q[P].errorControl = c[N];
                        z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
                        break;
                    }
                } else {
                    var M = 0;
                    M = validateMatrix(x, c[N], c[N]);
                    if (M) {
                        Q[P].errorControl = c[N];
                        z = writeError(Q[P], verifyMsg, 3000);
                        break;
                    }
                }
            }
            break;
        case "slider":
            var J = Q[P].divSlider.value;
            if (x._requir && J == undefined) {
                z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
            }
            if (T) {
                jumpAnyChoice(Q[P], true);
            }
            break;
        case "fileupload":
            if (x._requir && !Q[P].fileName) {
                z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
            }
            if (T) {
                jumpAnyChoice(Q[P], true);
            }
            break;
        case "sum":
            var K = Q[P].sumLeft;
            if (K == 0) {
                var m = Q[P].getElementsByTagName("input");
                K = Q[P].dataNode._total;
                for (var y = 0; y < m.length; y++) {
                    var w = m[y];
                    var U = Q[P].itemTrs[y];
                    if (U.style.display != "none") {
                        K = K - parseInt(w.value);
                    }
                }
            }
            if (x._requir) {
                if (K != 0) {
                    z = false;
                    if (!K) {
                        K = 100;
                    }
                    if (!firstError) {
                        firstError = Q[P];
                    }
                    var F = "<span style='color:red;'>" + sum_warn + "</span>";
                    if (Q[P].relSum) {
                        Q[P].relSum.innerHTML = sum_total + "<b>" + x._total + "</b>" + sum_left + "<span style='color:red;font-bold:true;'>" + (x._total - K) + "</span>，" + F;
                    }
                }
            } else {
                if (K != undefined && K != 0) {
                    z = false;
                    if (!firstError) {
                        firstError = Q[P];
                    }
                    var F = "<span style='color:red;'>" + sum_warn + "</span>";
                    if (Q[P].relSum) {
                        Q[P].relSum.innerHTML = sum_total + "<b>" + x._total + "</b>" + sum_left + "<span style='color:red;font-bold:true;'>" + (x._total - K) + "</span>，" + F;
                    }
                }
            }
            if (T) {
                jumpAnyChoice(Q[P], true);
            }
            break;
        case "radio":
        case "check":
            if (Q[P].itemSel) {
                var R = Q[P].itemSel;
                var u = R.options;
                if (u.length == 0 && x._requir) {
                    z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
                } else {
                    if (u.length > 0) {
                        if ((x._minValue == 0 || x._minValue == x._select.length) && u.length != x._select.length) {
                            z = writeError(Q[P], validate_info + validate_info_check3, 3000);
                        } else {
                            if (x._maxValue > 0 && u.length > x._maxValue) {
                                var C = validate_info + validate_info_check1 + x._maxValue + validate_info_check2;
                                if (langVer == 0) {
                                    C += ",您多选择了" + (u.length - x._maxValue) + "项";
                                }
                                z = writeError(Q[P], C, 3000);
                            } else {
                                if (x._minValue > 0 && u.length < x._minValue) {
                                    var C = validate_info + validate_info_check1 + x._minValue + validate_info_check2;
                                    if (langVer == 0) {
                                        C += ",您少选择了" + (x._minValue - u.length) + "项";
                                    }
                                    z = writeError(Q[P], C, 3000);
                                }
                            }
                        }
                    }
                }
                if (T) {
                    jumpAnyChoice(Q[P], true);
                }
                continue;
            }
            var u = Q[P].itemInputs || Q[P].itemLis;
            var o = -1;
            var E = 0;
            var f = -1;
            for (var N = 0; N < u.length; N++) {
                if (u[N].className.toLowerCase().indexOf("on") > -1) {
                    o = N;
                    f = N;
                }
                if (u[N].checked) {
                    E++;
                    f = N;
                    if (u[N].req && isTextBoxEmpty(u[N].itemText.value)) {
                        z = writeError(Q[P], validate_textbox, 3000);
                    }
                }
            }
            if (o > -1) {
                hasChoice = true;
            } else {
                if (E > 0) {
                    hasChoice = true;
                    if (x._maxValue > 0 && E > x._maxValue) {
                        var C = validate_info + validate_info_check4 + x._maxValue + type_check_limit5;
                        if (langVer == 0) {
                            C += ",您多选择了" + (E - x._maxValue) + "项";
                        }
                        z = writeError(Q[P], C, 3000);
                    } else {
                        if (x._minValue > 0 && E < x._minValue) {
                            var C = validate_info + validate_info_check5 + x._minValue + type_check_limit5;
                            if (langVer == 0) {
                                C += ",您少选择了" + (x._minValue - E) + "项";
                            }
                            if (E == 1 && x._select[f] && x._select[f]._item_huchi) {
                                C = "";
                            } else {
                                z = writeError(Q[P], C, 3000);
                            }
                        }
                    }
                } else {
                    if (x._requir) {
                        z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
                    }
                }
            }
            if (T) {
                if (x._type == "radio" && x._anytimejumpto < 1) {
                    if (f > -1) {
                        processJ(Q[P].indexInPage - 0, x._select[u[f].value - 1]._item_jump - 0, true);
                    } else {
                        processJ(Q[P].indexInPage - 0, 0, true);
                    }
                } else {
                    jumpAnyChoice(Q[P], true);
                }
            }
            break;
        case "radio_down":
            if (x._requir && Q[P].itemSel.selectedIndex == 0) {
                z = writeError(Q[P], validate_info + validate_info_wd1, 3000);
            }
            if (T) {
                if (x._anytimejumpto < 1) {
                    if (Q[P].itemSel.selectedIndex == 0) {
                        processJ(Q[P].indexInPage - 0, 0, true);
                    } else {
                        processJ(Q[P].indexInPage - 0, x._select[Q[P].itemSel.value - 1]._item_jump - 0, true);
                    }
                } else {
                    jumpAnyChoice(Q[P], true);
                }
            }
            break;
        case "matrix":
            var e = Q[P].itemTrs;
            var g = x._mode;
            len = e.length;
            var h = 0;
            var d = 0;
            var M = 0;
            var v;
            for (var N = 0; N < e.length; N++) {
                if (e[N].style.display == "none") {
                    len = len - 1;
                    continue;
                }
                var u = e[N].itemInputs || e[N].itemLis || e[N].divSlider || e[N].itemSels;
                if (!u) {
                    len = len - 1;
                    continue;
                }
                var o = -1;
                var E = 0;
                if (g != "201" && g != "202") {
                    for (var L = 0; L < u.length; L++) {
                        if (u[L].className.toLowerCase().indexOf("on") > -1) {
                            o = L;
                        } else {
                            if (u[L].checked) {
                                o = L;
                                E++;
                                if ((g == "103" || g == "102" || g == "101") && u[L].itemText && u[L].req) {
                                    var b = u[L].itemText.value;
                                    if (isTextBoxEmpty(b)) {
                                        if (!v) {
                                            v = u[L].itemText;
                                        }
                                        verifyMsg = validate_textbox;
                                        M = 1;
                                        if (!firstMatrixError) {
                                            firstMatrixError = Q[P].itemTrs[N];
                                        }
                                    }
                                }
                            } else {
                                if (u[L].tagName == "TEXTAREA" || u[L].tagName == "SELECT") {
                                    var O = trim(u[L].value);
                                    o = L;
                                    if (!O) {
                                        var q = u[L].parentNode;
                                        if (g == "303") {
                                            if (q.style.display != "none") {
                                                o = -1;
                                                break;
                                            }
                                        } else {
                                            if (q.style.display != "none") {
                                                o = -1;
                                                if (g == "301" && x._requir) {
                                                    d = 1;
                                                    if (!v) {
                                                        v = u[L];
                                                    }
                                                    if (!firstMatrixError) {
                                                        firstMatrixError = Q[P].itemTrs[N];
                                                    }
                                                }
                                                break;
                                            }
                                        }
                                    } else {
                                        if (g == "301") {
                                            O = DBC2SBC(u[L]);
                                            if (!/^(\-)?\d+(\.\d+)?$/.exec(O)) {
                                                d = 1;
                                            } else {
                                                if ((x._minvalue && parseInt(O) - parseInt(x._minvalue) < 0) || (x._maxvalue && parseInt(O) - parseInt(x._maxvalue) > 0)) {
                                                    d = 2;
                                                }
                                            }
                                            if (d) {
                                                if (!v) {
                                                    v = u[L];
                                                }
                                                if (!firstMatrixError) {
                                                    firstMatrixError = Q[P].itemTrs[N];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (g == "102") {
                        if (o > -1) {
                            var a = false;
                            if (x._maxvalue > 0 && E > x._maxvalue) {
                                var C = validate_info + validate_info_check4 + x._maxvalue + type_check_limit5;
                                if (langVer == 0) {
                                    C += ",您多选择了" + (E - x._maxvalue) + "项";
                                }
                                verifyMsg = C;
                                M = 1;
                                if (!firstMatrixError) {
                                    firstMatrixError = Q[P].itemTrs[N];
                                }
                            } else {
                                if (x._minvalue > 0 && E < x._minvalue) {
                                    var C = validate_info + validate_info_check5 + x._minvalue + type_check_limit5;
                                    if (langVer == 0) {
                                        C += ",您少选择了" + (x._minvalue - E) + "项";
                                    }
                                    verifyMsg = C;
                                    M = 1;
                                    if (!firstMatrixError) {
                                        firstMatrixError = Q[P].itemTrs[N];
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if (g == "201") {
                        if (!M) {
                            M = validateMatrix(x, e[N], u[0]);
                        }
                        if (M) {
                            if (!v) {
                                v = u[0];
                            }
                            if (!firstMatrixError) {
                                firstMatrixError = Q[P].itemTrs[N];
                            }
                        }
                        if (trim(u[0].value) != "") {
                            o = 0;
                        }
                    } else {
                        if (g == "202") {
                            if (e[N].divSlider.value != undefined) {
                                o = 0;
                            }
                        }
                    }
                }
                if (o > -1) {
                    h++;
                } else {
                    if (x._requir) {
                        break;
                    }
                }
            }
            if (x._requir && h < len) {
                z = writeError(Q[P], validate_info + validate_info_matrix2 + validate_info_matrix1 + (h + 1) + validate_info_matrix3, 3000);
                if (Q[P].itemTrs[N] && !firstMatrixError) {
                    firstMatrixError = Q[P].itemTrs[N];
                    Q[P].itemTrs[N].onclick();
                }
            }
            if (g == "201" && M) {
                if (v) {
                    Q[P].errorControl = v;
                }
                z = writeError(Q[P], verifyMsg, 3000);
                if (firstMatrixError) {
                    firstMatrixError.onclick();
                }
            }
            if ((g == "102" || g == "103" || g == "101") && M) {
                if (v) {
                    Q[P].errorControl = v;
                }
                z = writeError(Q[P], verifyMsg, 3000);
                if (firstMatrixError) {
                    firstMatrixError.onclick();
                }
            }
            if (g == "301" && d) {
                var r = "";
                if (d == 2) {
                    if (x._minvalue) {
                        r += "," + type_wd_minlimitDigit + ":" + x._minvalue;
                    }
                    if (x._maxvalue) {
                        r += "," + type_wd_maxlimitDigit + ":" + x._maxvalue;
                    }
                }
                if (v) {
                    Q[P].errorControl = v;
                }
                z = writeError(Q[P], validate_info + validate_info_matrix4 + r, 3000);
                if (firstMatrixError) {
                    firstMatrixError.onclick();
                }
            }
            if (T) {
                jumpAnyChoice(Q[P], true);
            }
            break;
        }
    }
    for (var A = 0; A < trapHolder.length; A++) {
        if (trapHolder[A].pageIndex != cur_page + 1) {
            continue;
        }
        var u = trapHolder[A].itemInputs;
        var l = "";
        for (var N = 0; N < u.length; N++) {
            if (u[N].checked) {
                l += u[N].value + ",";
            }
        }
        if (!l) {
            z = writeError(trapHolder[A], validate_info + validate_info_wd1, 3000);
            break;
        }
    }
    if (firstError) {
        PromoteUser(validate_submit, 3000, false);
        if (firstMatrixError && firstMatrixError.parent == firstError) {
            firstMatrixError.scrollIntoView();
        } else {
            firstError.scrollIntoView();
        }
    }
    return z;
}
function validateMatrix(i, b, f) {
    var d = 0;
    if (!f.value) {
        return d;
    }
    var h = f.value;
    var a = b.getAttribute("itemverify") || "";
    var g = b.getAttribute("minword") || "";
    var c = b.getAttribute("maxword") || "";
    var k = b.getAttribute("issample");
    var e = true;
    verifyMsg = "";
    if (k && promoteSource != "t") {
        e = false;
    }
    if (e) {
        verifyMsg = verifyMinMax(f, a, g, c);
    }
    if (verifyMsg != "") {
        d = 1;
    }
    if (e && d == 0 && a && a != "0") {
        verifyMsg = verifydata(f, a, i);
        if (verifyMsg != "") {
            d = 2;
        }
    }
    return d;
}
function removeError() {
    if (this.errorMessage) {
        try {
            this.removeChild(this.errorMessage);
            this.errorMessage = null;
        } catch(a) {
            this.errorMessage.innerHTML = "";
        }
        this.removeError = null;
        this.style.border = "solid 2px white";
        this.style.borderBottom = "solid 1px #efefef";
        this.style.paddingBottom = "5px";
        if (this.errorControl) {
            this.errorControl.style.background = "white";
            this.errorControl = null;
        }
    }
}
function PromoteUser(c, b, a) {
    show_status_tip(c, b);
    if (!a) {
        alert(c);
    }
}
function writeError(b, d, c) {
    if (b.errorMessage && b.errorMessage.innerHTML != "") {
        return;
    }
    if (b.dataNode && ((b.dataNode._type == "matrix" && b.dataNode._mode == "202") || b.dataNode._type == "slider")) {} else {
        b.style.padding = "4px";
        b.style.border = "solid 2px #ff9900";
        b.style.borderBottom = "solid 2px #ff9900";
    }
    if (b.errorMessage && b.errorMessage.innerHTML == "") {
        b.errorMessage.innerHTML = d;
    } else {
        var a = document.createElement("div");
        a.className = "errorMessage";
        a.setAttribute("for", b.id);
        a.setAttribute("htmlFor", b.id);
        a.appendChild(document.createTextNode(d));
        b.appendChild(a);
        b.errorMessage = a;
    }
    b.removeError = removeError;
    if (b.errorControl) {
        b.errorControl.style.background = "#ff3300";
    }
    if (!firstError) {
        firstError = b;
    }
    return false;
}
function show_status_tip(a, b) {
    submit_tip.style.display = "block";
    submit_tip.innerHTML = a;
    if (b > 0) {
        setTimeout("submit_tip.style.display='none'", b);
    }
}
function isDate(c) {
    var a = new Array();
    if (c.indexOf("-") != -1) {
        a = c.toString().split("-");
    } else {
        if (c.indexOf("/") != -1) {
            a = c.toString().split("/");
        } else {
            return false;
        }
    }
    if (a[0].length == 4) {
        var b = new Date(a[0], a[1] - 1, a[2]);
        if (b.getFullYear() == a[0] && b.getMonth() == a[1] - 1 && b.getDate() == a[2]) {
            return true;
        }
    }
    return false;
}
function DBC2SBC(b) {
    var e = b.value;
    var a;
    if (e.length <= 0) {
        return false;
    }
    qstr1 = "１２３４５６７８９０－";
    bstr1 = "1234567890-";
    var d = false;
    for (a = 0; a < e.length; a++) {
        var f = e.charAt(a);
        if (qstr1.indexOf(f) != -1) {
            e = e.replace(f, bstr1.charAt(qstr1.indexOf(f)));
            d = true;
        }
    }
    if (d) {
        b.value = e;
    }
    return b.value;
}
function verifydata(f, d, e) {
    var c = f.value;
    var a = null;
    if(d.toLowerCase()=="email"||d.toLowerCase()=="msn"){a=/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;if(!a.exec(c)){return validate_email;}else{return"";}}else{if(d=="日期"||d=="生日"||d=="入学时间"){if(!isDate(c)){return validate_date;}else{return"";}}else{if(d=="固话"){c=DBC2SBC(f);a=/^((\d{4}-\d{7})|(\d{3,4}-\d{8}))(-\d{1,4})?$/;if(!a.exec(c)){return validate_phone;}else{return"";}}else{if(d=="手机"){c=DBC2SBC(f);a=/^\d{11}$/;if(!a.exec(c)){return validate_mobile;}else{return"";}}else{if(d=="电话"){a=/(^\d{11}$)|(^((\d{4}-\d{7})|(\d{3,4}-\d{8}))(-\d{1,4})?$)/;if(!a.exec(c)){return validate_mo_phone;}else{return"";}}else{if(d=="汉字"){a=/^[\u4e00-\u9fa5]+$/;if(!a.exec(c)){return validate_chinese;}else{return"";}}else{if(d=="英文"){a=/^[A-Za-z]+$/;if(!a.exec(c)){return validate_english;}else{return"";}}else{if(d=="网址"||d=="公司网址"){a=/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;if(!a.exec(c)){return validate_reticulation;}else{return"";}}else{if(d=="身份证号"){c=DBC2SBC(f);a=/^\d{15}(\d{2}[A-Za-z0-9])?$/;if(!a.exec(c)){return validate_idcardNum;}else{return"";}}else{if(d=="数字"){c=DBC2SBC(f);a=/^(\-)?\d+$/;if(!a.exec(c)){return validate_num;}}else{if(d=="小数"){c=DBC2SBC(f);a=/^(\-)?\d+(\.\d+)?$/;if(!a.exec(c)){return validate_decnum;}}else{if(d.toLowerCase()=="qq"){c=DBC2SBC(f);a=/^\d+$/;var b=/^\w+([-+.]\w+)*@\w+([-.]\\w+)*\.\w+([-.]\w+)*$/;if(!a.exec(c)&&!b.exec(c)){return validate_qq;}else{return"";}}}}}}}}}}}}}return"";}function verifyMinMax(f,e,c,a){var d=f.value;if(e=="数字"||e=="小数"){if(!afterDigitPublish){return"";}d=DBC2SBC(f);var b=/^(\-)?\d+$/;if(e=="小数"){b=/^(\-)?\d+(\.\d+)?$/;}if(!b.exec(d)){if(e=="小数"){return validate_decnum;}else{return validate_num;}}if(c!=""&&parseInt(d)-parseInt(c)<0){return validate_num2+c;}if(a!=""&&parseInt(d)-parseInt(a)>0){return validate_num1+a;}}else{if(a!=""&&d.length-a>0){return validate_info_wd3.format(a,d.length);}if(c!=""&&d.length-c<0){return validate_info_wd4.format(c,d.length);}}return"";}function getXmlHttp(){var a;try{a=new ActiveXObject("Msxml2.XMLHTTP");}catch(b){try{a=new ActiveXObject("Microsoft.XMLHTTP");}catch(b){try{a=new XMLHttpRequest();}catch(b){}}}return a;}if(hasQJump&&window.jqLoaded){jqLoaded();}if(totalPage>1&&window.divTouPiouId){$(divTouPiouId).style.display="none";}if(nv==1){var ii=cur_page;for(;ii<totalPage;ii++){if(validate()){to_next_page();}else{break;}}}