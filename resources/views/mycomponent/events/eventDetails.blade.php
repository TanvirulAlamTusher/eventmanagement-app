<div class="modal" id="Event-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="date_time">
                    <p id="eventDate" class="date"></p>
                    <p id="eventTime" class="time"></p>
                </div>
                <div class="event_body">
                    <h3 id="eventTitle" class="title"></h3>
                    <p id="eventDesc" class="description"></p>
                </div>
                <div class="event_footer">
                    <p id="eventLocation" class="location"></p>
                </div>
                <input class="d-none" id="eventId" type="text">
            </div>
        </div>
    </div>
</div>

<script>
    async function EventDetails(id) {
        document.getElementById('eventId').value = id;
        showLoader();
        let res = await axios.post("/get-event-by-id",{id:id})
        hideLoader();

        document.getElementById('eventTitle').innerHTML= res.data['title'];
         document.getElementById('eventDesc').innerHTML= res.data['description'];
          document.getElementById('eventDate').innerHTML = res.data['date'];
          document.getElementById('eventTime').innerHTML = res.data['time'];
          document.getElementById('eventLocation').innerHTML = res.data['location'];

        
         
    }
</script>