window.addEventListener('alert', (event) => {
    //console.log(event)
    const data = event.detail;
    //console.log(data)

    const titles = {
        create: '¿Deseas crear el registro?',
        edit: '¿Deseas actualizar el registro?',
        delete: '¿Deseas eliminar el registro?',
        default: '¿Deseas continuar?'
    };

    const successMessages = {
        create: '✅ ¡Registro creado correctamente!',
        edit: '✏️ ¡Registro actualizado correctamente!',
        delete: '🗑️ ¡Registro eliminado correctamente!',
        default: '¡Acción realizada correctamente!'
    };

    const key = (data.title || '').toLowerCase();
    const confirmTitle = titles[key] || titles.default;
    const successTitle = successMessages[key] || successMessages.default;

    Swal.fire({
        position: data.position || 'center',
        title: confirmTitle,
        icon: data.type || 'success',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: successTitle,
                icon: 'success',
                showConfirmButton: false,
                timer: data.timer || 1500
            });

            setTimeout(() => {
                const formId = data.form;
                if (formId && document.getElementById(formId)) {
                    document.getElementById(formId).submit();
                } else {
                    console.warn('⚠️ Formulario no encontrado con ID:', formId);
                }
            }, data.timer || 1500);

        } else if (result.isDenied) {
            Swal.fire("Cambios no guardados", "", "info");
        }
    });
});
