var RegistrationService = {

    list: function(){
    
        $.ajax({
            url: `../rest/course`,
            type: "GET",
           // beforeSend: function(xhr) {
               // xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
              //},
            
            success: function(data) {
            $("#course-list").html("");
            console.log(data);
            var html = "";
            for (let i = 0; i < data.length; i++) {
                html += `
            <tr>
                <td>${data[i].name}</td>
                <td>
                <button class="btn btn-primary btn-sm" onclick="RegistrationService.addCourse(${data[i].id})">Read</button>
                </td>
            </tr>
            `
            }
            $("#course-list").html(html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
            }
        });
        },



}