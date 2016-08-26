/**
 * Created by ldk on 2016/5/31.
 * 功能：上传图片时，先判断图片的尺寸大小
 */
//参数说明：file 要判断的 文件 ，view 判断通过后，图片在哪里显示
//效果：当点击上传图片时，先会对选择的图片进行判断是否满足设定的规格尺寸，满足就可以直接显示出来，否则就提示图片上传出错
function checkImageSize(file,view){
    var f=document.getElementById(file).files[0];
    var img = document.createElement("img");
    img.file = f;
    img.onload=function(){
        if(file == 'background'){
            if(!(this.width == 750 && this.height == 422)){
                alert("图片尺寸不正确，图片尺寸必须是 750×422px ");
                return false;
            }else{
                if($(action).files && $(action).files[0]){
                    $(view).style.display ='block';
                    //为上传的图片创建一个url，并将这个url赋值给$(view).src
                    $(view).src = window.URL.createObjectURL($(action).files[0]);
                    //销毁创建的url对象
                    window.URL.revokeObjectURL($(view).src);
                }
            }
        }
        if(flag == 'lunbo'){
            if(!(this.width == 750 && this.height == 300)){
                alert("图片尺寸不正确，图片尺寸必须是 750×300px ");
            }else{
                if($(file).files && $(file).files[0]){
                    $(view).style.display ='block';
                    //为上传的图片创建一个url，并将这个url赋值给$(view).src
                    $(view).src = window.URL.createObjectURL($(file).files[0]);
                    //销毁创建的url对象
                    window.URL.revokeObjectURL($(view).src);
                }
            }
        }
        alert(this.height);
        alert(this.width);
    }
    var reader = new FileReader();
    reader.onload = function(e){
        img.src = e.target.result;
    };
    reader.readAsDataURL(f);
}

// html 示例,下面的html代码是结合上面的js 函数checkImageSize()使用，可以自己根据需要进行修改
/*
 <input type="button" class="btn btn-info" value="上传图片" onclick="background.click()"/>
 <input type="file" name="background" id="background" multiple onchange="checkImageSize('background','view2');" value="" style="display: none;"/>
 <br/><br/>
 <img src="/upload/modified/image.png" id="view2" style="width: 750px;height: 422px;"/>
 */