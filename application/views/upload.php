  <style>
        body
        {
            margin:0;
        }
    .file input{
            position: absolute;left: 0;top: 0;height: 30px; filter:alpha(opacity=0);opacity:0; background-color: transparent;width:200px; font-size:180px;
        }
        .file{
          width: 200px;height: 30px; background:#fff; text-align: center; line-height: 30px; overflow: hidden;position: relative;border:1px solid #7F9DB9;color:#333;
        }
    </style>
  <form action="http://localhost/zp/index.php/ums/uploadImage" method="post" enctype="multipart/form-data" id="uploadForm">
   <div class="file">选择文件( 不超过4M )<input type="file" name="file" id="fileUpload"></div>
    </form>
    <script type="text/javascript">
        function $(id) {
            return document.getElementById(id) || id;
        }
        var fileUpload = $('fileUpload');
        var uploadFileTimer;
        //var curdiv=null;
        var form = $('uploadForm');
        var maxSize = '4096';

        function setUploadDiv() {
            if (window.parent.isUploadingFile) {
                alert('请先等待当前的文件上传完毕，再上传！');
                if (window.parent.curfilediv)
                    window.parent.curfilediv.scrollIntoView();
                return false;
            }
            if (window.curdiv) {
                window.curdiv.onclick();
            }
            window.parent.curfilediv = window.curdiv || window.parent.curdiv;
            return true;
        }
        fileUpload.onclick = setUploadDiv;
        fileUpload.onchange = function () {
            uploadClick();
        }
        Array.prototype.indexOf = function (vItem) {
            for (var i = 0, l = this.length; i < l; i++) {
                if (this[i] == vItem) {
                    return i;
                }
            }
            return -1;
        };
        var iLen = 0; var uploadInterval = null; var totalLen = 30;
        function checkStatus() {
            window.parent.curfilediv.uploadmsg.innerHTML = iLen < totalLen ? window.parent.curfilediv.uploadmsg.innerHTML + ">" : "";
            iLen++;
            if (iLen >= totalLen) {
                iLen = 0;
                window.parent.curfilediv.uploadmsg.innerHTML = "正在上传...";
            }
        }
        function uploadClick() {
            iLen = 0;
            if (!setUploadDiv()) return false;
//            if (!maxSize) maxSize = "10240";
//            if (!window.confirm('您确定您上传的文件大小不超过' + maxSize + 'KB吗?'))
//                return false;

            var vaild = fileUpload.value.length > 0;

            if (vaild) {
                var f_path = fileUpload.value;
                var ext = get_ext(f_path);
                var allowExt = window._ext || ".jpg|.jpeg|.gif|.bmp|.png|.pdf|.doc|.xls|.ppt|.txt|.rar|.zip|.gzip";
                var arrayExts = allowExt.split("|");
                if (arrayExts.indexOf(ext) == -1) {
                    window.parent.curfilediv.uploadmsg.innerHTML = "文件扩展名只能为" + allowExt; return false;
                }
                if (window.parent.curfilediv) {
                    window.parent.curfilediv.uploadmsg.innerHTML = "正在上传...";
                    uploadInterval = setInterval(checkStatus, 1000);
                    window.parent.updateProgressBar(window.parent.curfilediv.dataNode);
                }
                window.parent.isUploadingFile = true;

                form.submit();
            }
            else {
                window.parent.curfilediv.uploadmsg.innerHTML = "请先选择文件，再上传！";
                return false;
            }
        }
        //获取文件扩展名
        function get_ext(f_path) {
            var ext = '';
            if (f_path != null && f_path.length > 0) {
                f_path = f_path;
                ext = f_path.substring(f_path.lastIndexOf("."), f_path.length);
            }
            return ext.toLowerCase();
        }
        var fileName ="<?php echo $fileName;?>";
        var errorCode = "";
        var errorMsg = "";
        function uploadF() {
            if(fileName)
                window.parent.curfilediv.uploadFinish('文件已经成功上传！', encodeURIComponent(fileName));
            else
                window.parent.curfilediv.uploadFinish(errorMsg, '');
        }
        if (fileName || errorMsg) {
            uploadF();
        }
    </script>
