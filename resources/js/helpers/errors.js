import {onErrorCaptured} from "vue";

export const handleComponentError = () => {
    return onErrorCaptured((e) => {
        // TODO: send the message to the server?
        console.log(e)
        return false;
    })
}
