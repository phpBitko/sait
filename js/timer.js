function startTimer() {
    var my_timer = document.getElementById("my_timer");
    var now = new Date();
    var future = new Date(2016, 02, 14, 9,0,0);
    var res = future - now;


    var h = Math.floor(res/3600000);
    res = res - h*3600000;
    var m = Math.floor(res/60000);
    res = res - m*60000;
    var s = Math.floor(res/1000);


    if (s == 0) {
        if (m == 0) {
            if (h == 0) {
                alert("Время вышло");
                window.location.reload();
                return;
            }
            h--;
            m = 60;
        }
        m--;
        s = 59;
    }
    else s--;
    if (h < 10) h = "0" + h;
    if (m < 10) m = "0" + m;
    if (s < 10) s = "0" + s;
    document.getElementById("my_timer").innerHTML = h+":"+m+":"+s;
    setTimeout(startTimer, 1000);
}