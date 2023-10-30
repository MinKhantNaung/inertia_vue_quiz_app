import toastr from "toastr";
import 'toastr/build/toastr.min.css'

export function useToastr() {
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
      }
    return toastr;
}
