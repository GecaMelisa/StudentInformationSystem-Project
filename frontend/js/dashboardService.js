let dashboardService = {
    init: function() {

        function getGrade(id){
            $.ajax(
                {
                    url: "rest/studentgrades/" +id,
                    type: "GET",
                    success: function(data){
                        $(`#course_grade_${id}`).html(data[0]["grade"])
                    }

                })
        }
        $.ajax({
            url: "http://localhost/StudentInformationSystem-Project/rest/studentcourses/2",
            type: "GET",
            success: function (data) {
              for(course of data) {
                $(".datatable").append(`
                <tbody>
                <td>${course.name}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-custom" role="progressbar" style="width: ${course.attendance}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">${course.attendance}</div>
                        </div>
                    <td id="course_grade_${course.id}"></td>
                    </td>
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