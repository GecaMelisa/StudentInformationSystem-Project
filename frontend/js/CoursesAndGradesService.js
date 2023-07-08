var CoursesAndGradesService = {
  init: function() {
    function getGrades(studentId, courseId) {
      $.ajax({
        url: `../rest/allgrades/${studentId}/${courseId}`,
        type: "GET",
        beforeSend: function(xhr) {
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(data) {
          console.log(data[0], courseId)
          if(data[0] == undefined) {
            $("#course_grade_midterm_" + courseId).html(0);
          $("#course_grade_final_" + courseId).html(0);
          $("#course_grade_quiz_" + courseId).html(0);
          }
          else {
          var grades = data[0]; // Assuming the response is an array with a single object
          $("#course_grade_midterm_" + courseId).html(grades["midterm"]);
          $("#course_grade_final_" + courseId).html(grades["final"]);
          $("#course_grade_quiz_" + courseId).html(grades["quiz"]);
          }
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log("Error:", errorThrown);
        }
      });
    }

    $.ajax({
      url: "../rest/studentGrades/2",
      type: "GET",
      beforeSend: function(xhr) {
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(data) {
        var html = "";
        for (course of data) {
          html += `
            <tbody>
              <tr>
                <td>${course.name}</td>
              </tr>
              <tr>
                <td class="card-body">
                  Midterm Grade:
                  <span id="course_grade_midterm_${course.id}"></span>
                </td>
              </tr>
              <tr>
                <td class="card-body">
                  Final Grade:
                  <span id="course_grade_final_${course.id}"></span>
                </td>
              </tr>
              <tr>
                <td class="card-body">
                  Quiz Grade:
                  <span id="course_grade_quiz_${course.id}"></span>
                </td>
              </tr>
            </tbody>  
          `;
console.log(course.id)
          getGrades(2, course.id);
        }

        $(".course").html(html);
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log("Error:", errorThrown);
      },
    });
  }
};