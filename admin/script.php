<link rel="stylesheet" href="dashboard.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script>
    function alert(type,message){
        let bs_class = (type== 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML =`
        
        <div class="alert ${bs_class} alert-dismissible fade show text-center setting-alert" role="alert">
        <strong class="m-3">${message}</strong>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        
        `;

        document.body.append(element);
    }

 

</script>