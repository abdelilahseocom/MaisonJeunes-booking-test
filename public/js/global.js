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
