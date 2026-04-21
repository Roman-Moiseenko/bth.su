import {ElMessage, type MessageParams} from "element-plus";
import {type AppContext} from "vue";

export const useMessage = () => {

    function msg(options?: MessageParams, context?: AppContext) {
        return ElMessage(defaultOptions(options), context)
    }
    function error(options?: MessageParams, context?: AppContext) {
        options = defaultOptions(options)
        options['duration'] = 5500 //5.5c для ошибок
        return ElMessage.error(options, context)
    }
    function primary(options?: MessageParams, context?: AppContext) {
        return ElMessage.primary(defaultOptions(options), context)
    }
    function success(options?: MessageParams, context?: AppContext) {
        return ElMessage.success(defaultOptions(options), context)
    }
    function warning(options?: MessageParams, context?: AppContext) {
        return ElMessage.warning(defaultOptions(options), context)
    }
    function info(options?: MessageParams, context?: AppContext) {
        return ElMessage.info(defaultOptions(options), context)
    }

    function defaultOptions(options?: MessageParams) {
        if (typeof options === 'string') options = {message: options};
        options['showClose'] = true;
        options['grouping'] = true;
        return options
    }

    return {
        msg,
        error,
        primary,
        success,
        warning,
        info,
    }


}
