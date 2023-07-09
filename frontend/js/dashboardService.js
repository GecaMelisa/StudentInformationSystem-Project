let globalAttendance = {}

let dashboardService = {
    init: function() {

        /*function getGrade(id){
            $.ajax(
                {
                    url: "../rest/studentgrades/" + id,
                    type: "GET",
                    success: function(data){
                        $(`#course_grade_${id}`).html(data[0]["grade"])
                    }
                });
        }
        */
        $.ajax({
            url: "../rest/course",
            type: "GET",
            beforeSend: function(xhr) {
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
                let registeredCourses = data.filter(function(course) {
                    return course.status == 1; // Samo predmeti sa statusom 1 (registered)
                });
                for (course of registeredCourses) { 
                    $(".datatable").append(`
                        <tbody>
                            <td>${course.name}</td>
                            <td>
                                <div class="progress" id="progress-${course.id}">

                                </div>
                            </td>
                            <td id="course_grade_${course.id}">
                            <div class="progress" id="grade-${course.id}">

                                </div>
                            </td>
                        </tbody>
                    `);
                    dashboardService.getAttendance(course.id)
                    dashboardService.getGrade(course.id)
                 
                }
                //getGrade(course.id)
            },
            error: function(data) {
                console.log("drama");
            },
        });
    },
    getAttendance: function(id) {
          $.ajax({
            url: `../rest/allattendance/2/${id}`,
            type: "GET",
            beforeSend: function(xhr) {
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
             console.log(data)
              $(`#progress-${id}`).append(`
              <div class="progress-bar bg-custom" role="progressbar" style="width: ${data[0].att_per_course}%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">${data[0].att_per_course}</div>
              `)
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              reject(textStatus);
            },
          });
       
      },
      getGrade: function(id) {
       
          $.ajax({
            url: `../rest/allgrades/2/${id}`,
            type: "GET",
            beforeSend: function(xhr) {
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
             if(data[0] != undefined){
             console.log("grades ",data[0])
             let total = 0
             Object.keys(data[0]).forEach(key => {
                console.log(key, data[0][key]);
                total = total + parseInt(data[0][key])
              });
            console.log("toatl",total)
             $(`#grade-${id}`).append(`
             <div class="progress-bar bg-custom" role="progressbar" style="width: ${total}%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">${total}</div>
             `)
            }
            else console.log("No entered grade")
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              reject(textStatus);
            },
          });
        
      }
      
};
