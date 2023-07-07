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

          profileService.changePassword(data[0].studentID);
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log("Error:", errorThrown);
        }
      });
    }

    // Call the necessary function to populate the profile
    getStudentInfo(2);
  },



  changePassword: function(id) {
    var currentPassword = document.getElementById("current-password").value;
    var newPassword = document.getElementById("new-password").value;
    var confirmPassword = document.getElementById("confirm-password").value;

    // Validacija i provjera podataka

    if (newPassword !== confirmPassword) {
      alert("Nova lozinka i Potvrdi lozinku se ne podudaraju.");
      return;
    }

    var data = {
      currentPassword: currentPassword,
      newPassword: newPassword
    };
    console.log(id);

    // AJAX poziv za edit operaciju
    
    $.ajax({
     url: "rest/changePassword/" +id,
     type: "PUT",
    data: JSON.stringify(data),
    contentType: "application/json",
    success: function(response) {
      alert("Lozinka uspješno promijenjena.");
    // Resetovanje forme ili dodatne operacije
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
    alert("Greška: " + XMLHttpRequest.responseText);
  }
});
    
  }
};

 function showChangePasswordForm() {
      var formHTML = `
        <div id="change-password-modal" class="modal">
          <div class="modal-content">
            <span class="close" onclick="closeChangePasswordForm()">&times;</span>
            <form id="change-password-form">
              <label for="current-password">Trenutna lozinka:</label>
              <input type="password" id="current-password">
              <br>
              <label for="new-password">Nova lozinka:</label>
              <input type="password" id="new-password">
              <br>
              <label for="confirm-password">Potvrdi lozinku:</label>
              <input type="password" id="confirm-password">
              <br>
              <button type="submit">Promijeni lozinku</button>
            </form>
          </div>
        </div>
      `;

      // Dodavanje forme u odgovarajući HTML element
      var formContainer = document.getElementById("change-password-container");
      formContainer.innerHTML = formHTML;

      // Dodavanje slušatelja događaja na formu za submit
      var changePasswordForm = document.getElementById("change-password-form");
      changePasswordForm.addEventListener("submit", function(event) {
        event.preventDefault();

      function closeChangePasswordForm() {
          var modal = document.getElementById("change-password-modal");
          modal.style.display = "none";
        }
      

        // Pozivanje funkcije changePassword iz profileService objekta
        profileService.changePassword();
      });

      var modal = document.getElementById("change-password-modal");
      modal.style.display = "block";
    }


$(document).ready(function() {
  profileService.init();
});

