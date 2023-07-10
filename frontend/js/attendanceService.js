let attendanceService = {
    init: function () {
      function getAttendance(studentId, courseId) {
        $.ajax({
            url: `../rest/allattendance/${studentId}/${courseId}`,
            type: "GET",
            success: function (data) {
              if (data.length > 0) {
                
                if (data[0].hasOwnProperty("lab")) {
                  $(`#course_attendance_${courseId}1`).html(data[0].lab);
                  $(`#course_attendance${courseId}1`).attr("style",  `width: ${data[0].lab}%`)
                }
                if (data[0].hasOwnProperty("lesson")) {
                  $(`#course_attendance${courseId}2`).html(data[0].lesson);
                  $(`#course_attendance${courseId}2`).attr("style",  `width: ${data[0].lesson}%`)
                }
                if (data[0].hasOwnProperty("total")) {
                  $(`#course_attendance${courseId}3`).html(data[0].total);
                  $(`#course_attendance${courseId}_3`).attr("style",  `width: ${data[0].total}%`)
                }
              }
            },
          });
          
        }
      $.ajax({
        url: "../rest/studentcourses/2", // + JSON.parse(localStorage.getItem("user")).id
        type: "GET",
        success: function (data) {
            console.log(data)
            for(course of data) {
            $(".attendance").append(`
              <tbody>
                <td>${course.name}</td>
                <td>
                  <div class="progress">
                    <div id="course_attendance_${course.id}1" class="progress-bar bg-custom" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">${course.id}</div>
                  </div>
                </td>
                <td>
                  <div class="progress">
                    <div id="course_attendance${course.id}2" class="progress-bar bg-custom" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">${course.id}</div>
                  </div>
                </td>
                <td>
                  <div class="progress">
                    <div id="course_attendance${course.id}_3" class="progress-bar bg-custom" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">${course.id}</div>
                  </div>
                </td>
              </tbody>
            `);
            getAttendance(2, course.id);
          }
        
        },
        error: function (data) {
          console.log("Error occurred");
        },
      });
    },
  };