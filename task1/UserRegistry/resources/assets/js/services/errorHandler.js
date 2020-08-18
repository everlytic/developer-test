import axios from "axios";
import toast from "./toast";

function errorResponseHandler(error) {
    // check for errorHandle config
    if (
        error.config.hasOwnProperty("errorHandle") &&
        error.config.errorHandle === false
    ) {
        return Promise.reject(error);
    }

    // if has response show the error
    if (error.response) {
        toast.error(error.response.data.message);
    }
}

// apply interceptor on response
axios.interceptors.response.use((response) => response, errorResponseHandler);

export default errorResponseHandler;