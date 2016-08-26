/**
 * Created by ldk on 2016/5/31.
 * 功能：图片上传时将图片显示出来
 * 说明：下面提供了三种方式，但是这三种方式使用方法基本上是一致的
 */

//参数说明：参数file是文件上传的input框中的 id = file ，view是要在那个图片中显示
//效果：当点击上传图片时直接显示在 id = view1 的 img 元素中显示图片
function showImageRightNow(file,view){
    if($(file).files && $(file).files[0]){
        $(view).style.display ='block';
        //为上传的图片创建一个url，并将这个url赋值给$(view).src
        $(view).src = window.URL.createObjectURL($(file).files[0]);
        //销毁创建的url对象
        window.URL.revokeObjectURL($(view).src);
    }
}

// html示例1 ，下面的html示例是结合上面的js中的 showImageRightNow()函数使用
/*
 <input type="button" class="btn btn-info" value="上传图片" onclick="head.click()"/>
 <input type="file" name="head" id="head" onchange="showImageRightNow('head','view1');checkImageSize();"  style="display: none;" multiple/>
 <br/><br/>
 <img src="/upload/modified/image.png" id="view1" style="width: 200px;height: 200px;"/> 
*/





//参数说明：file 是文件上传框 input 中的 id = file 或者 name = file ，view 是要在那个图片中显示
//效果：点击上传图片选择图片确定后，可以点击预览，也可以点击关闭预览
function viewImages(file,view){
    alert($(file).files[0]);
    if($(file).files && $(file).files[0]){
        if($(view).style.display == 'none'){
            $(view).style.display = 'block';
            $(view).style.height = '200px';
            $(view).style.width = '200px';
            //为上传的图片创建一个url，并将这个url赋值给$('view').src
            $(view).src = window.URL.createObjectURL($(file).files[0]);
            e.value = '关闭预览';
        }else {
            if ($(view).style.display == 'block') {
                $(view).style.display = 'none';
                //销毁为上传的图片创建的url
                window.URL.revokeObjectURL($(view).src);
                e.value = '显示图片';
            }
        }
    }
}
// html示例2，
/*
 <!--点击上传图片时触发单击事件click 触发 id = head 的input 文件上传框-->
 <input type="button" class="btn btn-info" value="上传图片" onclick="head.click()"/>
 <input type="file" name="head" id="head" multiple onchange="showImageRightNow('head','view1');checkImageSize();" value="" style="display: none;"/>
 <br/><br/>
 <img src="" id="view1" style="display: none" /><input type="button" onclick="viewImages('head','view1')" value="预览头像" style="display: block"/>
*/





    function setImagePreview() {
        var docObj=document.getElementById("doc");
        var imgObjPreview=document.getElementById("preview");
        if(docObj.files && docObj.files[0]){
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            imgObjPreview.style.width = '300px';
            imgObjPreview.style.height = '120px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();

            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
        }else{
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            var localImagId = document.getElementById("localImag");
            //必须设置初始大小
            localImagId.style.width = "300px";
            localImagId.style.height = "120px";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try{
                localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            }catch(e){
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
        return true;
    }

/* html 示例 3 ，下面的html配合上面的js函数 setImagePreview() 函数使用
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <body>
    <input type=file name="doc" id="doc" onchange="javascript:setImagePreview();">
    <p><div id="localImag"><img id="preview" width=-1 height=-1 style="diplay:none" /></div></p>
    <script>
    </script>
    </body>
    </html>
*/



