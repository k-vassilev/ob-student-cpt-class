jQuery('input[name="activeStudent"]').on('change', (e) => {
    const isActive = e.target.checked
    const studentID = e.target.id.split('_')[1]

    let data = {
        action: 'checkbox', // the function that receives data
        isActive: isActive,
        studentId: studentID,
    }
    if ( data != null ) {
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: ajax_object.ajax_url,
            data: data,
            success: function (response) {
               console.log(response.data);
            },
            error: function (response) {
                console.log('error',response.data);
            }
        })
    }
  });