let dashboardService = {
    init: function() {

        function getGrade(id) {
            $.ajax({
                url: "../rest/studentgrades/2/" + id,
                type: "GET",
                success: function(data) {
                    $(`#course_grade_${id}`).html(data[0]["grade"]);
                }
            });
        }

        $.ajax({
            url: "../rest/course",
            type: "GET",
            success: function(data) {
                let registeredCourses = data.filter(function(course) {
                    return course.status === 1; // Samo predmeti sa statusom 1 (registered)
                });

                for (course of registeredCourses) {
                    $(".datatable").append(`
                        <tbody>
                            <td>${course.name}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-custom" role="progressbar" style="width: ${course.attendance}%;" aria-valuenow="${course.attendance}" aria-valuemin="0" aria-valuemax="100">${course.attendance}</div>
                                </div>
                            </td>
                            <td id="course_grade_${course.id}"></td>
                        </tbody>
                    `);
                    getGrade(course.id);
                }
            },
            error: function(data) {
                console.log("drama");
            },
        });
    }
};
