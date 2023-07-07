var MyCoursesService = {

  deleteCourse: function(courseId) {
    if (!courseId) {
      console.log('Invalid course ID');
      return;
    }
    if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS COURSE?")) {
      $.ajax({
        url: '../rest/course/delete/' + courseId,
        success: function(courseData) {
          if (courseData) {
            // Priprema objekta sa podacima kursa
            var course = {
              courses_id: courseData.id,
              name: courseData.name,
              professors_id: courseData.professors_id,
              status: 1
            };

            // Slanje AJAX zahtjeva za brisanje kursa
            $.ajax({
              url: '../rest/course/delete/' + courseId,
              type: 'PUT',
              data: JSON.stringify({ status: 0 }), 
              contentType: 'application/json',
              success: function(result) {

                // Promjena statusa kursa na stranici MyCourses
                MyCoursesService.list();
  
                // Uklonite kurs sa stranice MyCourses i prikažite ga na stranici Course Registration
                RegistrationService.deleteCourse(courseId);
                toastr.success('Course successfully deleted');
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.message);
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

    list: function() {
      $.ajax({
        url: "../rest/course",
        type: "GET",
        beforeSend: function(xhr) {
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(data) {
          $("#course-list").html("");
          var html = "";
          for (let i = 0; i < data.length; i++) {
            if (data[i].status === 1) {
              html += `
                <tr>
                  <td>${data[i].name}</td>
                  <td>
                    <button class="btn btn-danger btn-sm" onclick="MyCoursesService.deleteCourse(${data[i].id})">DELETE</button>
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
    

    
  




    /*deleteCourse: function(id) {
      if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS COURSE?")) {
        $.ajax({
          url: `rest/studentcourses/` + id,
          type: `PUT`,
          data: { status: 0 },
              success: function(response) {
                console.log(response);
                MyCoursesService.list();
                toastr.success("Course deleted successfully!");
              },
         /* success: function(result) {
            // Promjena statusa kursa na serveru
            $.ajax({
              url: `../rest/courses/` + id,
              type: `PUT`,
              data: { status: 0 },
              success: function(response) {
                console.log(response);
                MyCoursesService.list();
                toastr.success("Course deleted successfully!");
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.message);
              }
            });
          },
          
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            //toastr.error(XMLHttpRequest.responseJSON.message);
          }
        });
      }
    }
  };
*/
