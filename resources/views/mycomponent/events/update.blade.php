<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="updatetitle">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="updatedescription" name="updatedescription"></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="updatedate" name="date">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="updatetime" name="time">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="updatelocation" name="location">
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text"  class="form-control form-select" id="updatecategoryDropdown">
                                    <option value="">--Select Category--</option>
                                  
                                  
                                </select>
                            </div>
                        </div>
                        <input  id="updateID"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>

      async function UpdateFillCategoryDropDown(){
        let dropdown = $("#updatecategoryDropdown");
        dropdown.empty(); 
        
        let res = await axios.get("/catagory-list")
        res.data.forEach(function (item,i) {

           let option=`<option value="${item['id']}">${item['name']}</option>`
           $("#updatecategoryDropdown").append(option);
        })
    } 

    

   async function FillupForm(id){
        document.getElementById('updateID').value = id;

        showLoader();
        await UpdateFillCategoryDropDown();
        let res = await axios.post("/get-event-by-id",{id:id})
        hideLoader();
       

         document.getElementById('updatetitle').value= res.data['title'];
         document.getElementById('updatedescription').value= res.data['description'];
          document.getElementById('updatedate').value = res.data['date'];
          document.getElementById('updatetime').value = res.data['time'];
          document.getElementById('updatelocation').value = res.data['location'];
    
       
     }

     async function Update(){
        let id =  document.getElementById('updateID').value

        let title = document.getElementById('updatetitle').value
        let description = document.getElementById('updatedescription').value
        let date = document.getElementById('updatedate').value
        let time = document.getElementById('updatetime').value
        let location = document.getElementById('updatelocation').value
       

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
        
       else{
        document.getElementById('update-modal-close').click();

        showLoader();
         let res = await axios.post('/update-event',{
            title:title,
            description:description,
            date:date,
            time:time,
            location:location,
            id:id

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
