var MyCoursesService = {
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
    },

    deleteCourse: function(id) {
      if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS COURSE?")) {
        $.ajax({
          url: `rest/studentcourses/` + id,
          type: `DELETE`,
          success: function(result) {
            // Promjena statusa kursa na serveru
            $.ajax({
              url: `rest/courses/` + id,
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
  