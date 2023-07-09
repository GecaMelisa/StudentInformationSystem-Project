var profileService = {
    init: function() {
      // Function to retrieve student information
      function getStudentInfo(studentId) {
        $.ajax({
          url: `../rest/studentInfo/2`,
          type: "GET",
          success: function(data) {
            console.log(data);
            // Update student information in the HTML
            $(".student-info h2").text(`${data[0].firstName} ${data[0].lastName}`);
            $("#id").text(data[0].studentID);
            $("#email").text(data[0].email);
            $("#country").text(data[0].country);
            $("#city").text(data[0].city);
            $("#dob").text(data[0].dateOfBirth);
            $("#phone").text(data[0].phone);
            const student = data[0]; // Assuming the response data is an array with a single student object
            const photoUrl = student.photo; // Assuming the column name in the database is "photo"
            $('.student-image img').attr('src', photoUrl);

            


          },
          error: function(xhr, textStatus, errorThrown) {
            console.log("Error:", errorThrown);
          }
        });
      }




















  
      // Call the necessary function to populate the profile
      getStudentInfo(2); // Replace 2 with the actual student ID
    }
  };
  
  $(document).ready(function() {
    profileService.init();
  });
  