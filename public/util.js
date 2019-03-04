/**
 * 上传图片插件的绑定事件方法
 * @param obj   绑定的file dome元素
 * @param setting   插件的参数 目前有：buttonText  fileType queueID
 * @param complete_callback     上传完成的回调函数
 * @constructor
 */
function BindUploadifive(obj, setting, complete_callback) {
    $(obj).uploadifive({
        'auto'             : true,
        'fileObjName': "myfile",
        'buttonText' : setting.buttonText ? setting.buttonText : '上传文件',    // 按钮显示的文字
        'fileType': setting.fileType ? setting.fileType : 'video/*,image/*',    // 允许上传的文件类型
        'queueID'          : setting.queueID ? setting.queueID : 'queue',       // 进度条元素id
        'uploadScript'     : '/index/upload/uploadify',
        'onUploadComplete' : function(file, data) {
            if(typeof complete_callback == 'function'){
                complete_callback(file, data);
            }
        }
    });
}