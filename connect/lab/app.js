


window.onload = function() {
    // ดึงข้อมูลเวลาเริ่มต้นและเวลาสิ้นสุดของงานที่ต้องการนับเวลาจากฐานข้อมูล
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var start_end_time = this.responseText.split("|");
        var start_time = start_end_time[0];
        var end_time = start_end_time[1];
  
        // เริ่มนับเวลา
        if (start_time != null && end_time != null) {
          countdown(start_time, end_time);
        }
      }
    };
    xhttp.open("GET", "get_work_time.php", true);
    xhttp.send();
  
    // ส่งข้อมูลเวลาเริ่มต้นและเวลาสิ้นสุดของงานที่ต้องการนับเวลาไปยัง PHP script ในข้อ 3 เมื่อกดปุ่ม submit
    var form = document.getElementById("work-time-form");
    form.addEventListener("submit", function(event) {
      event.preventDefault();
      var start_time = document.getElementById("start-time").value;
      var end_time = document.getElementById("end-time").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
        }
      };
      xhttp.open("POST", "record_work_time.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("start-time=" + start_time + "&end-time=" + end_time);
    });
  }
  


  function countdown(start_time, end_time) {
  var start = new Date(start_time).getTime();
  var end = new Date(end_time).getTime();
  var duration = end - start;

  var x = setInterval(function() {
    duration = duration - 1000;

    var hours = Math.floor((duration % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((duration % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML = "Time remaining: " + hours + "h "
      + minutes + "m " + seconds + "s ";

    if (duration < 0) {
      clearInterval(x);
      document.getElementById("countdown").innerHTML = "Work time has ended";
    }
  }, 1000);
}
