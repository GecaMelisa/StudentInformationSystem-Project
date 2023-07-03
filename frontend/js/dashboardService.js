let dashboardService = {
    init: function() {
        $.ajax({
            url: "http://localhost/StudentInformationSystem/rest/studentcourses/2",
            type: "GET",
            success: function (data) {
                console.log(data)
              for(course of data) {
                $(".datatable").append(`
                <tbody>
                <td>${course.name}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-custom" role="progressbar" style="width: 65%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">40%</div>
                        </div>
                    <td>60</td>
                    </td>
                 </tbody>
              `)
              }
            },
            error: function (data) {
              console.log("drama")
            },
          });
          
    }
}