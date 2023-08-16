<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateName">
                            </div>
                        </div>
                        

                        <input class="d-none"  id="updateID"/>
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

    //   async function UpdateFillCategoryDropDown(){
    //     let res = await axios.get("/catagory-list")
    //     res.data.forEach(function (item) {
    //       //  let option=`<option value="${item['id']}">${item['name']}</option>`
    //         let option=`<option value="">"hello"</option>`
    //         $("#updatecategoryDropdown").append(option);
    //     })
    // } 

    

   async function FillupForm(id){
        document.getElementById('updateID').value = id;

        showLoader();

        let res = await axios.post("/category-by-id",{id:id})
        hideLoader();
       

         document.getElementById('updateName').value= res.data['name'];
       
    
       
     }

     async function Update(){
        let id =  document.getElementById('updateID').value

        let name =  document.getElementById('updateName').value
       
       

        if(name.length === 0) 
       {
        errorToast("Name Required");
       }  
       else{
        document.getElementById('update-modal-close').click();

        showLoader();
         let res = await axios.post('/catagory-update',{
            name:name,
            id:id

             });
        hideLoader();

         if(res.data===1){
            await  getList();
             successToast('Update Successfully');
         }else{
             errorToast('Something went wrong');

         }
       }  
        
     }
</script>
