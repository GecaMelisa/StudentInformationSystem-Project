var CoursesAndGradesService = {
    init: function() {

        list: function getGrade(id){
            $.ajax(
                {
                    url: "../rest/studentgrades/2/" +id,
                    type: "GET",
                    success: function(data){
                        $(`#course_grade_${id}`).html(data[0]["grade"])
                    }

                })
        }
        $.ajax({
            url: "../rest/studentcourses/2",
            type: "GET",
            success: function (data) {
              for(course of data) {
                $(".course").append(`
                <tbody>
                <tr>
                    <td>${course.name}</td>
                </tr>
                <tr>
                    <td class="card-body">
                        Grade:
                        <span id="course_grade_${course.id}"></span>
                    </td>
                </tr>
                </tbody>  
              `)
              
                    
              getGrade(course.id)
              }
            },
            error: function (data) {
              console.log("drama")
            },
          });
          
    }
}