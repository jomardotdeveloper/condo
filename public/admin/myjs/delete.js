function deleteRecord(route) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            axios.delete(route).then((res)=>{
                if(res.status == 201){
                    Swal.fire("Success!", res.data.success, "success").then(function () {
                        location.reload();
                    });   
                }
            }).catch(function (error) {
                Swal.fire("Error!", error.message, "error");
            });
        }
    });
}