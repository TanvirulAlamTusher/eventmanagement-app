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
                                <input type="text" class="form-control" id="categoryName" >
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
       let name = document.getElementById('categoryName').value;
      
       
       if(name.length === 0) 
       {
        errorToast("Name Required");
       }
        else{

        document.getElementById('modal-close').click();
       

         showLoader();
         let res = await axios.post('/create-catagory',{
            name:name
           
             });
        hideLoader();

         if(res.data===1){
            await  getList();
             successToast("catagory saved successfully");
             document.getElementById('save-form').reset();
             
         }else{
             errorToast("something went wrong");

         }
       }  
    }   
</script>
