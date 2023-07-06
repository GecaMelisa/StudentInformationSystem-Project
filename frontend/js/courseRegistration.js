var RegistrationService = {

  addCourse: function(courseId) {
    if (confirm("ARE YOU SURE YOU WANT TO REGISTER THIS COURSE?")) {
      // Prikupljanje podataka o kursu iz baze podataka
      $.ajax({
        url: `../rest/course/${courseId}`, // Zamijenite 'courseId' sa stvarnim ID-em kursa
        type: 'GET',
        success: function(courseData) {
          if (courseData) {
            // Priprema objekta sa podacima kursa
            var course = {
              courses_id: courseData.id,
              name: courseData.name,
              professors_id: courseData.professors_id,
              status: 0
            };
  
            // Slanje AJAX zahtjeva za dodavanje kursa
            $.ajax({
              url: '../rest/course',
              type: 'POST',
              data: JSON.stringify(course),
              contentType: 'application/json',
              success: function(result) {
                // Promjena statusa kursa na serveru
                $.ajax({
                  url: `rest/courses/${result.courseId}`,
                  type: 'PUT',
                  data: JSON.stringify({ status: 1 }),
                  contentType: 'application/json',
                  success: function(response) {
                    // Uklonite kurs sa stranice Course Registration
                    // i prikažite ga na stranici My Courses
                    // MyCoursesService.addCourse(response);
                    toastr.success('Course successfully registered');
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toastr.error(XMLHttpRequest.responseJSON.message);
                  }
                });
              },
              error: function(jqXHR, textStatus, errorThrown) {
                toastr.error(jqXHR.responseJSON.message);
              }
            });
          } else {
            toastr.error('Course data not found');
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
        }
      });
    }
  },
  
    
  /*addCourse: function(course) {
    if (confirm("ARE YOU SURE YOU WANT TO REGISTER THIS COURSE?")) {
      var preparedCourse = {
        courses_id: course.courses_id,
        name: course.name,
        status: course.status
      };
  
      $.ajax({
        url: '../rest/course',
        type: 'POST',
        data: JSON.stringify(preparedCourse),
        contentType: 'application/json',
        success: function(result) {
          // Promjena statusa kursa na serveru
          $.ajax({
            url: `rest/courses/${result.courses_id}`,
            type: 'PUT',
            data: JSON.stringify({ status: 1 }),
            contentType: 'application/json',
            success: function(response) {
              // Ukloni kurs sa stranice Course Registration i prikaže ga na stranici My Courses
              MyCoursesService.addCourse(response);
              toastr.success('Course successfully registered');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              toastr.error(XMLHttpRequest.responseJSON.message);
            }
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //toastr.error(jqXHR.responseJSON.message);
        }
      });
    }
  },
  */
  
  



    list: function() {
      $.ajax({
        url: "../rest/course",
        type: "GET",
        // beforeSend: function(xhr) {
        //   xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        // },
        success: function(data) {
          $("#course-list").html("");
          var html = "";
          for (let i = 0; i < data.length; i++) {
            if (data[i].status === 0) {
              html += `
                <tr>
                  <td>${data[i].name}</td>
                  <td>
                    <button class="btn btn-primary btn-sm" onclick="RegistrationService.addCourse(${data[i].id})">ADD</button>
                  </td>
                </tr>
              `;
            }
          }
          $("#course-list").html(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
        }
      });
    }


  }
    




       
       /*$.ajax({
            url: '../rest/course',
            type: 'POST',
            data: { course_id: course_id },
            success: function(response) {
              window.location.href = 'myCourses.html';
            },
            error: function() {
              alert('An error occurred while deleting the course.');
            }
          });
          */
    

         /* addCourse: function(course){
            data = {
              course_id : course_id,
              students_id: 
            }
*/
    
    

