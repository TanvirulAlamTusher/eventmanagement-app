<div class="logo_area text-center">
  <h2>All Events And RSVP</h2>

<div class="event_area section_padding">
    <div class="container">
        <div id="eventList" class="row">
            {{-- <div class="col-md-3 py-3">
                <div class="single_event">

                    <div class="card">
                        <div class="card-body">
                                <div class="date_time">
                                    <p class="date" id="event_date">11-2-2023</p>
                                    <p class="time" id="event_time">12:45 PM</p>
                                </div>
                                <div class="event_body text-center">
                                    <h3 class="title" id="event_title">this tis title</h3>
                                <a href="" class="btn get_detail_btn">Interest</a>
                                </div>
                                <div class="event_footer text-center">
                                    <p class="location" id="event_location">dhaka, bangladesh</p>
                                    <input type="text" id="event_id" class="d-none">
                                </div>
                        </div>
                      </div>
                </div>
            </div> --}}
           

        </div>
    </div>

<script>
    ShowAllEvents();
    async function ShowAllEvents() {
        showLoader();
        let res = await axios.get('get-allevent');
        hideLoader();
        res.data.forEach(item => {
            document.getElementById('eventList').innerHTML+=(
                `
                <div class="col-md-3 py-3">
                <div class="single_event">

                    <div class="card">
                        <div class="card-body">
                                <div class="date_time">
                                    <p class="date" id="event_date">${item['date']}</p>
                                    <p class="time" id="event_time">${item['time']}</p>
                                </div>
                                <div class="event_body text-center">
                                    <h3 class="title" id="event_title">${item['title']}</h3>
                                <button data-id=${item['id']}  class="btn rsvp_btn">Interest</button>
                                </div>
                                <div class="event_footer text-center">
                                    <p class="location" id="event_location">${item['location']}</p>
                                    <input type="text" id="event_id" class="d-none">
                                </div>
                        </div>
                      </div>
                </div>
            </div>
              `
            )

        })

      $('.rsvp_btn').on('click', async function () {
        let id = $(this).data('id');
        showLoader();
        let ress = await axios.post('/add-attendance',{id:id})
        hideLoader();
        alert("Thanks for your Interest!");
      })

      
    }
  
</script>