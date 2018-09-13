function enterJudge(event) {
    if ((window.event ? event.keyCode : event.which) === 13) redirect();
}

function check(ch) {
    return ('a' <= ch && ch <= 'z') || ('A' <= ch && ch <= 'Z') || ('0' <= ch && ch <= '9');
}

function stringCheck(str) {
    let len = str.length;
    if (len > 20) return false;
    for (let i = 0; i < len; i++) {
        let buf = str.charAt(i);
        if (!check(buf)) return false;
    }
    return true;
}

function redirect() {
    const id = document.getElementById("keyword").value;
    if (id.length === 0) alert("索引串不能为空");
    else {
        if (stringCheck(id)) window.location.href = id;
        else alert("索引串只能由大小写英文字母或数字组成且长度小于20");
    }
}
