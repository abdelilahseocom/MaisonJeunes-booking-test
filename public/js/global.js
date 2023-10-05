// checkers
function isEmpty(value) {
    return value === undefined || value === null || value === '';
}

async function deleteRecordWithconfirmMessage(title = "Êtes-vous sûr(e) ?", message = "Vous ne pourrez pas revenir en arrière !", icon = 'warning', form) {
    var outcome = false;
    await Swal.fire({
        title: title,
        text: message,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprime-le !',
        cancelButtonText: 'Annuler',
    }).then(async (result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire({      
                title: "Supprimé!",
                text: "La suppression a été effectuée avec succès",
                icon: "success",
                showConfirmButton: false,
            })
        }
    })
    return outcome;
}

/**
 *
 * @param  url
 * @param  data
 * @return data
 */
async function ajaxCall(url, data){
    return new Promise((resolve,reject)=>{
        $.ajax({
            type:"POST",
            url:url,
            data: {
                _token:$('meta[name="csrf-token"]').attr('content'),
                "data":data
            },
            success:function(data){
                resolve(data);
            },
            error:function(error){
                reject(error)
            }
        });
    });
}

async function fillSelectByData(url, selectElement, filledSelectId, recordId = null,emptySelects=[]){
    let data = {
        id: $(selectElement).val(),
    };
    let results = await ajaxCall(url, data);
    let options = '<option value=""></option>';
    let seletced = "";
    if (emptySelects.length>0) {
        emptySelects.forEach(function(select){
                $(`#${select}`).empty();
            
        })
        
    }

    if (results.error==0 && results.data!=null) {
        results.data.forEach((element)=>{
            options += `<option value="${element.id}" ${seletced} >${element.name} </option>`;
        })
        $('#'+filledSelectId).html(options);
        if(recordId !== null) {
            $('#'+filledSelectId).select2({
                placeholder: "Veuillez sélectionner une option",
                allowClear: true
            }).val(recordId).trigger("change")
        }
    } else {
        options = `<option value=""></option>`
        $('#'+filledSelectId).html(options);
    }
}