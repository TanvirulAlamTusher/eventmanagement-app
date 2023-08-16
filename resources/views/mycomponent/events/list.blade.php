<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Events</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Tile</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    getList();

    async function getList() {
        showLoader();
        let res = await axios.get('/get-event');
        hideLoader();
        
        let tableData = $('#tableData');
        let tableList = $('#tableList');

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function (item,index){

            let truncatedDescription = item.description.length > 20 ? item.description.substring(0, 30) + '...' : item.description;
            
            let row = `<tr>
                <td>${index+1} </td>
                <td>${item.title} </td>
                <td>${truncatedDescription} </td>
                <td>${item.date} </td>
                <td>${item.time} </td>
                <td>${item.location} </td>
               
                <td>
                    <button data-id = "${item['id']}"  class ="btn viewEvent btn-outline-info">View</button>
                    <button data-id = "${item['id']}" class = "btn editBtn btn-sm btn-outline-success" >Edit</button>
                    <button data-id = "${item['id']}"  class ="btn deleteBtn btn-sm btn-danger ">Delete</button>
                    
                </td>
                
             </tr>`
             tableList.append(row);
          })


          $('.editBtn').on('click', async function () {
             let id = $(this).data('id');
             await FillupForm(id);
            $('#update-modal').modal('show');
            
          })

          $('.deleteBtn').on('click', async function () {
            let id = $(this).data('id');
           $('#delete-modal').modal('show');
           $('#deleteID').val(id);

       })
       $('.viewEvent').on('click', async function () {
             let id = $(this).data('id');
             await EventDetails(id);
            $('#Event-view-modal').modal('show');
            
          })
           
         new DataTable(tableData,{
            order:[[0,'asc']],
           lengthMenu:[10,20,30,40]
         });

      
    }


</script>

