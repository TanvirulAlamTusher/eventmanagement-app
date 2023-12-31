<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new Event</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                       
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="time" name="time">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select class="form-control" id="EventcategoryDropdown">
                                    <option value="">--Select Category--</option>
                                  
                                  
                                </select>
                            </div>
                        </div>
                     
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn btn-sm btn-success">Save</button>
            </div>
        </div>
    </div>
</div>


<script>

 FillCategoryDropDown();

 async function FillCategoryDropDown(){
     let res = await axios.get("/catagory-list")
     res.data.forEach(function (item,i) {
         let option=`<option value="${item['id']}">${item['name']}</option>`
         $("#EventcategoryDropdown").append(option);
     })

 }

async function Save() {
       let title = document.getElementById('title').value;
       let description = document.getElementById('description').value;
       let date = document.getElementById('date').value;
       let time = document.getElementById('time').value;
       let location = document.getElementById('location').value;
       let category_id = document.getElementById('EventcategoryDropdown').value;
       
       if(title.length === 0) 
       {
        errorToast("Title Required");
       }
       else if(description.length === 0) 
       {
        errorToast("Description Required");
       }
      
       else if(date.length === 0) 
       {
        errorToast("Date Required");
       }
       else if(time.length === 0) 
       {
        errorToast("Time Required");
       }
       else if(location.length === 0) 
       {
        errorToast("Location Required");
       }
       else if(category_id.length === 0) 
       {
        errorToast("Category Required");
       }
        
       else{
        document.getElementById('modal-close').click();

        showLoader();
         let res = await axios.post('/create-event',{
            title:title,
            description:description,
            date:date,
            time:time,
            location:location,
            category_id:category_id
             });
        hideLoader();

         if(res.status===200 && res.data['status']==='success'){
            await  getList();
             successToast(res.data['message']);
         }else{
             errorToast(res.data['message']);

         }
       }  
    }   
</script>
