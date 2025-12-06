import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

export default defineNuxtPlugin(() => {
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        iconColor: undefined,
        background: '#fff',
        color: '#000' ,
        customClass: {
            popup: 'colored-toast'
        },
    })

    return {
        provide: {
            swal: Swal,
            toast
        }
    }
})
