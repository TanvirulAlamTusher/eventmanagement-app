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
                                <a href="" class="btn get_detail_btn">Interest</a>
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
      hideLoader();

      
    }
  
</script>