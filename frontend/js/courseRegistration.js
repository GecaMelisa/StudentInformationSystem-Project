var RegistrationService = {

  addCourse: function(courseId) {
    if (!courseId) {
      console.log('Invalid course ID');
      return;
    }
    if (confirm("ARE YOU SURE YOU WANT TO REGISTER THIS COURSE?")) {
      // Prikupljanje podataka o kursu iz baze podataka
      $.ajax({
        url: `../rest/course/${courseId}`, 
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
              url: `../rest/course/${courseId}`,
              type: 'PUT',
              data: JSON.stringify({ status: 1 }),
              contentType: 'application/json',
              success: function(result) {
                // Promjena statusa kursa na page-u
                    RegistrationService.list();

                    // Ukloni kurs sa stranice Course Registratii prikažite ga na stranici My Courses
                    MyCoursesService.addCourse();
                    toastr.success('Course successfully registered');
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
            if (data[i].status == 0) {
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

  };