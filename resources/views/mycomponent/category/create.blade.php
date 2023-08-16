<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                       
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="title" >
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

// FillCategoryDropDown();

// async function FillCategoryDropDown(){
//     let res = await axios.get("/catagory-list")
//     res.data.forEach(function (item,i) {
//         let option=`<option value="${item['id']}">${item['name']}</option>`
//         $("#categoryDropdown").append(option);
//     })

// }

async function Save() {
       let title = document.getElementById('title').value;
       let description = document.getElementById('description').value;
       let date = document.getElementById('date').value;
       let time = document.getElementById('time').value;
       let location = document.getElementById('location').value;
       
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
        document.getElementById('modal-close').click();

        showLoader();
         let res = await axios.post('/create-event',{
            title:title,
            description:description,
            date:date,
            time:time,
            location:location
             });
        hideLoader();

         if(res.status===200 && res.data['status']==='success'){
            await  getList();
             successToast(res.data['message']);
             successToast(res.data['errors']);
         }else{
             errorToast(res.data['message']);

         }
       }  
    }   
</script>
