var CoursesAndGradesService = {
    init: function() {
      function getGrades(studentId, courseId) {
        $.ajax({
          url: `../rest/allgrades/${studentId}/${courseId}`,
          type: "GET",
          success: function(data) {
            var grades = data[0]; // Assuming the response is an array with a single object
            $("#course_grade_midterm_" + courseId).html(grades["midterm"]);
            $("#course_grade_final_" + courseId).html(grades["final"]);
            $("#course_grade_quiz_" + courseId).html(grades["quiz"]);
          },
          error: function(xhr, textStatus, errorThrown) {
            console.log("Error:", errorThrown);
          }
        });
      }
  
      $.ajax({
        url: "../rest/studentcourses/2",
        type: "GET",
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
  