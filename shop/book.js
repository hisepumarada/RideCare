

function sendMail() {
    var params = {
        date: document.getElementById("date").value,
        email: document.getElementById("email").value,
        name: document.getElementById("name").value,
        mobile: document.getElementById("mobile").value,
        service: document.getElementById("service").value,
    };

  const serviceID = "service_mkhh98s";
  const templateID = "template_h6hw0rd";

  emailjs
     .send(serviceID, templateID, params)
     .then((res) => {
      document.getElementById("date").value = "";
      document.getElementById("email").value = "";
      document.getElementById("name").value = "";
      document.getElementById("mobile").value = "";
      document.getElementById("service").value = "";
      console.log(res);
      alert("your booking is successfully")
     }) 
     .catch((err) => console.log(err));
     
     return false;
}

