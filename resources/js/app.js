import './bootstrap';



Echo.private(`classroom.${classroom_id}`)
    .listen('.create-classwork', (e) => {


 document.getElementById('alertEvent').innerHTML=e.content;
        document.getElementById('alertEvent').classList.add("show");

        const div = document.createElement("div");
        div.innerHTML = `
 <div class="card mb-3" style="max-width: 700px" >
  <div class="row g-0">

    <div class="col-md-12">
      <div class="card-body">

        <p class="card-text w-100"> ${e.content} </p>

      </div>
    </div>
  </div>
</div>

        `;
        document.getElementById('notification-list').prepend(div);
setTimeout(function(){
 document.getElementById('alertEvent').classList.remove("show");
}, 3000);


    });
Echo.private(`App.Models.User.${user_id}`)
    .no
    .notification((e) => {


 document.getElementById('alertEvent').innerHTML=e.body;
        document.getElementById('alertEvent').classList.add("show");

        const div = document.createElement("div");
        div.innerHTML = `
 <div class="card mb-3" style="max-width: 700px" >
  <div class="row g-0">

    <div class="col-md-12">
      <div class="card-body">
          <h3> ${e.header} </h3>
        <p class="card-text w-100"> ${e.body} </p>

      </div>
    </div>
  </div>
</div>

        `;
        document.getElementById('notification-list').prepend(div);
setTimeout(function(){
 document.getElementById('alertEvent').classList.remove("show");
}, 3000);


    });
